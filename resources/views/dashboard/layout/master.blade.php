<!DOCTYPE html>
<?php $lang = app()->getLocale();
?>
<html dir="{{LaravelLocalization::getCurrentLocaleDirection()}}" lang="{{app()->getLocale()}}">

@if($lang == 'ar')
    <style>
        #side{
            margin-right: -260px;
        }
        #body{
            margin-right: 260px;
        }
        #title{
            text-align: right;
        }
        #user{
            margin-left: 100px;
            margin-right: 535px;
        }
        .page-wrapper{
            width: 1087px;
            text-align: right;
        }
        #top{
            margin-right: 500px;
            text-align: right;
        }
        #noti{
            margin-left: -182px;
            text-align: right;
        }
        #noti2{
            margin-left: -128px;
            text-align: right;
        }
        .navbar-header{
            margin-right: -275px;
            direction: ltr;
        }
        .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: gray;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;

            /* Position the tooltip */
            position: absolute;
            z-index: 1;
            margin-top: -50px;
            margin-right: -68px;
        }

        .ed:hover .tooltiptext {
            visibility: visible;
            background-color: #1d643b;

        }
        .de:hover .tooltiptext {
            visibility: visible;
            background-color: #620000;

        }
        .tooltiptext::after {
            content: " ";
            position: absolute;
            top: 100%; /* At the bottom of the tooltip */
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: gray transparent transparent transparent;
        }
    </style>
@endif
<style>
    .tooltiptext {
        visibility: hidden;
        width: 120px;
        background-color: gray;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;

        /* Position the tooltip */
        position: absolute;
        z-index: 1;
        margin-top: -50px;
        margin-left: -68px;
    }

    .ed:hover .tooltiptext {
        visibility: visible;
        background-color: #1d643b;

    }
    .de:hover .tooltiptext {
        visibility: visible;
        background-color: #620000;

    }
    .tooltiptext::after {
        content: " ";
        position: absolute;
        top: 100%; /* At the bottom of the tooltip */
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: gray transparent transparent transparent;
    }
</style>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="">
    <title>The Blue Pheonix</title>
    <!-- Custom CSS -->
    <link href="{{asset('assets/extra-libs/c3/c3.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/libs/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>






</head>

<body id="body">
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

    @include('dashboard.layout.header')
    <div class="page-wrapper">
    @yield('content')
    </div>

{{--@include('dashboard.layout.footer')--}}


</div>


<!--<script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>-->
<script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- apps -->
<!-- apps -->
<script src="{{asset('dist/js/app-style-switcher.js')}}"></script>
<script src="{{asset('dist/js/feather.min.js')}}"></script>
<script src="{{asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('dist/js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{asset('dist/js/custom.min.js')}}"></script>
<!--This page JavaScript -->
<script src="{{asset('assets/extra-libs/c3/d3.min.js')}}"></script>
<script src="{{asset('assets/extra-libs/c3/c3.min.js')}}"></script>
<script src="{{asset('assets/libs/chartist/dist/chartist.min.js')}}"></script>
<!--<script src="{{asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>-->
<script src="{{asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{asset('assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js')}}"></script>
<!--<script src="{{asset('dist/js/pages/dashboards/dashboard1.min.js')}}"></script>-->


@stack('scripts')


</body>

</html>
