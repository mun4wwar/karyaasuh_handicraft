<header class="header_section">
    <nav class="navbar navbar-expand-lg custom_nav-container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <span>
                Sonia Handcraft
            </span>
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                <li class="nav-item {{ Request::is('testimonial') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/testimonial') }}">Testimonial</a>
                </li>
                <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/contact') }}">Contact Us</a>
                </li>
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
                        <form class="form-inline">
                            <button class="btn nav_search-btn" type="submit">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </form>
                        <form style="padding: 10px" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <input class="btn btn-danger" type="submit" value="Log Out">
                        </form>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const navbar = document.querySelector(".custom_nav-container");

        window.addEventListener("scroll", function() {
            if (window.scrollY > 50) { // Ketika user scroll lebih dari 50px
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });
    });
</script>
