<!DOCTYPE html>
<html lang="id">

<head>
    @include('home.css')
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
                            <button type="submit" name="action" value="decrease" class="quantity-btn"
                                aria-label="Kurangi jumlah">-</button>

                            <!-- Input Jumlah Item -->
                            <input type="number" name="quantity" value="{{ $item->quantity }}"
                                style="width: 50px; text-align: center; border: 1px solid #ddd; border-radius: 4px;"
                                min="1">

                            <!-- Tombol Tambah -->
                            <button type="submit" name="action" value="increase" class="quantity-btn"
                                aria-label="Tambah jumlah">+</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif

        <!-- Summary -->
        <div class="cart-summary">
            <h3>Ringkasan Belanja</h3>
            <div class="summary-item">
                <span>Total Belanja Anda:</span>
                <span>Rp. {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <div class="summary-item summary-total">
                <span>Total</span>
                <span>Rp. {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <a class="checkout-btn" href="{{ route('checkoutPage') }}">Lanjutkan ke Checkout</a>
        </div>
    </div>
    
    @include('home.footer')
    
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

</body>

</html>
