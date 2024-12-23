<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        h1, h2
        {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Laporan Penjualan</h1>
    <h2>Sonia Handcraft</h2>
    <table>
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Product Title</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->name }}</td>
                <td>{{ $order->rec_address }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->product->title }}</td>
                <td>Rp. {{ number_format($order->product->price, 0, ',', '.') }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
