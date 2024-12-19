<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style type="text/css">
        /* Breadcrumb */
        .breadcrumb {
            margin: 20px 0;
            font-size: 14px;
            padding-top: 125px;
        }

        .breadcrumb a {
            color: #007bff;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        /* Cart Container */
        .cart-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Product Grid */
        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .cart-item img {
            max-width: 80px;
            border-radius: 5px;
        }

        .cart-item-info {
            flex: 1;
            margin-left: 20px;
        }

        .cart-item-title {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
        }

        .cart-item-price {
            font-size: 14px;
            color: #777;
        }

        .cart-item-actions {
            display: flex;
            align-items: center;
        }

        .quantity-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            margin: 0 5px;
        }

        .quantity-btn:hover {
            background-color: #0056b3;
        }

        .save-later,
        .delete-item {
            color: #ff4d4d;
            font-size: 14px;
            text-decoration: underline;
            cursor: pointer;
            margin-left: 10px;
        }

        .save-later:hover,
        .delete-item:hover {
            color: #cc0000;
        }

        /* Summary */
        .cart-summary {
            margin-top: 30px;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            /* Tambahkan ini */
        }

        .cart-summary h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 15px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .summary-total {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .checkout-btn {
            display: inline-block;
            align-items: center;
            width: 100%;
            padding: 15px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            text-align: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px auto;
            /* Perbaikan di sini */
        }

        .checkout-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        @include('home.header')
    </div>

    <div class="cart-container">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/shop">Shop</a> > <span>Keranjang Belanja</span>
        </div>

        <!-- Cart Items -->
        <h1>Keranjang Belanja</h1>
        @if ($cart->isEmpty())
            <p>Keranjang Anda kosong. <a href="/shop">Belanja sekarang</a></p>
        @else
            @foreach ($cart as $item)
                <div class="cart-item">
                    <img src="{{ asset('storage/products/' . $item->product->image) }}" alt="{{ $item->product->title }}">
                    <div class="cart-item-info">
                        <div class="cart-item-title">{{ $item->product->title }}</div>
                        <div class="cart-item-price">Rp. {{ number_format($item->product->price, 0, ',', '.') }}</div>
                    </div>
                    <div class="cart-item-actions">
                        <form action="{{ url('update_cart_quantity', $item->id) }}" method="POST"
                            style="display: flex; align-items: center;">
                            @csrf
                            <!-- Tombol Kurangi -->
                            <button type="submit" name="action" value="decrease" class="quantity-btn">-</button>

                            <!-- Input Jumlah Item -->
                            <input type="number" name="quantity" value="{{ $item->quantity }}"
                                style="width: 50px; text-align: center; border: 1px solid #ddd; border-radius: 4px;"
                                readonly>

                            <!-- Tombol Tambah -->
                            <button type="submit" name="action" value="increase" class="quantity-btn">+</button>
                        </form>
                    </div>
                </div>
            @endforeach


        @endif

        <!-- Summary -->
        <div class="cart-summary">
            <h3>Ringkasan Belanja</h3>
            <div class="summary-item">
                @if ($total > 0)
                    <span>Total Belanja Anda:</span>
                    <span>Rp. {{ number_format($total, 0, ',', '.') }}</span>
                @else
                    Total Belanja Anda: <span>Rp 0</span>
                @endif
            </div>
            <div class="summary-item summary-total">
                <span>Total</span>
                <span>Rp. {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <a class="checkout-btn" href="{{ route('checkoutPage') }}">Lanjutkan ke Checkout</a>
        </div>
    </div>

    <script>
        function confirmDelete(url) {
            Swal.fire({
                title: 'Hapus Produk?',
                text: 'Produk akan dihapus dari keranjang Anda.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>

    @include('home.footer')
</body>

</html>
