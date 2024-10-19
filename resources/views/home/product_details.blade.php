<!DOCTYPE html>
<html>

<head>
    @include('home.css')

    <style type="text/css">
    .div_center
    {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px;
    }
    </style>
</head>

<body>
    <div class="hero_area">

        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

    </div>

    <!-- Product Details Start -->

    <section class="shop_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Latest Products
                </h2>
            </div>
            <div class="row">

                
                    <div class="col-md-10">
                        <div class="box">

                            <div class="div_center">
                                <img width="400" src="/products/{{ $data->image }}" alt="">
                            </div>
                            <div class="detail-box">
                                <h6>{{ $data->title }}</h6>
                                <h6>
                                    <span>Rp {{ $data->price }}</span>
                                </h6>
                            </div>

                            <div class="detail-box">
                                <h6>Category : {{ $data->category }}</h6>
                                <h6>Available Quantity
                                    <span>{{ $data->quantity }}</span>
                                </h6>
                            </div>
                        </div>
                    </div>

            </div>

        </div>
    </section>


    <!-- Product Details End -->





    <!-- info section -->
    @include('home.footer')

</body>

</html>
