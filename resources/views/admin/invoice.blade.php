<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice #{{ $data->id }} - {{ $data->name }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin-top: 50px;
            padding: 0;
        }
        .container {
            width: 280px;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 10px;
        }
        .header, .footer {
            text-align: center;
        }
        .header h2 {
            margin: 0;
            padding: 5px 0;
        }
        .footer p {
            font-size: 12px;
        }
        .invoice-details {
            margin-top: 10px;
        }
        .invoice-details h3 {
            margin: 5px 0;
            font-size: 14px;
        }
        .product {
            margin-top: 10px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #000;
        }
        .product h4 {
            margin: 5px 0;
            font-size: 12px;
        }
        .total {
            font-weight: bold;
            margin-top: 15px;
            text-align: center;
        }
        .status {
            margin-top: 10px;
            text-align: center;
            font-weight: bold;
        }
        .line {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2>INVOICE</h2>
            <p>Order ID: {{ $data->id }}</p>
        </div>

        <!-- Invoice Details -->
        <div class="invoice-details">
            <h3>Customer Name: {{ $data->name }}</h3>
            <h3>Address: {{ $data->rec_address }}</h3>
            <h3>Phone: {{ $data->phone }}</h3>
        </div>

        <!-- Products -->
        <div class="products">
            @php
                $totalAmount = 0;
            @endphp
            @foreach ($data->products as $product)
                <div class="product">
                    <h4>Product: {{ $product->title }}</h4>
                    <h4>Qty: {{ $product->pivot->quantity }} | Price: Rp. {{ number_format($product->price, 0, ',', '.') }}</h4>
                    <h4>Total: Rp. {{ number_format($product->price * $product->pivot->quantity, 0, ',', '.') }}</h4>
                </div>
                @php
                    $totalAmount += $product->price * $product->pivot->quantity;
                @endphp
            @endforeach
        </div>

        <!-- Total Amount -->
        <div class="line"></div>
        <div class="total">
            <h3>Total: Rp. {{ number_format($totalAmount, 0, ',', '.') }}</h3>
        </div>

        <!-- Payment Status -->
        <div class="status">
            <h3>Payment Status: 
                @if ($data->transaction->payment_status == 'paid')
                    Paid
                @elseif($data->transaction->payment_status == 'confirmed')
                    Confirmed
                @else
                    Unpaid
                @endif
            </h3>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Thank you for shopping with us!</p>
        </div>
    </div>
</body>
</html>
