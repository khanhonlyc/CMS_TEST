<!--   Core JS Files   -->
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.korzh.com/metroui/v4.5.1/js/metro.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{ secure_asset('asset/js/core/popper.min.js')}}"></script>
<script src="{{ secure_asset('asset/js/core/bootstrap.min.js')}}"></script>
<script src='{{ secure_asset("js/jquery.redirect.js") }}'></script>
<script>
  $(document).ready(function() {
      $('.sidebar-wrapper li').click(function() {
        $('.sidebar-wrapper li').removeClass('active');
        $(this).addClass('active');
      });
  });
</script>
