<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Orders Page</title>

    @include('home.css')

    <style type="text/css">
        .div_center {
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 80px;
            margin: 50px;
        }

        table {
            border: 2px solid black;
            text-align: center;
            width: 800px;
        }

        th {
            border: 2px solid skyblue;
            background-color: black;
            color: white;
            font-size: 19px;
            font-weight: bold;
            text-align: center;
        }

        td {
            border: 2px solid skyblue;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        @include('home.header')

        <h1 class="text-center mt-5">My Orders</h1>
        <div class="div_center">
            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Delivery Status</th>
                    <th>Quantity</th>
                    <th>Image</th>
                </tr>

                @foreach ($orders as $productName => $productOrders)
                    <tr>
                        <td rowspan="{{ count($productOrders) }}">{{ $productName }}</td>
                        <td rowspan="{{ count($productOrders) }}">
                            {{ $productOrders->first()->product->price }}
                        </td>
                        <td>{{ $productOrders->first()->status }}</td>
                        <td>{{ $productOrders->first()->quantity }}</td>
                        <td rowspan="{{ count($productOrders) }}">
                            @if ($productOrders->first()->product && $productOrders->first()->product->image)
                                <img height="150"
                                    src="{{ asset('storage/products/' . $productOrders->first()->product->image) }}"
                                    alt="">
                            @else
                                <span>Image not available</span>
                            @endif
                        </td>
                    </tr>
                    @foreach ($productOrders->slice(1) as $order)
                        <tr>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->quantity }}</td>
                        </tr>
                    @endforeach
                @endforeach




            </table>
        </div>

    </div>

    @include('home.footer')
</body>

</html>
