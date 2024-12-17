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

        h1 {
            color: white;
        }

        label {
            display: inline-block;
            width: 200px;
            font-size: 18px !important;
            color: white !important;
        }

        input[type='text'] {
            width: 350px;
            height: 50px;
        }

        textarea {
            width: 450px;
            height: 80px;
        }

        .input_deg {
            padding: 15px;
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
                <h1>Tambah Produk</h1>
                <div class="div_deg">
                    <form action="{{ url('upload_product') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input_deg">
                            <label for="">Nama Produk</label>
                            <input type="text" name="title" required>
                        </div>
                        <div class="input_deg">
                            <label for="">Deskripsi Produk</label>
                            <textarea type="text" name="description" required></textarea>
                        </div>
                        <div class="input_deg">
                            <label for="">Harga Produk</label>
                            <input type="text" name="price" required>
                        </div>
                        <div class="input_deg">
                            <label for="">Jumlah Stok Produk</label>
                            <input type="number" name="stock" required>
                        </div>
                        <div class="input_deg">
                            <label for="">Kategori Produk</label>
                            <select name="category" required>
                                <option value="" hidden>Pilih kategori produk</option>
                                @foreach ($category as $category)
                                    <option value="{{ $category->category_name }}">{{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input_deg">
                            <label for="">Gambar Produk</label>
                            <input type="file" name="image">
                        </div>
                        <div class="input_deg">
                            <input class="btn btn-success" type="submit" value="Tambah Produk" required>
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
