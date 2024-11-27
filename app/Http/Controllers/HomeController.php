<?php

namespace App\Http\Controllers;

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
        $user = User::where('usertype','user')->get()->count();
        $product = Product::all()->count();
        $order = Order::all()->sum('quantity');
        $delivered = Order::where('status','delivered')->get()->count();
        return view('admin.index',compact('user','product','order','delivered'));
    }

    public function home()
    {
        $product = Product::all();
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
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
            $count = Cart::where('user_id', $userid)->count();
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
            $count = Cart::where('user_id', $userid)->count();
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
            $count = Cart::where('user_id', $userid)->sum('quantity');
            $cart = Cart::where('user_id', $userid)->get();
        }
        return view('home.mycart', compact('count', 'cart'));
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

    public function confirm_order(Request $request)
    {
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;

        $userid = Auth::user()->id;
        $cart = Cart::where('user_id', $userid)->get();

        foreach ($cart as $carts)
        {
            $order = new Order;

            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $userid;
            $order->product_id = $carts->product_id;
            $order->quantity = $carts->quantity;

            $order->save();
        }
        $cart_remove = Cart::where('user_id',$userid)->get();

        foreach ($cart_remove as $remove)
        {
            $data = Cart::find($remove->id);
            $data->delete();
        }
        toastr()->closeButton()->timeOut(5000)->addSuccess('Barang berhasil di Order.');
        return redirect()->back();
    }

    public function updateQuantity(Request $request, $id)
    {
        $cart = Cart::find($id);
        if ($cart) {
            if ($request->action == 'increase'){
                $cart-> quantity +=1;
            } elseif ($request->action == 'decrease' && $cart->quantity > 1){
                $cart-> quantity -=1;
            }
            $cart->save();
        }
        return redirect()->back();
    }

    public function myorders()
    {
        $user = Auth::user()->id;
        $count = Cart::where('user_id', $user)->sum('quantity');

        $order = Order::where('user_id', $user)->get();

        return view('home.order', compact('count','order'));
    }
}
