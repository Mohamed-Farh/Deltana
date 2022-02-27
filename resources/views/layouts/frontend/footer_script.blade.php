<script>
    AOS.init();
</script>

<script> $('.close').click(function(){ $('video').each(function(){ $(this).get(0).pause(); }) }); </script>

<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.js') }}"></script>

@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])


