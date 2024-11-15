<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style type="text/css">
        /* .main-content { */
        /* } */

        .div_deg {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 60px;
        }

        table {
            border: 2px solid black;
            text-align: center;
            width: 800px;
        }

        th {
            border: 2px solid black;
            text-align: center;
            color: white;
            font: 20px;
            font-weight: :bold;
            background-color: black;
        }

        td {
            border: 1px solid skyblue;
        }

        .cart_value {
            text-align: center;
            margin-bottom: 70px;
            padding: 18px;
        }

        .order_deg {
            padding-right: 100px;
            margin-top: -50px;
        }

        label {
            display: inline-block;
            width: 150px;
        }

        .div_gap {
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="hero_area">

        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

    </div>
    <div class="div_deg">
        <div class="order_deg">
            <form action="{{ url('confirm_order') }}" method="POST">
                @csrf
                <div class="div_gap">
                    <label for="">Reciever Name</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" readonly>
                </div>
                <div class="div_gap">
                    <label for="">Reciever Address</label>
                    <textarea name="address">{{ Auth::user()->address }}</textarea>
                </div>
                <div class="div_gap">
                    <label for="">Reciever Phone</label>
                    <input type="text" name="phone" value="{{ Auth::user()->phone }}" readonly>
                </div>
                <div class="div_gap">
                    <input class="btn btn-primary" type="submit" value="Place Order" onclick="ConfirmOrder">
                </div>
            </form>
        </div>
        <table>
            <tr>
                <th>Product Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>

            <?php
            
            $value = 0;
            
            ?>

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
                            <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1"
                                style="width: 50px; text-align: center;" readonly>
                            <button type="submit" name="action" value="increase" class="btn btn-info">+</button>
                        </form>
                    </td>

                    <td>
                        <a class="btn btn-danger"
                            onclick="confirmDelete('{{ url('delete_cart', $cart->id) }}')">Hapus</a>
                    </td>
                </tr>

                <?php
                $value = $value + ($cart->product->price * $cart->quantity);
                ?>
            @endforeach

        </table>
    </div>

    <div class="cart_value">
        <h3>Total belanja anda : Rp. {{ $value }}</h3>
    </div>
    <script>
        function confirmDelete(url) {
            Swal.fire({
                title: 'Apakah Anda yakin untuk menghapus barang ini dari keranjang mu?',
                text: 'barang di hapus dari keranjang',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus barang ini.'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                    Swal.fire(
                        'Deleted!',
                        'Your item has been deleted.',
                        'success'
                    );
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
