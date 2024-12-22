@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Daftar produk</h1>
        <ol class="breadcrumb mb-4">
            <form action="{{ url('product_search') }}" method="GET">
                @csrf
                <input type="search" name="search">
                <input type="submit" class="btn btn-success" value="Search">
            </form>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Daftar Produk
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Stock</th>
                            <th>Kategori</th>
                            <th>Bahan Baku</th>
                            <th>Gambar Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Stock</th>
                            <th>Kategori</th>
                            <th>Bahan Baku</th>
                            <th>Gambar Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($data as $products)
                            <tr>
                                <td>{{ $products->title }}</td>
                                <td>{!! Str::limit($products->description, 50) !!}</td>
                                <td>{{ $products->price }}</td>
                                <td>{{ $products->stock }}</td>
                                <td>{{ $products->category }}</td>
                                <td>{{ $products->materials->nama_bahan ?? 'N/A' }}</td>
                                <td>
                                    <img height="125" src="{{ asset('storage/products/' . $products->image) }}"
                                        alt="Product Image" />
                                </td>
                                <td><a class="btn btn-danger" href="{{ url('delete_product', $products->id) }}">Hapus</a> <a
                                        class="btn btn-warning" href="{{ url('edit_product', $products->id) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="div_deg">
            {{ $data->onEachSide(1)->links() }}
        </div>
    </div>
@endsection
