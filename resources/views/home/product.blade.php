<section class="shop_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>New Products !!</h2>
        </div>
        <div class="row row-cols-5 g-4"> <!-- row-cols-5 untuk 5 kolom per baris -->
            @foreach ($products as $product)
                <div class="col">
                    <div class="box d-flex flex-column position-relative">
                        <!-- Label "New Product" -->
                        @if ($product->created_at >= now()->subDays(7))
                            <!-- Produk baru dalam 7 hari terakhir -->
                            <span class="badge bg-success position-absolute top-0 start-0 m-2">New Product</span>
                        @endif

                        <div class="img-box">
                            <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->title }}">
                        </div>
                        <div class="detail-box">
                            <h6 class="product-name">{{ $product->title }}</h6> <!-- Nama produk -->
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
                        <div class="mt-auto action-buttons"> <!-- mt-auto untuk mendorong tombol ke bawah -->
                            <a class="btn btn-danger" href="{{ url('product_details', $product->id) }}">Detail</a>
                            @if ($product->stock > 0)
                                <a class="btn btn-primary" href="{{ url('add_cart', $product->id) }}">Add to Cart</a>
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