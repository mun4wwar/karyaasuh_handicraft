<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style>
        .checkout-container {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 170px;
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .checkout-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .checkout-header h1 {
            font-size: 28px;
            color: #333;
        }

        .checkout-header p {
            font-size: 16px;
            color: #555;
        }

        .product-list {
            margin-bottom: 30px;
        }

        .product-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .product-item img {
            width: 80px;
            height: auto;
            border-radius: 5px;
        }

        .product-info {
            flex: 1;
            margin-left: 15px;
        }

        .product-price {
            font-weight: bold;
            color: #333;
        }

        .summary {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
            text-align: right;
        }

        .checkout-form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .checkout-form h2 {
            font-size: 22px;
            margin-bottom: 20px;
        }

        .checkout-form label {
            display: block;
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
        }

        .checkout-form input,
        .checkout-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .checkout-form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .checkout-form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        @include('home.header')
    </div>

    <div class="checkout-container">
        <!-- Header -->
        <div class="checkout-header">
            <h1>Checkout</h1>
            <p>Pastikan semua informasi sudah benar sebelum melanjutkan pembayaran.</p>
        </div>

        <!-- Product List -->
        <div class="product-list">
            @foreach ($cart as $item)
                <div class="product-item">
                    <img src="/products/{{ $item->product->image }}" alt="Product Image">
                    <div class="product-info">
                        <h4>{{ $item->product->title }}</h4>
                        <p class="product-price">Rp. {{ number_format($item->product->price, 0, ',', '.') }}</p>
                    </div>
                    <p>Jumlah: {{ $item->quantity }}</p>
                </div>
            @endforeach
        </div>

        <!-- Summary -->
        <div class="summary">
            Total Harga: Rp. {{ number_format($total, 0, ',', '.') }}
        </div>

        <!-- Checkout Form -->
        <div class="checkout-form">
            <h2>Informasi Pengiriman</h2>
            <form action="{{ url('confirm_order') }}" method="POST">
                @csrf
                <label for="name">Nama Penerima</label>
                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" readonly>

                <label for="address">Alamat Pengiriman</label>
                <textarea id="address" name="address" rows="3">{{ Auth::user()->address }}</textarea>

                <label for="phone">Nomor Telepon</label>
                <input type="text" id="phone" name="phone" value="{{ Auth::user()->phone }}" readonly>

                <button type="submit">Proses Pembayaran</button>
            </form>
        </div>
    </div>

    @include('home.footer')
</body>

</html>
