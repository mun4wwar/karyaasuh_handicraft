<!DOCTYPE html>
<html>

<head>
    @include('home.css')

    <style>
        .shop_section {
            padding-top: 170px;
        }

        .heading_container h2 {
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .box {
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        .box:hover {
            transform: translateY(-5px);
        }

        .img-box img {
            /* width: 100%; */
            max-height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .detail-box {
            text-align: center;
            /* Pastikan teks di tengah */
            display: flex;
            flex-direction: column;
            /* Pastikan elemen diatur secara vertikal */
            align-items: center;
            /* Agar elemen tetap di tengah */
            gap: 5px;
            /* Memberikan jarak antar elemen */
        }

        .product-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
            /* Beri jarak dengan harga */
        }

        .product-price {
            margin-top: 5px;
            font-size: 14px;
            color: #ff6f61;
            font-weight: bold;
        }

        .detail-box span {
            font-size: 14px;
            color: #555;
        }

        .text-danger,
        .text-warning,
        .text-success {
            font-size: 14px;
            font-weight: bold;
            margin-top: 10px;
        }

        .stock-info .btn {
            font-size: 14px;
            padding: 8px 15px;
            border-radius: 20px;
            margin-top: 0px;
            text-transform: capitalize;
        }

        .stock-info .btn-danger {
            background-color: #e74c3c;
            color: #fff;
            border: none;
        }

        .btn-primary {
            background-color: #3498db;
            color: #fff;
            border: none;
        }

        .stock-info .btn-secondary {
            background-color: #bdc3c7;
            color: #fff;
            border: none;
        }

        .btn-box {
            text-align: center;
            margin-top: 30px;
        }

        .btn-box a {
            display: inline-block;
            background-color: #ff6f61;
            color: #fff;
            padding: 10px 20px;
            border-radius: 20px;
            text-transform: uppercase;
            font-weight: bold;
            text-decoration: none;
        }

        .btn-box a:hover {
            background-color: #e74c3c;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

    </div>
    <!-- end hero area -->

    <!-- shop section -->

    <section class="shop_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Our Products
                </h2>
            </div>
            <div class="row"> <!-- Tambahkan gap antar produk -->
                @foreach ($product as $products)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="box">
                            <div class="img-box">
                                <img src="{{ asset('storage/products/' . $products->image) }}" alt="{{ $products->title }}">
                            </div>
                            <div class="detail-box">
                                <h6 class="product-name">{{ $products->title }}</h6> <!-- Nama produk -->
                                <h6 class="product-price">Rp. {{ number_format($products->price, 0, ',', '.') }}</h6>
                                <!-- Harga produk -->
                            </div>


                            <div class="stock-info">
                                <!-- Info stok -->
                                @if ($products->stock == 0)
                                    <p class="text-danger"><i class="bi bi-x-circle-fill"></i>Stok habis</p>
                                @elseif ($products->stock < 10)
                                    <p class="text-warning"><i class="bi bi-dash-circle-fill"></i> Stok menipis,
                                        ({{ $products->stock }} tersisa)
                                    </p>
                                @else
                                    <p class="text-success"><i class="bi bi-check-circle-fill"></i> Stok tersedia</p>
                                @endif
                            </div>
                            <div class="action-buttons">
                                <a class="btn btn-danger" href="{{ url('product_details', $products->id) }}">Detail</a>
                                @if ($products->stock > 0)
                                    <a class="btn btn-primary" href="{{ url('add_cart', $products->id) }}">Add to
                                        Cart</a>
                                @else
                                    <button class="btn btn-secondary" disabled>Out of Stock</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="btn-box">
                <a href="">
                    View All Products
                </a>
            </div>
        </div>
    </section>

    <!-- end shop section -->

    <!-- info section -->

    <section class="info_section  layout_padding2-top">
        <div class="social_container">
            <div class="social_box">
                <a href="">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                </a>
                <a href="">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>
                <a href="">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
                <a href="">
                    <i class="fa fa-youtube" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <div class="info_container ">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <h6>
                            ABOUT US
                        </h6>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doLorem ipsum dolor sit amet,
                            consectetur adipiscing elit, sed doLorem ipsum dolor sit amet,
                        </p>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="info_form ">
                            <h5>
                                Newsletter
                            </h5>
                            <form action="#">
                                <input type="email" placeholder="Enter your email">
                                <button>
                                    Subscribe
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h6>
                            NEED HELP
                        </h6>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doLorem ipsum dolor sit amet,
                            consectetur adipiscing elit, sed doLorem ipsum dolor sit amet,
                        </p>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h6>
                            CONTACT US
                        </h6>
                        <div class="info_link-box">
                            <a href="">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span> Gb road 123 london Uk </span>
                            </a>
                            <a href="">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span>+01 12345678901</span>
                            </a>
                            <a href="">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span> demo@gmail.com</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer section -->
        <footer class=" footer_section">
            <div class="container">
                <p>
                    &copy; <span id="displayYear"></span> All Rights Reserved By
                    <a href="https://html.design/">Free Html Templates</a>
                </p>
            </div>
        </footer>
        <!-- footer section -->

    </section>

    <!-- end info section -->


    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>
