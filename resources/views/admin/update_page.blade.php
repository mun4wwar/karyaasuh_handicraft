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
                <h2>Update Produk</h2>
                <div class="div_deg">
                    <form action="{{ url('edit_product', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="">
                            <label for="">Nama Produk</label>
                            <input type="text" name="title" value="{{ $data->title }}">
                        </div>
                        <div class="">
                            <label for="">Deskripsi</label>
                            <textarea name="description">{{ $data->description }}</textarea>
                        </div>
                        <div class="">
                            <label for="">Harga Produk</label>
                            <input type="text" name="price" value="{{ $data->price }}">
                        </div>
                        <div class="">
                            <label for="">Jumlah Stok Produk</label>
                            <input type="number" name="stock" value="{{ $data->stock }}">
                        </div>
                        <div class="">
                            <label for="">Kategori</label>
                            <select name="category">
                                <option value="{{ $data->category }}" hidden>{{ $data->category }}</option>
                                @foreach ($category as $category)
                                    <option value="{{ $category->category_name }}">{{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                            <label for="">Gambar Produk</label>
                            <img width="150" src="/products/{{ $data->image }}">
                        </div>
                        <div class="">
                            <label for="">Gambar Baru Produk</label>
                            <input type="file" name="image">
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
