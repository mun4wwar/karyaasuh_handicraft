<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Supplier;
use App\Models\Bahanbaku;
use Barryvdh\DomPDF\Facade\Pdf;
use Pest\Plugins\Parallel\Support\CompactPrinter;

class AdminController extends Controller
{
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
        $bahan_baku = BahanBaku::all(); // Mengambil semua bahan baku
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
            'bahan_baku_id' => 'required|exists:bahanBaku,id_bahanbaku', // Validasi bahan baku
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
        $data = Product::with('bahanBaku')->paginate(3);  // Memuat relasi material
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            $request->image->move(public_path('products'), $imagename);
            $data->image = $imagename;
        }

        // Simpan perubahan
        $data->save();

        // Pesan sukses
        toastr()->closeButton()->timeOut(5000)->success('Produk berhasil diupdate.');
        return redirect('/view_product');
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
        $data = Order::orderByRaw("
        CASE
            WHEN status = 'On the way' THEN 1
            WHEN status = 'Pending' THEN 2
            ELSE 3
        END
        ")->paginate(10);

        return view('admin.order', compact('data', 'total'));
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

    public function print_pdf($id)
    {
        $data = Order::find($id);
        $pdf = Pdf::loadView('admin.invoice', compact('data'));
        return $pdf->download('invoice.pdf');
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
