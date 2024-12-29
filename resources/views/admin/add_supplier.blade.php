@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-3">Tambah Data Supplier</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('upload_supplier') }}" method="POST">
                            @csrf
                            <!-- Nama Bahan Baku -->
                            <div class="mb-3">
                                <label for="nama_panti_asuhan" class="form-label">Nama Panti Asuhan</label>
                                <input class="form-control" id="nama_panti_asuhan" name="nama_panti_asuhan" type="text"
                                    placeholder="Masukkan Nama Supplier" required />
                            </div>
                            <!-- Jumlah Bahan Baku -->
                            <div class="mb-3">
                                <label for="kontak">Kontak</label>
                                <input type="text" name="kontak" class="form-control" required>
                            </div>
                            <!-- Satuan -->
                            <div class="mb-3">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" class="form-control" required></textarea>
                            </div>
                            <!-- Tombol Submit -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Tambah Supplier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
