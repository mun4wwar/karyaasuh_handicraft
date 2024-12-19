<section class="shop_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>Latest Products</h2>
        </div>
        <div class="row g-4"> <!-- Tambahkan gap antar produk -->
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
                                <a class="btn btn-primary" href="{{ url('add_cart', $products->id) }}">Add to Cart</a>
                            @else
                                <button class="btn btn-secondary" disabled>Out of Stock</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="btn-box">
            <a href="#">View All Products</a>
        </div>
    </div>
</section>
