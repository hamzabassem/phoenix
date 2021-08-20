
<!-- ======= Footer ======= -->
<footer id="footer">



    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>FIST</h3>
                    <p>
                        {{Lang::get('site.Palestine Street')}} <br>
                        {{Lang::get('site.Gaza Strip, Aremal')}}<br>
                        {{Lang::get('site.Palestine')}} <br><br>
                        <strong>{{Lang::get('site.Phone:')}}</strong> +1 5589 55488 55<br>
                        <strong>{{Lang::get('site.Email:')}}</strong> info@example.com<br>
                    </p>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>{{Lang::get('site.Useful Links')}}</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('home')}}#home">{{Lang::get('site.Home')}}</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('home')}}#about">{{Lang::get('site.About us')}}</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('home')}}#services">{{Lang::get('site.Services')}}</a></li>
                        {{--<li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('home')}}#">Privacy policy</a></li>--}}
                    </ul>
                </div>



                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>{{Lang::get('site.Our Social Networks')}}</h4>
                    <div class="social-links mt-3">
                        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container footer-bottom clearfix">
        <div class="copyright">
             &copy; {{Lang::get('site.Copyright')}} <strong><span>FIST </span></strong>{{Lang::get('site.All Rights Reserved')}}.
        </div>
        {{--<div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>--}}
    </div>
</footer><!-- End Footer -->
