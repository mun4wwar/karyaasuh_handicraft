<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Daftar Orderan
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Costumer Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Product Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Change Status</th>
                    <th>Print PDF</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Gambar Produk</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($data as $order)
                    <tr>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->rec_address }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->product->title }}</td>
                        <td>Rp. {{ $order->product->price }}</td>
                        <td>
                            <img width="150" src="{{ asset('products/' . $order->product->image) }}"
                                alt="Product Image">
                        </td>
                        <td>{{ $order->quantity }}</td>
                        <td>
                            @if ($order->status == 'Pending')
                                <span style="color: rgb(202, 0, 0)">{{ $order->status }}</span>
                            @elseif ($order->status == 'On the way')
                                <span style="color: rgb(0, 0, 202)">{{ $order->status }}</span>
                            @else
                                <span style="color: rgb(0, 202, 0)">{{ $order->status }}</span>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ url('on_the_way', $order->id) }}">On the way</a>
                            <a class="btn btn-success" href="{{ url('delivered', $order->id) }}">Delivered</a>
                        </td>
                        <td>
                            <a class="btn btn-secondary" href="{{ url('print_pdf', $order->id) }}">Print PDF</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Pagination Links -->
<div class="pagination-links" style="margin-top: 20px; display: flex; justify-content: center;">
    {{ $data->links() }}
</div>
