@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <!-- Flash Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="clearfix m-4">
            <a href="{{ url('laporan_penjualan') }}" class="btn btn-primary float-right">Cetak Laporan Penjualan</a>
        </div>
        {{-- include tabel order --}}
        @include('admin.tabel_order')
    </div>
@endsection
