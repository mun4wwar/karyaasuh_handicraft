<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style type="text/css">
        /* Container utama */
        .cart-container {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 170px;
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cart-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .cart-header h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
        }

        .cart-header p {
            color: #777;
            font-size: 16px;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            font-weight: 600;
        }

        td img {
            max-width: 80px;
            height: auto;
            border-radius: 5px;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            font-size: 14px;
            padding: 10px 15px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #ff4d4d;
            color: #fff;
            border: none;
            font-size: 14px;
            padding: 8px 12px;
            border-radius: 4px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #cc0000;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-info {
            background-color: #17a2b8;
            color: white;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        /* Quantity field */
        .quantity-field .btn-info {
            background-color: #007bff;
            color: #fff;
            border: none;
            font-size: 16px;
            padding: 5px 10px;
            border-radius: 50%;
            transition: 0.3s ease;
        }

        .quantity-field .btn-info:hover {
            background-color: #0056b3;
            transform: scale(1.1);
        }

        /* Order form */
        .order-form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .order-form h2 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #333;
        }

        .order-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .order-form input,
        .order-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .order-form button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .order-form button:hover {
            background-color: #0056b3;
        }

        /* Total belanja */
        .cart-value {
            text-align: right;
            font-size: 20px;
            color: #333;
            font-weight: bold;
            margin-top: 30px;
            padding: 15px 20px;
            background: linear-gradient(to right, #007bff, #00c6ff);
            border-radius: 8px;
            color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cart-value span {
            font-size: 24px;
            font-weight: 700;
        }

        /* Responsiveness */
        @media (max-width: 768px) {

            th,
            td {
                font-size: 14px;
            }

            .quantity-field input[type="number"] {
                width: 40px;
            }
        }
    </style>


</head>

<body>
    <div class="hero_area">

        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

    </div>
    <div class="cart-container">
        <!-- Header -->
        <div class="cart-header">
            <h1>Keranjang Belanja</h1>
            <p>Periksa kembali produk yang ingin Anda beli sebelum melanjutkan ke checkout.</p>
        </div>

        <!-- Order Form -->
        <div class="order-form">
            <h2>Informasi Pengiriman</h2>
            <form action="{{ url('confirm_order') }}" method="POST">
                @csrf
                <label for="name">Nama Penerima</label>
                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" readonly>

                <label for="address">Alamat</label>
                <textarea id="address" name="address" rows="3">{{ Auth::user()->address }}</textarea>

                <label for="phone">Nomor Telepon</label>
                <input type="text" id="phone" name="phone" value="{{ Auth::user()->phone }}" readonly>

                <button type="submit" class="btn-primary">Check Out</button>
            </form>
        </div>

        <!-- Cart Table -->
        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $value = 0; ?>
                @foreach ($cart as $cart)
                    <tr>
                        <td>{{ $cart->product->title }}</td>
                        <td>Rp. {{ $cart->product->price }}</td>
                        <td><img width="150" src="/products/{{ $cart->product->image }}" alt=""></td>
                        <td>
                            <form action="{{ url('update_cart_quantity', $cart->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                <button type="submit" name="action" value="decrease" class="btn btn-info">-</button>
                                <input type="number" name="quantity" value="{{ $cart->quantity }}"
                                    style="width: 50px; text-align: center;">
                                <button type="submit" name="action" value="increase" class="btn btn-info">+</button>
                            </form>
                        </td>

                        <td>
                            <a class="btn btn-danger"
                                onclick="confirmDelete('{{ url('delete_cart', $cart->id) }}')">Hapus</a>
                        </td>
                    </tr>

                    <?php
                    $value = $value + $cart->product->price * $cart->quantity;
                    ?>
                @endforeach
            </tbody>
        </table>

        <!-- Total Belanja -->
        <div class="cart-value">
            Total Belanja Anda: <span>Rp {{ number_format($value, 0, ',', '.') }}</span>
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- info section -->
    @include('home.footer')

</body>

</html>
