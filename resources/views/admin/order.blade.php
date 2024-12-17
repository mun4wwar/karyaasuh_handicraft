@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="clearfix m-4">
            <a href="{{ url('laporan_penjualan') }}" class="btn btn-primary float-right">Cetak Laporan Penjualan</a>
        </div>
        {{-- include tabel order --}}
        @include('admin.tabel_order')
</div>
@endsection
