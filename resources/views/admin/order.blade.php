<!DOCTYPE html>
<html>

<head>
    {{-- Dashboard --}}
    @include('admin.css')
    <style>
        table {
            border: 2px solid beige;
            text-align: center;
        }

        th {
            background-color: rgb(27, 27, 100);
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }

        td {
            color: white;
            padding: 10px;
            border: 1px solid beige;
        }

        .table_center {
            display: flex;
            justify-content: center;
            align-items: center;
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
                <div class="table_center">
                    <table>
                        <tr>
                            <th>Costumer Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Product Title</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Change Status</th>
                            <th>Print PDF</th>
                        </tr>

                        @foreach ($data as $order)
                            <tr>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->rec_address }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->product->title }}</td>
                                <td>Rp. {{ $order->product->price }}</td>
                                <td><img width="150" src="products/{{ $order->product->image }}" alt="Product Image">
                                </td>
                                <td>{{ $order->quantity }}</td>
                                <td>
                                    @if ($order->status == 'In progress')
                                        <span style="color: yellow">{{ $order->status }}</span>
                                    @elseif ($order->status == 'On the way')
                                        <span style="color: skyblue">{{ $order->status }}</span>
                                    @else
                                        <span style="color: rgb(0, 202, 0)">{{ $order->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-info" href="{{ url('on_the_way', $order->id) }}">On the way</a>
                                    <a class="btn btn-success" href="{{ url('delivered', $order->id) }}">Delivered</a>
                                </td>
                                <td>
                                    <a class="btn btn-secondary" href="{{ url('print_pdf',$order->id) }}">Print PDF</a>
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
                <!-- Pagination Links -->
                <div class="pagination-links" style="margin-top: 20px; display: flex; justify-content: center;">
                    {{ $data->links() }}
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
