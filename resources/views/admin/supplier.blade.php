<!DOCTYPE html>
<html>

<head>
    {{-- Dashboard --}}
    @include('admin.css')

    <style type="text/css">
        .div_deg {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }

        .table_deg {
            border: 2px solid gree
        }

        th {
            background-color: skyblue;
            color: white;
            font-size: 19px;
            font-weight: bold;
            padding: 15px;
        }

        td {
            border: 1px solid skyblue;
            text-align: center;
            color: white;
        }

        input[type='search'] {
            width: 500px;
            height: 60px;
            margin-left: 50px;
        }
    </style>
</head>

<body>
    {{-- Dashboard Header --}}
    @include('admin.header')

    {{-- Dashboard Sidebar --}}
    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h1 style="margin-left: 50px">Daftar Supplier Kerajinan</h1>

                <form action="{{ url('product_search') }}" method="GET">
                    @csrf
                    <input type="search" name="search">
                    <input type="submit" class="btn btn-success" value="Search">
                </form>

                <div class="div_deg">
                    <table class="table_deg">
                        <tr>
                            <th>No</th>
                            <th>Nama Panti Asuhan</th>
                            <th>Kontak</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
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
                    </table>
                </div>
                <div class="div_deg">
                    {{ $suppliers->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript files-->
    <script src="{{ asset('/admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('/admincss/js/front.js') }}"></script>
</body>

</html>
