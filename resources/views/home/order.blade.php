<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Orders Page</title>

    @include('home.css')
</head>

<body>
    <div class="hero_area">
        @include('home.header')
        <!-- Page Title -->
        <div class="text-center my-5">
            <h1>My Orders</h1>
            <p class="text-muted">Check the status and details of your recent orders below.</p>
        </div>

        <!-- Orders Table -->
        <div class="table-container">
            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Products</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Images</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <!-- Order ID -->
                            <td class="order-id">{{ $order->id }}</td>

                            <!-- Products -->
                            <td>
                                <ul class="list-unstyled">
                                    @foreach ($order->products as $product)
                                        <li>{{ $product->title }} X {{ $product->pivot->quantity }}</li>
                                    @endforeach
                                </ul>
                            </td>

                            <!-- Total Price -->
                            <td>
                                @php
                                    $totalPrice = $order->products->sum(function ($product) {
                                        return $product->price * $product->pivot->quantity;
                                    });
                                @endphp
                                <span class="text-success fw-bold">Rp
                                    {{ number_format($totalPrice, 0, ',', '.') }}</span>
                            </td>
                            <!-- Status -->
                            <td>
                                <span
                                    class="badge 
                            @if ($order->status == 'Pending') bg-warning 
                            @elseif ($order->status == 'On the way') bg-info 
                            @elseif ($order->status == 'Delivered') bg-success 
                            @else bg-primary @endif">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <!-- Images -->
                            <td class="product-images">
                                @foreach ($order->products as $product)
                                    <img src="{{ $product->image ? asset('storage/products/' . $product->image) : asset('images/placeholder.png') }}"
                                        alt="Product Image">
                                @endforeach
                            </td>
                            <td>
                                @if ($order->status === 'Pending' && (!$order->transaction || !$order->transaction->payment_proof))
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('transaction.upload') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <label for="payment_proof">Upload Bukti Pembayaran:</label>
                                        <input type="file" id="payment_proof" name="payment_proof" required>
                                        <button type="submit" class="btn btn-primary mt-3">Upload</button>
                                    </form>
                                @else
                                    <span class="text-muted">Bukti pembayaran sudah diunggah.</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('home.footer')
    @include('home.scripts')
</body>

</html>
