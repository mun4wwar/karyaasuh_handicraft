<!-- JavaScript files-->
<script>
    let scrollTimeout; // Variabel untuk menyimpan timer

    window.addEventListener('scroll', function() {
        const card = document.getElementById('scrollCard');

        // Set transparansi lebih rendah saat di-scroll
        card.style.opacity = 0.85;

        // Hapus timer sebelumnya jika ada
        if (scrollTimeout) {
            clearTimeout(scrollTimeout);
        }

        // Pasang timer untuk mengembalikan transparansi setelah berhenti scroll
        scrollTimeout = setTimeout(() => {
            card.style.opacity = 1; // Kembali ke transparansi normal
        }, 200); // 200ms setelah berhenti scroll
    });
</script>


<script type="text/javascript">
    function confirmation(event) {
        event.preventDefault();
        var urlToRedirect = event.currentTarget.getAttribute('href');
        console.log(urlToRedirect);
        swal({
                title: "Apakah Anda yakin untuk menghapus kategori ini?",
                text: "Kategori akan dihapus secara permanen",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willCancel) => {
                if (willCancel) {
                    window.location.href = urlToRedirect;
                }
            });
    }
</script>
<!-- JavaScript files-->
<script src="{{ asset('/admincss/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
<script src="{{ asset('/admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
<script src="{{ asset('/admincss/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('/admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/admincss/js/charts-home.js') }}"></script>
<script src="{{ asset('/admincss/js/front.js') }}"></script>
<script src="{{ asset('/admincss/js/scripts.js') }}"></script>
<script src="{{ asset('/admincss/js/datatables-simple-demo.js') }}"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
</script>
