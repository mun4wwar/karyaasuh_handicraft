<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <title>Tentang Kami - Sonia Handicraft</title>
</head>

<body>
    <div class="hero_area">
        <!-- header section starts -->
        @include('home.header')
        <!-- end header section -->
    </div>
    <!-- end hero area -->

    <!-- about section -->
    <section class="about_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Tentang Kami</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="img-box">
                        <img src="{{ asset('images/about_us.jpg') }}" alt="Tentang Sonia Handicraft">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-box">
                        <p>
                            Selamat datang di Sonia Handicraft! Kami adalah platform marketplace yang berdedikasi untuk
                            mempromosikan dan menjual produk-produk kerajinan tangan hasil karya anak-anak panti asuhan.
                            Dengan setiap pembelian, Anda turut berkontribusi dalam mendukung bakat dan masa depan mereka.
                        </p>
                        <p>
                            Visi kami adalah menciptakan dampak positif melalui kerajinan tangan yang unik dan penuh arti.
                            Semua produk yang kami tawarkan dibuat dengan penuh cinta dan perhatian terhadap detail,
                            mencerminkan kreativitas dan keterampilan para pembuatnya.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end about section -->

    <!-- footer section -->
    @include('home.footer')
    <!-- end footer section -->

    <!-- scripts -->
    @include('home.scripts')
    <!-- end scripts -->
</body>

</html>
