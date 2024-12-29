<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    @include('home.css')
    <style>
        .checkout-container {
            margin: 10px auto;
            padding: 20px;
            width: 1000px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .cart-summary {
            background-color: #fafafa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .cart-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .cart-item-details {
            flex: 1;
            margin-left: 15px;
        }

        .cart-item-price {
            font-weight: bold;
        }

        .total {
            font-size: 1.2rem;
            font-weight: bold;
            margin-top: 10px;
            text-align: right;
        }

        .form-section {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="checkout-container">
        <h1 class="text-center mb-4">Checkout</h1>

        <!-- Section: Cart Summary -->
        <div class="cart-summary">
            <div class="section-title">Ringkasan Keranjang</div>
            @foreach ($carts as $cart)
                <div class="cart-item">
                    <img src="{{ asset('storage/products/' . $cart->product->image ?? 'https://via.placeholder.com/80') }}"
                        alt="{{ $cart->product->name }}">

                    <div class="cart-item-details">
                        <span>{{ $cart->product->name }}</span>
                        <div>x{{ $cart->quantity }}</div>
                    </div>
                    <div class="cart-item-price">Rp
                        {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</div>
                </div>
            @endforeach
            <div class="total">
                Total: Rp
                {{ number_format($carts->sum(function ($cart) {return $cart->product->price * $cart->quantity;}),0,',','.') }}
            </div>
        </div>

        <!-- Section: Shipping Information -->
        <div class="form-section">
            <div class="section-title">Alamat Pengiriman</div>
            <form action="{{ url('processCheckout') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Penerima</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama lengkap"
                        value="{{ Auth::user()->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="rec_address" class="form-label">Alamat Penerima</label>
                    <textarea class="form-control" id="address" name="rec_address" rows="3"
                        placeholder="Contoh: Jl. Merdeka No.123, Kelurahan ABC, Kota XYZ" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon</label>
                    <input type="tel" class="form-control" id="phone" name="phone"
                        placeholder="Nomor telepon aktif" value="{{ Auth::user()->phone }}" pattern="\d{10,15}"
                        title="Nomor telepon harus berupa angka dan memiliki 10-15 digit" required>
                </div>

                <div class="form-section">
                    <div class="section-title">Metode Pembayaran</div>
                    <select class="form-select mb-3" name="payment" required>
                        <option value="" disabled selected>Pilih metode pembayaran</option>
                        <option value="credit_card">Kartu Kredit</option>
                        <option value="transfer_bank">Transfer Bank</option>
                        <option value="cod">Bayar di Tempat (COD)</option>

                    </select>
                </div>

                <div class="d-grid gap-2">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <button type="submit" class="checkout-btn">Konfirmasi Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
    
    @include('home.scripts')
</body>

</html>
