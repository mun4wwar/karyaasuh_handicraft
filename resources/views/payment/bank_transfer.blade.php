<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Transfer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Transfer Bank</h2>
        <p>Silakan transfer ke rekening berikut untuk menyelesaikan pembayaran:</p>
        <ul class="list-group">
            <li class="list-group-item"><strong>Nama Bank:</strong> {{ $bankDetails['bank_name'] }}</li>
            <li class="list-group-item"><strong>Nomor Rekening:</strong> {{ $bankDetails['account_number'] }}</li>
            <li class="list-group-item"><strong>Nama Pemilik:</strong> {{ $bankDetails['account_name'] }}</li>
        </ul>
        <div class="alert alert-info mt-4">
            Setelah transfer, silakan konfirmasi pembayaran melalui laman <a href="{{ route('orders_page') }}"><b>Orderan saya</b></a>.
        </div>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3 w-100">Kembali ke Beranda</a>
    </div>
</body>

</html>
