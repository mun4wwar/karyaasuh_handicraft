<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
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
        $category = Category::all();
        return view('admin.add_product', compact('category'));
    }
    public function upload_product(Request $request)
    {
        $data = new Product;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->category = $request->category;
        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('products'), $imagename);
            $data->image = $imagename;
        }
        $data->save();
        toastr()->closeButton()->timeOut(5000)->success('Produk berhasil ditambahkan.');
        return redirect('/view_product');
    }
    public function view_product()
    {
        $product = Product::paginate(3);
        return view('admin.view_product', compact('product'));
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
    public function update_product($id)
    {
        $data = Product::find($id);
        $category = Category::all();
        return view('admin.update_page', compact('data', 'category'));
    }
    public function edit_product(Request $request, $id)
    {
        $data = Product::find($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->category = $request->category;
        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('products'), $imagename);
            $data->image = $imagename;
        }
        $data->save();
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
        $data = Order::orderByRaw("
        CASE
            WHEN status = 'On the way' THEN 1
            WHEN status = 'In progress' THEN 2
            ELSE 3
        END
        ")->paginate(10);

        return view('admin.order', compact('data'));
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
}
