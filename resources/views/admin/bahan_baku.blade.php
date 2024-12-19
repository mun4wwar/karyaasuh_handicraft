@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Daftar Bahan Baku</h1>
        <ol class="breadcrumb mb-4">
            <form action="{{ url('bahanBaku_search') }}" method="GET">
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
                            <th>Nama Bahan</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Harga per Satuan</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Bahan</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Harga per Satuan</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($bahan_baku as $bahan)
                            <tr>
                                <td>{{ $bahan->nama_bahan }}</td>
                                <td>{{ $bahan->jumlah_bahan }}</td>
                                <td>{{ $bahan->satuan }}</td>
                                <td>Rp{{ number_format($bahan->harga_bahan, 2) }}</td>
                                <td>Rp{{ number_format($bahan->total_hargabahan, 2) }}</td>
                                <td>
                                    <a href="{{ route('bahan.edit', $bahan->id_bahanbaku) }}"
                                        class="btn btn-warning">Edit</a>
                                    <form action="{{ route('bahan.destroy', $bahan->id_bahanbaku) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
