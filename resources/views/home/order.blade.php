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
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
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

                @foreach ($order as $order)
                    <tr>
                        <td>{{ $order->product->title }}</td>
                        <td>{{ $order->product->price }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>
                            <img height="150" src="products/{{ $order->product->image }}" alt="">
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>

    @include('home.footer')
</body>

</html>
