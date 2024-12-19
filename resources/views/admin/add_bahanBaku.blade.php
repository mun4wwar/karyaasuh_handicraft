@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-3">Tambah Bahan Baku</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('bahan.store') }}" method="POST">
                            @csrf
                            <!-- Nama Bahan Baku -->
                            <div class="mb-3">
                                <label for="nama_bahan" class="form-label">Nama Bahan Baku</label>
                                <input class="form-control" id="nama_bahan" name="nama_bahan" type="text"
                                    placeholder="Masukkan nama bahan baku" required />
                            </div>
                            <!-- Jumlah Bahan Baku -->
                            <div class="mb-3">
                                <label for="jumlah_bahan" class="form-label">Jumlah Bahan Baku</label>
                                <input class="form-control" id="jumlah_bahan" name="jumlah_bahan" type="number"
                                    placeholder="Masukkan jumlah bahan baku" required />
                            </div>
                            <!-- Satuan -->
                            <div class="mb-3">
                                <label for="satuan" class="form-label">Satuan</label>
                                <select class="form-select" id="satuan" name="satuan" required>
                                    <option value="" hidden>Pilih satuan bahan baku</option>
                                    <option value="gram">Gram</option>
                                    <option value="meter">Meter</option>
                                    <option value="kilogram">Kilogram</option>
                                    <option value="kodi">Kodi</option>
                                </select>
                            </div>
                            <!-- Harga Bahan -->
                            <div class="mb-3">
                                <label for="harga_bahan" class="form-label">Harga Bahan</label>
                                <input class="form-control" id="harga_bahan" name="harga_bahan" type="number"
                                    placeholder="Masukkan harga bahan per satuan" required />
                            </div>
                            <!-- Tombol Submit -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Tambah Bahan Baku</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
