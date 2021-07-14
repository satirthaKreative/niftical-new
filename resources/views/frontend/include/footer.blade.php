<footer>
    <div class="foot_info">
        <div class="container">   
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('satirtha.subscriber-email') }}" method="get">
                        @csrf
                        <input type="email" name="subscribe_email_name" placeholder="Email Address" required="required">
                        <input type="submit" name="subscribe_email_submit" value="Subscribe">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="foot_menu">
        <div class="container">   
            <div class="row">
                <div class="col-md-12 text-center">
                    <ul>
                        <li><a href="{{ route('satirtha.home') }}">Home</a></li>
                        <!-- <li><a href="#">Categories</a></li> -->
                        <li><a href="{{ route('satirtha.product') }}">Products</a></li>
                        <li><a href="{{ route('satirtha.contact') }}">Contact</a></li>
                        <!-- <li><a href="#">Login</a></li> -->
                    </ul>
                </div>
                <!-- <div class="col-md-4 col-sm-4 text-right">
                    <ul>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms and Conditions</a></li>
                    </ul>
                </div> -->
            </div>
        </div>
    </div>
    <div class="foot_bot">
        <div class="container">   
            <div class="foot_bot_con">
                <div class="row">
                    <h5>Copyright  2021 | All right reserved</h5>
                    <ul>
                        <li><a href="https://twitter.com/Nifticals"><i class="fab fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<!--  <a href="#0" class="cd-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>     -->
<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.slimNav_sk78.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script type="text/javascript" src="https://wp.incredibbble.com/writsy-shop/wp-content/themes/writsy-shop/assets/vendor/jquery-zoom/jquery.zoom.min.js?ver=1.7.18"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.1.0/lazysizes.min.js"></script>
<script type="text/javascript" src="https://mreq.github.io/slick-lightbox/dist/slick-lightbox.js"></script>