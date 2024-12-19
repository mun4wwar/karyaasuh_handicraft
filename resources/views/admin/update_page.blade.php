@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-3">Update Produk</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('update_product/' . $data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Nama Produk -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ $data->title }}" placeholder="Masukkan nama produk" required>
                            </div>
                            <!-- Deskripsi Produk -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi Produk</label>
                                <textarea class="form-control" id="description" name="description" rows="4"
                                    placeholder="Masukkan deskripsi produk" required>{{ $data->description }}</textarea>
                            </div>
                            <!-- Harga Produk -->
                            <div class="mb-3">
                                <label for="price" class="form-label">Harga Produk</label>
                                <input type="number" class="form-control" id="price" name="price"
                                    value="{{ $data->price }}" placeholder="Masukkan harga produk" required>
                            </div>
                            <!-- Jumlah Stok dan Kategori Produk -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="stock" class="form-label">Jumlah Stok Produk</label>
                                    <input type="number" class="form-control" id="stock" name="stock"
                                        value="{{ $data->stock }}" placeholder="Masukkan jumlah stok produk" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="category" class="form-label">Kategori</label>
                                    <select class="form-select" id="category" name="category" required>
                                        <option value="{{ $data->category }}" hidden>{{ $data->category }}</option>
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->category_name }}">{{ $cat->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Gambar Produk -->
                            <div class="mb-3">
                                <label for="current_image" class="form-label">Gambar Produk Saat Ini</label>
                                <div>
                                    <img src="/products/{{ $data->image }}" alt="Gambar Produk" width="150"
                                        class="img-thumbnail">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="new_image" class="form-label">Gambar Baru (Opsional)</label>
                                <input type="file" class="form-control" id="new_image" name="image">
                            </div>
                            <!-- Tombol Submit -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Update Produk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
