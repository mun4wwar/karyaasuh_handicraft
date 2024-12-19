{{-- <!-- Sidebar Navigation-->
<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar">
            <img src="{{ asset('/admincss/img/avatar-6.jpg') }}" alt="..." class="img-fluid rounded-circle">
        </div>
        <div class="title">
            <h1 class="h5">Awang</h1>
            <p>Munawwar Hibatullah</p>
        </div>
    </div>

    <!-- Sidebar Navigation Menus-->
    <span class="heading">Main</span>
    <ul class="list-unstyled">
        <li><a href="{{ url('admin/dashboard') }}"> <i class="icon-home"></i>Beranda </a></li>
        <li><a href="{{ url('view_category') }}"> <i class="icon-grid"></i>Kategori </a></li>
        <li><a href="#productDropdown" aria-expanded="false" data-toggle="collapse">
                <i class="icon-windows"></i>Produk
            </a>
            <ul id="productDropdown" class="collapse list-unstyled">
                <li><a href="{{ url('add_product') }}">Tambah Produk</a></li>
                <li><a href="{{ url('view_product') }}">Daftar Produk</a></li>
            </ul>
        </li>
        <li><a href="#supplierDropdown" aria-expanded="false" data-toggle="collapse">
                <i class="icon-windows"></i>Supplier
            </a>
            <ul id="supplierDropdown" class="collapse list-unstyled">
                <li><a href="{{ url('add_supplier') }}">Tambah Supplier</a></li>
                <li><a href="{{ url('supplier') }}">Daftar Supplier</a></li>
            </ul>
        </li>
        <li><a href="{{ url('view_orders') }}"> <i class="icon-grid"></i>Orders </a></li>
    </ul>
</nav> --}}


<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ url('admin/dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#collapseProduk" aria-expanded="false" aria-controls="collapseProduk">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Produk
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseProduk" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ url('view_product') }}">Daftar Produk</a>
                        <a class="nav-link" href="{{ url('add_product') }}">Tambah Produk</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#collapseBahan" aria-expanded="false" aria-controls="collapseBahan">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Bahan Baku
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseBahan" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('bahan.index') }}">Daftar Bahan Baku</a>
                        <a class="nav-link" href="{{ route('bahan.create') }}">Tambah Bahan Baku</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#collapseSupplier" aria-expanded="false" aria-controls="collapseSupplier">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Supplier
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseSupplier" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ url('supplier') }}">Daftar Supplier</a>
                        <a class="nav-link" href="{{ url('add_supplier') }}">Tambah Supplier</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Pages
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                            aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="login.html">Login</a>
                                <a class="nav-link" href="register.html">Register</a>
                                <a class="nav-link" href="password.html">Forgot Password</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseError" aria-expanded="false"
                            aria-controls="pagesCollapseError">
                            Error
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="401.html">401 Page</a>
                                <a class="nav-link" href="404.html">404 Page</a>
                                <a class="nav-link" href="500.html">500 Page</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="{{ url('view_category') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Kategori
                </a>
                <a class="nav-link" href="{{ url('view_orders') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Orders
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ auth()->user()->usertype }}
        </div>

    </nav>
</div>