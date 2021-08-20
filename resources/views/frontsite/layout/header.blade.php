<!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

        <a href="{{route('home')}}"><img id="logo" src="{{asset('img/pheonix.png')}}" class="logo mr-auto"></a>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="active"><a id="li-home" href="{{route('home')}}">{{Lang::get('site.Home')}}</a></li>
                <li><a id="li-about" href="{{route('home')}}#about">{{Lang::get('site.About us')}}</a></li>
                <li><a id="li-services" href="{{route('home')}}#services">{{Lang::get('site.Services')}}</a></li>
                {{--<li><a id="li-team" href="{{route('home')}}#team">Team</a></li>--}}
                <li><a id="li-pricing" href="{{route('home')}}#pricing">{{Lang::get('site.Pricing')}}</a></li>
                <li><a id="li-contact" href="{{route('home')}}#contact">{{Lang::get('site.Contact')}}</a></li>

            </ul>
        </nav><!-- .nav-menu -->
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <a hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"><button class="get-started-btn scrollto"> {{ $properties['native'] }}</button></a>
            @endforeach
        @guest
        <a style="color: white" href="{{route('dashhome')}}" class="get-started-btn scrollto" >{{Lang::get('site.LOGIN')}}</a>
        @endguest

        @auth
            <a style="color: white" href="{{route('dashhome')}}" class="get-started-btn scrollto" >{{Lang::get('site.Dashboard')}}</a>
        @endauth

    </div>
</header><!-- End Header -->
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                <h1>FIST</h1>
                <h2>{{Lang::get('site.for inventory')}}</h2>
                <div class="d-lg-flex">
                    <a href="#about" class="btn-get-started scrollto">{{Lang::get('site.Get Started')}}</a>

                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                <img src="{{asset("/img/repository.png")}}" class="img-fluid animated" alt="">
            </div>
        </div>
    </div>

</section><!-- End Hero -->
