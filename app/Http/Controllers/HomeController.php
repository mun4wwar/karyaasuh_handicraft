<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Hitung jumlah user dengan usertype 'user'
        $userCount = User::where('usertype', 'user')->count();
        $visitorCount = "-";

        // Hitung total produk
        $productCount = Product::count();

        // Hitung total orderan berdasarkan jumlah quantity
        $orderCount = Order::sum('quantity');

        // Hitung total orderan dengan status 'delivered'
        $delivered = Order::where('status', 'delivered')->count();

        // Ambil data order dengan relasi product dan urutkan sesuai status
        $data = Order::with('product')
            ->orderByRaw("
            CASE
                WHEN status = 'On the way' THEN 1
                WHEN status = 'Pending' THEN 2
                ELSE 3
            END
        ")
            ->paginate(10);

        // Kirim data ke view
        return view('admin.index', compact('userCount', 'productCount', 'orderCount', 'delivered', 'data', 'visitorCount'));
    }

    public function home()
    {
        $product = Product::all();
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->sum('quantity');
        } else {
            $count = ' ';
        }
        return view('layouts.index', compact('product', 'count'));
    }
    public function login_home()
    {
        $product = Product::all();
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->sum('quantity');
        } else {
            $count = ' ';
        }
        return view('layouts.index', compact('product', 'count'));
    }

    public function product_details($id)
    {
        $data = Product::find($id);
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->sum('quantity');
        } else {
            $count = ' ';
        }
        return view('home.product_details', compact('data', 'count'));
    }

    public function add_cart($id)
    {
        $product_id = $id;
        $user = Auth::user();
        $user_id = $user->id;
        $data = new Cart;
        $data->user_id = $user_id;
        $data->product_id = $product_id;

        $data->save();
        toastr()->closeButton()->timeOut(5000)->success('Produk berhasil ditambahkan ke keranjang.');

        return redirect()->back();
    }

    public function mycart()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;

            // Ambil data keranjang dengan relasi produk
            $cart = Cart::with('product')->where('user_id', $userid)->get();

            $count = $cart->sum('quantity'); // Total kuantitas produk
            $total = 0;

            // Hitung total berdasarkan setiap item di keranjang
            foreach ($cart as $item) {
                $total += $item->quantity * $item->product->price;
            }

            return view('home.mycart', compact('count', 'cart', 'total'));
        }

        return redirect()->route('login');
    }

    public function delete_cart($id)
    {
        // Pastikan pengguna telah login
        if (Auth::check()) {
            $user = Auth::user();

            // Temukan item di keranjang berdasarkan id dan user_id untuk keamanan
            $cartItem = Cart::where('id', $id)->where('user_id', $user->id)->first();

            // Jika item ditemukan, hapus item tersebut
            if ($cartItem) {
                $cartItem->delete();
                toastr()->closeButton()->timeOut(5000)->success('Item berhasil dihapus dari keranjang.');
                return redirect()->back();
            }

            // Jika item tidak ditemukan, kembalikan pesan error
            toastr()->closeButton()->timeOut(5000)->error('Item tidak ditemukan di keranjang.');
            return redirect()->back();
        }

        // Jika pengguna belum login, arahkan ke halaman login
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }

    public function updateQuantity(Request $request, $id)
    {
        // Ambil item keranjang berdasarkan ID
        $cart = Cart::findOrFail($id);

        // Periksa apakah pengguna yang login sama dengan pemilik keranjang
        if ($cart->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak diizinkan mengubah item ini.');
        }

        // Tambah atau kurangi jumlah berdasarkan aksi
        if ($request->action == 'increase') {
            $cart->quantity += 1;
        } elseif ($request->action == 'decrease') {
            $cart->quantity -= 1;

            // Hapus item jika jumlah menjadi nol
            if ($cart->quantity <= 0) {
                $cart->delete();
                return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
            }
        }

        // Simpan perubahan
        $cart->save();

        return redirect()->back()->with('success', 'Jumlah item berhasil diperbarui.');
    }

    public function checkout(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'name' => 'required|string|max:255',
            'rec_address' => 'required|string',
            'phone' => 'required|regex:/^[0-9]{10,15}$/',
            'payment' => 'required|in:transfer_bank', // Validasi pembayaran hanya untuk transfer_bank
        ]);

        $userid = Auth::user()->id;
        $cart = Cart::where('user_id', $userid)->get(); // Ambil keranjang belanja pengguna

        if ($cart->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang belanja kosong.');
        }

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Membuat entri Order baru
            $order = Order::create([
                'name' => $request->name,
                'rec_address' => $request->rec_address,
                'phone' => $request->phone,
                'user_id' => $userid,
                'payment' => $request->payment, // Menyimpan metode pembayaran yang dipilih
                'status' => 'Pending', // Status order default adalah pending
                'total_harga' => $cart->sum(function ($item) {
                    return $item->product->price * $item->quantity; // Hitung total harga dari keranjang
                }),
            ]);

            // Proses produk yang ada di keranjang
            foreach ($cart as $carts) {
                $product = Product::find($carts->product_id);

                if (!$product) {
                    throw new \Exception("Produk dengan ID {$carts->product_id} tidak ditemukan.");
                }

                // Validasi stok produk
                if ($product->stock < $carts->quantity) {
                    throw new \Exception("Stok produk '{$product->title}' tidak mencukupi.");
                }

                // Kurangi stok produk dan simpan ke pivot table (order_products)
                $product->decrement('stock', $carts->quantity);
                $order->products()->attach($product->id, ['quantity' => $carts->quantity]);
            }

            // Membuat entri transaksi yang berhubungan dengan order
            Transaction::create([
                'order_id' => $order->id,
                'payment_method' => $request->payment, // Menyimpan metode pembayaran
                'payment_status' => 'unpaid', // Status pembayaran awal adalah waiting
                'amount' => $order->total_harga, // Jumlah yang harus dibayar
            ]);

            // Hapus semua item di keranjang setelah berhasil checkout
            Cart::where('user_id', $userid)->delete();

            // Commit transaksi
            DB::commit();

            // Redirect ke halaman myorders dengan pesan sukses
            return redirect()->route('orders_page')->with('success', 'Pesanan berhasil dibuat. Silakan unggah bukti pembayaran.');
        } catch (\Exception $e) {
            // Rollback jika terjadi error
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function bankTransferPage()
    {
        // Halaman informasi rekening transfer bank
        return view('payment.bank_transfer', [
            'bankDetails' => [
                'bank_name' => 'Bank Mandiri',
                'account_number' => '1234567890',
                'account_name' => 'Nama Pemilik Rekening',
            ],
        ]);
    }

    public function creditCardPage()
    {
        // Halaman proses pembayaran kartu kredit
        return view('payment.credit_card');
    }

    public function showCheckout()
    {
        // Ambil keranjang pengguna dari session atau database
        $userid = Auth::user()->id;
        $carts = Cart::where('user_id', $userid)->get(); // Mengambil keranjang dari database berdasarkan user yang sedang aktif

        // Validasi apakah keranjang kosong
        if ($carts->isEmpty()) {
            return redirect()->route('mycart')->with('error', 'Keranjang Anda kosong.');
        }
        $count = $carts->sum('quantity');

        return view('home.checkout', compact('carts', 'count'));
    }

    public function myorders()
    {
        $userId = Auth::id();
        $carts = Cart::where('user_id', $userId)->get();
        $orders = Order::with('products')
            ->where('user_id', $userId)
            ->orderBy('id', 'asc') // Urutkan berdasarkan order_id
            ->get();

        $count = $carts->sum('quantity');

        return view('home.order', compact('orders', 'carts', 'count'));
    }


    public function view_shop(Request $id)
    {
        $product = Product::all();

        // Periksa apakah pengguna login
        $user = Auth::user();
        $count = 0; // Default count jika pengguna tidak login

        if ($user) {
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->sum('quantity');
        }

        return view('home.shop', compact('product', 'count'));
    }
}
