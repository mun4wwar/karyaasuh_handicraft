<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- JavaScript for Sticky Navbar -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const navbar = document.querySelector(".custom_nav-container");
        let debounceTimer;

        window.addEventListener("scroll", function () {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function () {
                if (window.scrollY > 20) {
                    navbar.classList.add("scrolled");
                } else {
                    navbar.classList.remove("scrolled");
                }
            }, 20);
        });
    });
</script>
