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
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Gambar Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Gambar Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($product as $products)
                            <tr>
                                <td>{{ $products->title }}</td>
                                <td>{!! Str::limit($products->description, 50) !!}</td>
                                <td>{{ $products->price }}</td>
                                <td>{{ $products->category }}</td>
                                <td>{{ $products->stock }}</td>
                                <td>
                                    <img height="120" src="products/{{ $products->image }}" alt="">
                                </td>
                                <td><a class="btn btn-danger" href="{{ url('delete_product', $products->id) }}">Hapus</a> <a
                                        class="btn btn-success" href="{{ url('update_product', $products->id) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="div_deg">
            {{ $product->onEachSide(1)->links() }}
        </div>
    </div>
@endsection
