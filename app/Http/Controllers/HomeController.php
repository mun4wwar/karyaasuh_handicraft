<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::where('usertype', 'user')->get()->count();
        $product = Product::all()->count();
        $order = Order::all()->sum('quantity');
        $delivered = Order::where('status', 'delivered')->get()->count();
        $data = Order::with('product')->orderByRaw("
        CASE
            WHEN status = 'On the way' THEN 1
            WHEN status = 'Pending' THEN 2
            ELSE 3
        END
    ")->paginate(10);

        return view('admin.index', compact('user', 'product', 'order', 'delivered', 'data'));
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
        return view('home.index', compact('product', 'count'));
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
        return view('home.index', compact('product', 'count'));
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
        // Validasi data yang diterima dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'rec_address' => 'required|string',
            'phone' => 'required|regex:/^[0-9]{10,15}$/',
            'payment' => 'required|in:credit_card,bank_transfer,cod'
        ]);

        $userid = Auth::user()->id;
        $cart = Cart::where('user_id', $userid)->get();

        if ($cart->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang belanja kosong.');
        }

        foreach ($cart as $carts) {
            $product = Product::find($carts->product_id);

            if (!$product) {
                return redirect()->back()->with('error', "Produk dengan ID {$carts->product_id} tidak ditemukan.");
            }
            // Validasi stok
            if ($product->stock < $carts->quantity) {
                return redirect()->back()->with('error', "Stok produk '{$product->title}' tidak mencukupi. Stok tersedia: {$product->stock}, jumlah pesanan: {$carts->quantity}");
            }

            // Kurangi stok produk
            $product->decrementStock($carts->quantity);

            // Simpan order
            $order = new Order;
            $order->name = $request->name;
            $order->rec_address = $request->rec_address;
            $order->phone = $request->phone;
            $order->user_id = $userid;
            $order->product_id = $carts->product_id;
            $order->quantity = $carts->quantity;
            $order->payment = $request->payment;
            if (!$order->save()) {
                return redirect()->back()->with('error', 'Gagal menyimpan pesanan.');
            }
        }

        // Hapus semua item di keranjang setelah proses checkout
        Cart::where('user_id', $userid)->delete();

        // Redirect ke halaman sesuai metode pembayaran
        if ($request->payment === 'bank_transfer') {
            return redirect()->route('bankTransfer');
        } elseif ($request->payment === 'credit_card') {
            return redirect()->route('creditCard');
        } else {
            return redirect()->route('mycart')->with('success', 'Pesanan berhasil! Barang akan segera diproses.');
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
        $user = Auth::user()->id;
        $count = Cart::where('user_id', $user)->sum('quantity');

        $order = Order::where('user_id', $user)->get();

        return view('home.order', compact('count', 'order'));
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
