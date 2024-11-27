<!DOCTYPE html>
<html>

<head>
    {{-- Dashboard --}}
    @include('admin.css')

    <style>
        .div_deg {
            display: flex;
            justify-content: center;
            align-content: center;
        }

        label {
            display: inline-block;
            width: 200px;
            padding: 20px;
        }

        input[type='text'] {
            width: 300px;
            height: 60px;
        }

        textarea {
            width: 450px;
            height: 100px;
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
                <h2>Edit Suppplier</h2>
                <div class="div_deg">
                    <form action="{{ url('update_supplier', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="">
                            <label for="">Nama Panti Asuhan</label>
                            <input type="text" name="nama_panti_asuhan" value="{{ $data->nama_panti_asuhan }}">
                        </div>
                        <div class="">
                            <label for="">Kontak</label>
                            <input type="text" name="kontak" value="{{ $data->kontak }}">
                        </div>
                        <div class="">
                            <label for="">Alamat</label>
                            <input type="text" name="alamat" value="{{ $data->alamat }}">
                        </div>
                        <div class="">
                            <input type="submit" class="btn btn-success" value="Update Produk">
                        </div>
                    </form>
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
