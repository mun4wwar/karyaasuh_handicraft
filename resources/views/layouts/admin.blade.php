<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon">
    <title>DashAdmin Sonia</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('/admincss/css/custom.css') }}" id="theme-stylesheet">
    <style>
        main {
            background: url('/images/favicon.png') no-repeat;
            background-position: 50% 10%;
            /* Geser sedikit ke bawah */
            background-size: 65%;
            /* Ukuran logo tetap */
        }

        .card.mb-4 {
            background-color: rgba(255, 255, 255, 1);
            /* Default */
            transition: opacity 0.3s ease-in-out; /* Animasi transisi selama 0.3 detik */
        }
    </style>
</head>

<body class="sb-nav-fixed">
    @include('admin.header')
    <div id="layoutSidenav">
        @include('admin.sidebar')
        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
            @include('admin.footer')
        </div>
    </div>
    @include('admin.scripts')
</body>

</html>
