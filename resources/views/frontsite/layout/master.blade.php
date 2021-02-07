<!DOCTYPE html>
<html dir="{{LaravelLocalization::getCurrentLocaleDirection()}}" lang="{{app()->getLocale()}}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->



    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset("vendor/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">
    <link href="{{asset("vendor/icofont/icofont.min.css")}}" rel="stylesheet">
    <link href="{{asset("vendor/boxicons/css/boxicons.min.css")}}" rel="stylesheet">
    <link href="{{asset("vendor/remixicon/remixicon.css")}}" rel="stylesheet">
    <link href="{{asset("vendor/venobox/venobox.css")}}" rel="stylesheet">
    <link href="{{asset("vendor/owl.carousel/assets/owl.carousel.min.css")}}" rel="stylesheet">
    <link href="{{asset("vendor/aos/aos.css")}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset("css/style.css")}}" rel="stylesheet">

    <!-- =======================================================
    * Template Name: Arsha - v2.3.0
    * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

@include('frontsite.layout.header')

@yield('content')




@include('frontsite.layout.footer')

<a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="{{asset("vendor/jquery/jquery.min.js")}}"></script>
<script src="{{asset("vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("vendor/jquery.easing/jquery.easing.min.js")}}"></script>
<script src="{{asset("vendor/php-email-form/validate.js")}}"></script>
<script src="{{asset("vendor/waypoints/jquery.waypoints.min.js")}}"></script>
<script src="{{asset("vendor/isotope-layout/isotope.pkgd.min.js")}}"></script>
<script src="{{asset("vendor/venobox/venobox.min.js")}}"></script>
<script src="{{asset("vendor/owl.carousel/owl.carousel.min.js")}}"></script>
<script src="{{asset("vendor/aos/aos.js")}}"></script>

<!-- Template Main JS File -->
<script src="{{asset("js/main.js")}}"></script>

</body>

</html>
