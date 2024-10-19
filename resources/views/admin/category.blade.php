<!DOCTYPE html>
<html>
  <head>
    {{-- Dashboard --}}
    @include('admin.css')

    <style type="text/css">
    input[type='text']{
        width: 400px;
        height: 50px;
    }

    .div_deg{
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 30px;
    }

    .table_deg{
        text-align: center;
        margin: auto;
        border: 2px solid yellowgreen;
        margin-top: 50px;
        width: 600px;
    }

    th{
        background-color: skyblue;
        padding: 15px;
        font-size: 20px;
        font-weight: bold;
        color: white;
    }

    td{
        color: white;
        padding: 10px;
        border: 1px solid skyblue;
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
              <h1 style="color: white">Add Category</h1>
            <div class="div_deg">
                <form action="{{ url('add_category') }}" method="POST">
                    @csrf
                    <div class="">
                        <input type="text" name="category">

                        <input type="submit" value="Add Category" class="btn btn-primary">
                    </div>
                </form>
            </div>

            <div class="">
                <table class="table_deg">
                    <tr>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                    @foreach ($data as $data)
                        <tr>
                            <td>{{ $data->category_name }}</td>
                            <td><a href="{{ url('delete_category', $data->id) }}" class="btn btn-danger" onclick="confirmation(event)">Hapus</a>
                            <a class="btn btn-success" href="{{ url('edit_category', $data->id) }}">Edit</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
          </div>
          </div>
       </div>

    <!-- JavaScript files-->
    <script type="text/javascript">
        function confirmation(event) {
            event.preventDefault();
            var urlToRedirect = event.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
                title: "Apakah Anda yakin untuk menghapus kategori ini?",
                text: "Kategori akan dihapus secara permanen",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willCancel) => {
                if (willCancel){
                    window.location.href = urlToRedirect;
                }
            });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
