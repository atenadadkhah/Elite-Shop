<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="utf-8">
    <title>@yield("title")</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <!-- ** Plugins Needed for the Project ** -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/plugins/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="/plugins/slick/slick.css">
    <link rel="stylesheet" href="/plugins/venobox/venobox.css">
    <link rel="stylesheet" href="/plugins/animate/animate.css">
    <link rel="stylesheet" href="/plugins/aos/aos.css">
    <link rel="stylesheet" href="/plugins/bootstrap-touchspin-master/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="/plugins/nice-select/nice-select.css">
    <link rel="stylesheet" href="/plugins/bootstrap-slider/bootstrap-slider.min.css">
    <link rel="stylesheet" href="/plugins/izitoast/dist/css/iziToast.css">
    <!-- Main Stylesheet -->
    <link href="/css/style.css" rel="stylesheet">
    @yield("extra_css")
    <!--Favicon-->
    <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="/images/favicon.png" type="image/x-icon">
</head>

<body>

<!-- preloader start -->
<div class="preloader">
    <img src="/images/preloader.gif" alt="preloader">
</div>
<!-- preloader end -->

@if (request()->path() != 'login' and request()->path() != 'register')
    @include('_master.nav')
@endif

@yield("main")


<!-- jQuery -->
<script src="/plugins/jQuery/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="/plugins/bootstrap/bootstrap.min.js"></script>
<script src="/plugins/slick/slick.min.js"></script>
<script src="/plugins/venobox/venobox.min.js"></script>
<script src="/plugins/aos/aos.js"></script>
<script src="/plugins/syotimer/jquery.syotimer.js"></script>
<script src="/plugins/instafeed/instafeed.min.js"></script>
<script src="/plugins/zoom-master/jquery.zoom.min.js"></script>
<script src="/plugins/bootstrap-touchspin-master/jquery.bootstrap-touchspin.min.js"></script>
<script src="/plugins/nice-select/jquery.nice-select.min.js"></script>
<script src="/plugins/bootstrap-slider/bootstrap-slider.min.js"></script>
<script src="/plugins/"></script>
<script src="/plugins/izitoast/dist/js/iziToast.js"></script>
<!-- google map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&amp;libraries=places"></script>
<script src="/plugins/google-map/gmap.js"></script>
<!-- Main Script -->
<script src="/js/script.js"></script>
<script src="/js/manageCart.js"></script>
<script>
    $.getJSON("https://ipapi.co/5.113.71.41/json/",(data)=>{
        $(".top-header .country-option").val(data.country)
        $(".top-header .current").text(data.country)
        $(".top-header .option").text(data.country)
        $(".top-header .flag img").attr("src",`https://flagsapi.com/${data.country.toUpperCase()}/flat/64.png`)
    })
</script>
@yield("extra_js")
</body>
</html>
