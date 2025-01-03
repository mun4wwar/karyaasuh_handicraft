<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Bahanbaku;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Pest\Plugins\Parallel\Support\CompactPrinter;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Hitung jumlah user dengan usertype 'user'
        $userCount = User::where('usertype', 'user')->count();
        $visitorCount = DB::table('visitors')->count();

        // Hitung total produk
        $productCount = Product::count();

        // Hitung total orderan berdasarkan jumlah quantity
        $orderCount = Order::sum('quantity');

        // Hitung jumlah order unik berdasarkan order_id
        $uniqueOrderCount = Order::distinct('id')->count('id');

        // Hitung total orderan dengan status 'delivered'
        $delivered = Order::where('status', 'delivered')->count();

        // Ambil data order dengan relasi product dan urutkan sesuai status
        $data = Order::with('products')
            ->orderByRaw("
        CASE
            WHEN status = 'On the way' THEN 1
            WHEN status = 'Pending' THEN 2
            ELSE 3
        END
    ")
            ->paginate(10);
        // Kirim data ke view
        return view('admin.index', compact('userCount', 'productCount', 'orderCount', 'uniqueOrderCount', 'delivered', 'data', 'visitorCount'));
    }

    public function view_category()
    {
        $data = Category::all();

        return view('admin.category', compact('data'));
    }
    public function add_category(Request $request)
    {
        $category = new Category;
        $category->category_name = $request->category;
        $category->save();
        toastr()->closeButton()->timeOut(5000)->success('Kategori berhasil ditambahkan.');
        return redirect()->back();
    }
    public function delete_category($id)
    {
        $data = Category::find($id);
        $data->delete();
        toastr()->closeButton()->timeOut(5000)->success('Kategori berhasil dihapus.');
        return redirect()->back();
    }
    public function edit_category($id)
    {
        $data = Category::find($id);
        return view('admin.edit_category', compact('data'));
    }
    public function update_category(Request $request, $id)
    {
        $data = Category::find($id);
        $data->category_name = $request->category;
        $data->save();
        toastr()->closeButton()->timeOut(5000)->success('Kategori berhasil diupdate.');
        return redirect('/view_category');
    }
    public function add_product()
    {
        $bahan_baku = Bahanbaku::all(); // Mengambil semua bahan baku
        $category = Category::all(); // Mengambil semua kategori produk (jika diperlukan)

        return view('admin.add_product', compact('bahan_baku', 'category'));
    }
    public function upload_product(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required|string',
            'bahan_baku_id' => 'required|exists:materials,id_bahanbaku', // Validasi bahan baku
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:7168', // 7 MB max
        ]);

        $data = new Product;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->stock = $request->stock;
        $data->category = $request->category;
        $data->bahan_baku_id = $request->bahan_baku_id; // Menyimpan bahan baku yang dipilih

        if ($request->hasFile('image')) {
            try {
                $image = $request->file('image');
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('products', $imagename, 'public');
                $data->image = $imagename;
            } catch (\Exception $e) {
                return back()->withError('Gagal meng-upload gambar. Coba lagi.')->withInput();
            }
        }

        $data->save();

        toastr()->closeButton()->timeOut(5000)->success('Produk berhasil ditambahkan.');
        return redirect('view_product');
    }

    public function view_product()
    {
        $data = Product::with('materials')->paginate(5);  // Memuat relasi material
        return view('admin.view_product', compact('data'));
    }

    public function delete_product($id)
    {
        $data = Product::find($id);
        $image_path = public_path('products/' . $data->image);
        if (file_exists('$image_path')) {
            unlink('$image_path');
        }
        $data->delete();
        toastr()->closeButton()->timeOut(5000)->success('Produk berhasil dihapus.');
        return redirect()->back();
    }
    public function edit_product($id)
    {
        $data = Product::find($id);
        $category = Category::all();
        return view('admin.update_page', compact('data', 'category'));
    }
    public function update_product(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:7168',
        ]);

        // Cari data produk berdasarkan ID
        $data = Product::findOrFail($id);

        // Update data
        $data->title = $validated['title'];
        $data->description = $validated['description'];
        $data->price = $validated['price'];
        $data->stock = $validated['stock'];
        $data->category = $validated['category'];

        // Handle upload gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($data->image && file_exists(public_path('products/' . $data->image))) {
                unlink(public_path('products/' . $data->image));
            }
            // Simpan gambar baru
            $imagename = time() . '.' . $request->image->getClientOriginalExtension();
            $path = $request->image->storeAs('products', $imagename, 'public');
            $data->image = $imagename;
        }

        // Simpan perubahan
        try {
            $data->save();
            toastr()->closeButton()->timeOut(5000)->success('Produk berhasil diupdate.');
            return redirect('/view_product');
        } catch (\Exception $e) {
            return back()->withError('Gagal memperbarui produk. Coba lagi.');
        }
    }

    public function product_search(Request $request)
    {
        $search = $request->search;
        $product = Product::where('title', 'LIKE', '%' . $search . '%')->orWhere('category', 'LIKE', '%' . $search . '%')->paginate(3);
        return view('admin.view_product', compact('product'));
    }

    public function view_order()
    {
        $total = Order::all()->sum('quantity');
        $data = Order::with('transactions') // Tambahkan eager loading untuk 'transactions'
            ->orderByRaw("
            CASE
                WHEN status = 'On the way' THEN 1
                WHEN status = 'Pending' THEN 2
                ELSE 3
            END
        ")
            ->paginate(10);

        return view('admin.order', compact('data', 'total'));
    }

    public function confirmPayment($orderId)
    {
        // Temukan order berdasarkan ID
        $order = Order::findOrFail($orderId);

        // Cek apakah status transaksi adalah 'paid'
        if ($order->transactions && $order->transactions->payment_status == 'paid') {
            // Update status transaksi menjadi 'confirmed'
            $order->transactions->update([
                'payment_status' => 'confirmed',
            ]);

            return redirect()->back()->with('success', 'Payment has been confirmed');
        }

        return redirect()->back()->with('error', 'Invalid payment status');
    }

    public function on_the_way($id)
    {
        $data = Order::find($id);

        $data->status = 'On the way';
        $data->save();

        return redirect('/view_orders');
    }

    public function delivered($id)
    {
        $data = Order::find($id);

        $data->status = 'Delivered';
        $data->save();

        return redirect('/view_orders');
    }

    public function showInvoice($orderId)
    {
        // Ambil order berdasarkan ID
        $data = Order::with(['products', 'transactions'])->findOrFail($orderId);
        $totalAmount = $data->products->sum(function ($product) {
            return $product->price * $product->pivot->quantity;
        });

        return view('admin.invoice', compact('data', 'totalAmount'));
    }

    public function sendInvoice($orderId)
    {
        // Temukan order berdasarkan ID
        $order = Order::with(['products', 'transactions'])->findOrFail($orderId);

        // Kirim email dengan invoice
        Mail::to($order->user->email)->send(new InvoiceMail($order));

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Invoice has been sent to the user.');
    }

    public function print_pdf($id)
    {
        // Ambil data order berdasarkan ID
        $data = Order::find($id);

        // Tentukan nama file berdasarkan ID dan nama order
        $fileName = 'Invoice_' . $data->id . '_' . str_replace(' ', '_', $data->name) . '.pdf';

        // Load view invoice dan buat PDF
        $pdf = Pdf::loadView('admin.invoice', compact('data'));

        // Download PDF dengan nama yang telah disesuaikan
        return $pdf->download($fileName);
    }

    public function laporan_penjualan()
    {
        // Ambil data pesanan dengan pengurutan
        $data = Order::orderByRaw("
        CASE
            WHEN status = 'On the way' THEN 1
            WHEN status = 'In progress' THEN 2
            ELSE 3
        END
    ")->get(); // Pastikan query dieksekusi dengan `get()`

        // Generate PDF
        $pdf = PDF::loadView('admin.laporan', ['orders' => $data]);

        // Unduh file PDF
        return $pdf->download('laporan_penjualan.pdf');
    }
}
