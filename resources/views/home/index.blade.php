<!DOCTYPE html>
<html>

<head>
    @include('home.css')

    <style>
        .div_deg {
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 200px;
        }

        .heading_container h2 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .box {
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 20px;
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


        <!-- slider section -->
        @include('home.slider')
        <!-- end slider section -->
    </div>
    <!-- end hero area -->


    <!-- shop section -->
    @include('home.product')
    <!-- end shop section -->

    <!-- contact section -->
    @include('home.contact')
    <!-- end contact section -->



    <!-- info section -->
    @include('home.footer')

</body>

</html>
