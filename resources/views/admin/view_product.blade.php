<!DOCTYPE html>
<html>
  <head>
    {{-- Dashboard --}}
    @include('admin.css')

    <style type="text/css">
        .div_deg{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }

        .table_deg{
            border: 2px solid gree
        }

        th{
            background-color: skyblue;
            color: white;
            font-size: 19px;
            font-weight: bold;
            padding: 15px;
        }

        td{
            border: 1px solid skyblue;
            text-align: center;
            color: white;
        }

        input[type='search']{
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
            <h1 style="margin-left: 50px">Daftar Produk Kerajinan</h1>

            <form action="{{ url('product_search') }}" method="GET">
                @csrf
                <input type="search" name="search">
                <input type="submit" class="btn btn-success" value="Search">
            </form>

            <div class="div_deg">
                <table class="table_deg">
                    <tr>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Gambar Produk</th>
                        <th>Aksi</th>
                    </tr>
                        @foreach ($product as $products)
                        <tr>
                            <td>{{ $products->title }}</td>
                            <td>{!!Str::limit($products->description, 50)!!}</td>
                            <td>{{ $products->price }}</td>
                            <td>{{ $products->category }}</td>
                            <td>{{ $products->quantity }}</td>
                            <td>
                                <img height="120" src="products/{{ $products->image }}" alt="">
                            </td>
                            <td><a class="btn btn-danger" href="{{ url('delete_product', $products->id) }}" >Hapus</a> <a class="btn btn-success" href="{{ url('update_product', $products->id) }}">Edit</a></td>

                            @endforeach
                        </tr>
                </table>
            </div>
            <div class="div_deg">
                {{ $product->onEachSide(1)->links() }}
            </div>
            </div>
          </div>
       </div>

    <!-- JavaScript files-->
    <script src="{{ asset('/admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ asset('/admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('/admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('/admincss/js/front.js') }}"></script>
  </body>
</html>
