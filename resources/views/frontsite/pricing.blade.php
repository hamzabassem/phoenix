@extends('frontsite.layout.master')
@section('content')
    <section id="pricing" class="pricing">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>{{Lang::get('site.Pricing')}}</h2>
                <p>{{Lang::get('site.choose your plane first')}}</p>
            </div>

            <div class="row">

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="box">
                        <h3>{{Lang::get('site.Free Plan')}}</h3>
                        <h4><sup>$</sup>0<span>{{Lang::get('site.10 Days')}}</span></h4>
                        <ul>
                            {{--<li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
                            <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
                            <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                            <li class="na"><i class="bx bx-x"></i> <span>Pharetra massa massa ultricies</span></li>
                            <li class="na"><i class="bx bx-x"></i> <span>Massa ultricies mi quis hendrerit</span></li>--}}
                        </ul>
                        <a href="{{route('signup',['days' => \Illuminate\Support\Facades\Crypt::encryptString(10)])}}" class="buy-btn">{{Lang::get('site.Get Started')}}</a>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="200">
                    <div class="box featured">
                        <h3>{{Lang::get('site.Monthly Plan')}}</h3>
                        <h4><sup>$</sup>99<span>{{Lang::get('site.Per Month')}}</span></h4>
                        <ul>
                            {{--<li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
                            <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
                            <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                            <li><i class="bx bx-check"></i> Pharetra massa massa ultricies</li>
                            <li><i class="bx bx-check"></i> Massa ultricies mi quis hendrerit</li>--}}
                        </ul>
                        <a href="{{route('signup',['days' => \Illuminate\Support\Facades\Crypt::encryptString(30)])}}" class="buy-btn">{{Lang::get('site.Get Started')}}</a>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
                    <div class="box">
                        <h3>{{Lang::get('site.Yearly Plan')}}</h3>
                        <h4><sup>$</sup>599<span>{{Lang::get('site.Per Year')}}</span></h4>
                        <ul>
                            {{--<li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
                            <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
                            <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                            <li><i class="bx bx-check"></i> Pharetra massa massa ultricies</li>
                            <li><i class="bx bx-check"></i> Massa ultricies mi quis hendrerit</li>--}}
                        </ul>
                        <a href="{{route('signup',['days' => \Illuminate\Support\Facades\Crypt::encryptString(365)])}}" class="buy-btn">{{Lang::get('site.Get Started')}}</a>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Pricing Section -->
    @endsection
