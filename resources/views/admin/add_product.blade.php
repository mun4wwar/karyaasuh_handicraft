@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-3">Tambah Produk</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ url('upload_product') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Nama Produk dan Deskripsi Produk -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Nama Produk</label>
                                <input class="form-control" id="title" name="title" type="text"
                                    placeholder="Masukkan Nama produk" required />
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi Produk</label>
                                <textarea class="form-control" id="description" name="description" rows="4"
                                    placeholder="Masukkan Deskripsi produk" required></textarea>
                            </div>

                            <div class="row mb-3">
                                <!-- Harga Produk -->
                                <!-- Jumlah Stok -->
                                <div class="col-md-6">
                                    <label for="price" class="form-label">Harga Produk</label>
                                    <input class="form-control" id="price" name="price" type="number"
                                        placeholder="Masukkan harga produk" required />
                                </div>

                                <div class="col-md-6">
                                    <label for="stock" class="form-label">Jumlah Stok Produk</label>
                                    <input class="form-control" id="stock" name="stock" type="number"
                                        placeholder="Masukkan stok produk" required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="category" class="form-label">Kategori Produk</label>
                                    <select class="form-select" id="category" name="category" required>
                                        <option value="" hidden>Pilih kategori produk</option>
                                        @foreach ($category as $category)
                                            <option value="{{ $category->category_name }}">{{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Input Bahan Baku -->
                                <div class=" col md-6">
                                    <label for="bahan_baku" class="form-label">Bahan Baku</label>
                                    <select class="form-select" id="bahan_baku" name="bahan_baku_id" required>
                                        <option value="" hidden>Pilih bahan baku</option>
                                        @foreach ($bahan_baku as $bahan)
                                            <option value="{{ $bahan->id_bahanbaku }}">{{ $bahan->nama_bahan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Gambar Produk -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar Produk</label>
                                <input class="form-control" id="image" name="image" type="file" required />
                            </div>

                            <!-- Tombol Submit -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Tambah Produk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
