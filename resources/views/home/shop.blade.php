<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<body>
    <div class="hero_area">
        <!-- header section starts -->
        @include('home.header')
        <!-- end header section -->
    </div>
    <!-- end hero area -->

    <!-- shop section -->
    <section class="shop_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Our Products</h2>
            </div>
            <!-- Tambahkan gap antar kolom dengan g-3 -->
            <div class="custom-row">
                @foreach ($products as $product)
                    <div class="custom-col">
                        <div class="box">
                            <div class="img-box">
                                <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->title }}">
                            </div>
                            <div class="detail-box">
                                <h6 class="product-name">{{ $product->title }}</h6>
                                <h6 class="product-price">Rp. {{ number_format($product->price, 0, ',', '.') }}</h6>
                            </div>
                            <div class="stock-info">
                                @if ($product->stock == 0)
                                    <p class="text-danger"><i class="bi bi-x-circle-fill"></i> Stok habis</p>
                                @elseif ($product->stock < 10)
                                    <p class="text-warning"><i class="bi bi-dash-circle-fill"></i> Stok menipis,
                                        ({{ $product->stock }} tersisa)
                                    </p>
                                @else
                                    <p class="text-success"><i class="bi bi-check-circle-fill"></i> Stok tersedia</p>
                                @endif
                            </div>
                            <div class="action-buttons">
                                <a class="btn btn-danger" href="{{ url('product_details', $product->id) }}">Detail</a>
                                @if ($product->stock > 0)
                                    <a class="btn btn-primary" href="{{ url('add_cart', $product->id) }}">Add to
                                        Cart</a>
                                @else
                                    <button class="btn btn-secondary" disabled>Out of Stock</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Tambahkan kolom kosong jika produk kurang dari 5 -->
                @for ($i = 0; $i < 5 - count($products); $i++)
                    <div class="empty-col"></div>
                @endfor
            </div>


            <!-- Tambahkan Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </section>
    <!-- end shop section -->
    @include('home.footer')
    <!-- end info section -->
    @include('home.scripts')
</body>

</html>
