<header class="header_section">
    <nav class="navbar navbar-expand-lg custom_nav-container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <span>
                Sonia Handcraft
            </span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse mx-auto" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item {{ Request::is('shop') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/shop') }}">Shop</a>
                </li>
                <li class="nav-item {{ Request::is('tentang-kami') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/tentang-kami') }}">Why Us</a>
                </li>
                {{-- <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/contact') }}">Contact Us</a>
                </li> --}}
            </ul>
            <div class="user_option">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('orders_page') }}" class="btn btn-outline-warning">
                            My Orders
                        </a>
                        <a href="{{ url('mycart') }}" class="btn btn-outline-warning">
                            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                            {{ $count }}
                        </a>
                        <div class="dropdown">
                            <button class="btn btn-outline-info dropdown-toggle" type="button" id="accountDropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                Account
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
                                <span class="dropdown-item">
                                    <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->usertype }} |
                                    {{ Auth::user()->name }}
                                </span>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a class="btn btn-primary" href="{{ url('login') }}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>Login</span>
                        </a>
                        <a class="btn btn-success" href="{{ url('register') }}">
                            <i class="fa fa-vcard" aria-hidden="true"></i>
                            <span>Register</span>
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>
</header>
