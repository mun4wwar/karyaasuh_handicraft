<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::paginate(5);
        return view('admin.supplier', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add_supplier()
    {
        return view('admin.add_supplier');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function upload_supplier(Request $request)
    {
        $data = new Supplier();
        $data->nama_panti_asuhan = $request->nama_panti_asuhan;
        $data->kontak = $request->kontak;
        $data->alamat = $request->alamat;

        $data->save();
        toastr()->closeButton()->timeOut(5000)->success('Supplier berhasil ditambahkan.');
        return redirect('/supplier');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_supplier(string $id)
    {
        $data = Supplier::find($id);
        return view('admin.edit_supplier', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_supplier(Request $request, $id)
    {
        $data = Supplier::find($id);
        $data->nama_panti_asuhan = $request->nama_panti_asuhan;
        $data->kontak = $request->kontak;
        $data->alamat = $request->alamat;
        
        $data->save();
        toastr()->closeButton()->timeOut(5000)->success('Supplier berhasil diupdate.');
        return redirect('/supplier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_supplier($id)
    {
        $data = Supplier::find($id);
        $data->delete();
        toastr()->closeButton()->timeOut(5000)->success('Supplier berhasil dihapus.');
        return redirect()->back();
    }
}
