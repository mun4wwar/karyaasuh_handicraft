<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Dashboard</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="all,follow">
<!-- Bootstrap CSS-->
<link rel="stylesheet" href="{{ asset('/admincss/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admincss/vendor/bootstrap/css/plugins.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admincss/vendor/bootstrap/css/kaiadmin.min.css') }}">
<!-- Font Awesome CSS-->
<link rel="stylesheet" href="{{ asset('/admincss/vendor/font-awesome/css/font-awesome.min.css') }}">
<!-- Custom Font Icons CSS-->
<link rel="stylesheet" href="{{ asset('/admincss/css/font.css') }}">
<!-- Fonts and icons -->
<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
<script>
    WebFont.load({
        google: {
            families: ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["../assets/css/fonts.min.css"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
</script>
<!-- theme stylesheet-->
<link rel="stylesheet" href="{{ asset('/admincss/css/style.default.css') }}" id="theme-stylesheet">
<!-- Custom stylesheet - for your changes-->
<link rel="stylesheet" href="{{ asset('/admincss/css/custom.css') }}">
<!-- Favicon-->
<link rel="shortcut icon" href="{{ asset('/admincss/img/favicon.ico') }}">
<!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
