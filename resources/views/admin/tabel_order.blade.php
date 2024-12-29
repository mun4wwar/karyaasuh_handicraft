<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Daftar Orderan
    </div>
    <div class="card-body">
        <table id="datatablesSimple" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Costumer Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Product Title</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Payment Proof</th>
                    <th>Change Status</th>
                    <th>Print PDF</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Costumer Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Product Title</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Payment Proof</th>
                    <th>Change Status</th>
                    <th>Print PDF</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($data as $order)
                    <tr>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->rec_address }}</td>
                        <td>{{ $order->phone }}</td>

                        <!-- Menampilkan setiap produk yang terkait dengan order -->
                        <td>
                            @foreach ($order->products as $product)
                                <p>{{ $product->title }}</p>
                            @endforeach
                        </td>

                        <!-- Menampilkan harga per produk dan total harga -->
                        <td>
                            @foreach ($order->products as $product)
                                <p>Rp. {{ $product->price }}</p>
                            @endforeach
                        </td>

                        <!-- Menghitung total harga -->
                        <td>
                            @php
                                $totalPrice = 0;
                            @endphp
                            @foreach ($order->products as $product)
                                @php
                                    $totalPrice += $product->price * $product->pivot->quantity;
                                @endphp
                            @endforeach
                            <p>Rp. {{ number_format($totalPrice, 0, ',', '.') }}</p>
                        </td>

                        <!-- Menampilkan quantity -->
                        <td>
                            @foreach ($order->products as $product)
                                <p>{{ $product->pivot->quantity }}</p>
                            @endforeach
                        </td>

                        <!-- Menampilkan status -->
                        <td>
                            @if ($order->status == 'Pending')
                                <span style="color: rgb(202, 0, 0)">{{ $order->status }}</span>
                            @elseif ($order->status == 'On the way')
                                <span style="color: rgb(0, 0, 202)">{{ $order->status }}</span>
                            @else
                                <span style="color: rgb(0, 202, 0)">{{ $order->status }}</span>
                            @endif
                        </td>
                        <!-- Menampilkan Payment Proof -->
                        <td>
                            @if ($order->transaction && $order->transaction->payment_proof)
                                <p>{{ $order->transaction->payment_proof }}</p> <!-- Debug: Menampilkan nama file -->
                                <a href="{{ asset('storage/payment_proofs/' . $order->transaction->payment_proof) }}"
                                    target="_blank" class="btn btn-success btn-sm">View Proof</a>
                            @else
                                <span class="text-danger">Not Uploaded</span>
                            @endif
                        </td>

                        <!-- Tombol status -->
                        <td>
                            <a class="btn btn-info" href="{{ url('on_the_way', $order->id) }}">On the way</a>
                            <a class="btn btn-success" href="{{ url('delivered', $order->id) }}">Delivered</a>
                        </td>
                        <!-- Tombol Print PDF -->
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
