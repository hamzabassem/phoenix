<!DOCTYPE html>
<html dir="{{LaravelLocalization::getCurrentLocaleDirection()}}" lang="{{app()->getLocale()}}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon.png')}}">
    <title>FIST</title>
    <!-- Custom CSS -->
    <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="main-wrapper">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
         style="background:url({{asset('assets/images/big/auth-bg.jpg')}}) no-repeat center center;">
        <div class="auth-box row text-center">
            <div class="col-lg-7 col-md-5 modal-bg-img"
                 style="background-image: url({{asset('assets/images/big/3.jpg')}});">
            </div>
            <div class="col-lg-5 col-md-7 bg-white">
                <div class="p-3">
                    <img src="{{asset('assets/images/big/icon.png')}}" alt="wrapkit">
                    <h2 class="mt-3 text-center">{{Lang::get('site.Sign Up for Free')}}</h2>
                    @include('dashboard.layout.messages')
                    <form action="{{route('registercompany')}}" method="post" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input class="form-control" type="hidden" value="{{$days}}" name="days">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="name" placeholder="{{Lang::get('site.Enter Your Company Name')}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="custom-file">
                                    <input name="signature" type="file" class="custom-file-input" id="inputGroupFile03">
                                    <label style="text-align: left; color: rgba(76,86,103,0.53)" class="custom-file-label" for="inputGroupFile03">{{Lang::get('site.Select Your Signature')}}</label>
                                </div>
                            </div>
                            <div style="    margin-top: 15px;" class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-block btn-dark">{{Lang::get('site.Sign Up The Company')}}</button>
                            </div>
                            <div class="col-lg-12 text-center mt-5">
                                {{Lang::get('site.Already have an account?')}}  <a href="{{route('login')}}" class="text-danger">{{Lang::get('site.Sign In')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- All Required js -->
<!-- ============================================================== -->
<script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('dist/js/feather.min.js')}}"></script>
<script src="{{asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>

<!--Custom JavaScript -->
<script src="{{asset('dist/js/custom.min.js')}}"></script>


<!-- ============================================================== -->
<!-- This page plugin js -->
<!-- ============================================================== -->
<script>
    $(".preloader ").fadeOut();
</script>
</body>

</html>
