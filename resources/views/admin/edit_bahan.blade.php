@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-3">Edit Bahan Baku</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('bahan.update', $bahan->id_bahanbaku) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Nama Bahan Baku -->
                            <div class="mb-3">
                                <label for="nama_bahan" class="form-label">Nama Bahan Baku</label>
                                <input class="form-control" id="nama_bahan" name="nama_bahan" type="text"
                                    value="{{ $bahan->nama_bahan }}" placeholder="Masukkan nama bahan baku" required />
                            </div>
                            <!-- Jumlah Bahan Baku -->
                            <div class="mb-3">
                                <label for="jumlah_bahan" class="form-label">Jumlah Bahan Baku</label>
                                <input class="form-control" id="jumlah_bahan" name="jumlah_bahan" type="number"
                                    value="{{ $bahan->jumlah_bahan }}" placeholder="Masukkan jumlah bahan baku" required />
                            </div>
                            <!-- Satuan -->
                            <div class="mb-3">
                                <label for="satuan" class="form-label">Satuan</label>
                                <select class="form-select" id="satuan" name="satuan" required>
                                    <option value="" hidden>Pilih satuan bahan baku</option>
                                    <option value="gram" {{ $bahan->satuan == 'gram' ? 'selected' : '' }}>Gram</option>
                                    <option value="meter" {{ $bahan->satuan == 'meter' ? 'selected' : '' }}>Meter</option>
                                    <option value="kilogram" {{ $bahan->satuan == 'kilogram' ? 'selected' : '' }}>Kilogram
                                    </option>
                                    <option value="kodi" {{ $bahan->satuan == 'kodi' ? 'selected' : '' }}>Kodi</option>
                                </select>
                            </div>
                            <!-- Harga Bahan -->
                            <div class="mb-3">
                                <label for="harga_bahan" class="form-label">Harga Bahan</label>
                                <input class="form-control" id="harga_bahan" name="harga_bahan" type="number"
                                    value="{{ $bahan->harga_bahan }}" placeholder="Masukkan harga bahan per satuan"
                                    required />
                            </div>
                            <!-- Tombol Submit -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Update Bahan Baku</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
