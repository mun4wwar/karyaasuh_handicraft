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
                Daftar Supplier
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Panti Asuhan</th>
                            <th>Kontak</th>
                            <th>Alamat</th>
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
                        @foreach ($suppliers as $supplier)
                            <tr>
                                <td>
                                    {{ ($suppliers->currentPage() - 1) * $suppliers->perPage() + $loop->iteration }}
                                </td>
                                <td>{{ $supplier->nama_panti_asuhan }}</td>
                                <td>{{ $supplier->kontak }}</td>
                                <td>{{ $supplier->alamat }}</td>
                                <td>
                                    <a href="{{ url('edit_supplier', $supplier->id) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ url('delete_supplier', $supplier->id) }}" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
