@extends('frontend.app')
@section('content')
<div class="main_slider">
    <div class="main-slider owl-carousel" id="banner-frontend-id">
        <div class="item">
            <div class="banner">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="bantext">
                                <h1><span>"Nifticals"</span>  - Physical NFT’s
                               </h1>
                               <p>Bringing art from your digital wallet to your wall.</p>
                               <!--  <p>It is a long established fact that a reader will be distracted by the readable content of a page when.</p>
                                <a href="#">Read More</a> -->
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 slide_pic">
                            <img src="{{ asset('frontend/images/slider_pic1.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<section class="main_cat_arae">
    <div class="container">
        <div class="row" id="auction-home-id">
            
            <div class="col-lg-4 col-md-4">
                <div class="m_cat_info">
                    <center>Auction Product Loaded</center>
                </div>
            </div>
            
        </div>
    </div>
</section>


<section class="print_area">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <!-- <h4>Paints that inspires you</h4> -->
                <h2>Showcase your NFT's with a <br><strong>Niftical</strong></h2>
                <a href="product.php">Order Now</a>
            </div>
            <div class="col-md-6 col-sm-6">
                <img src="{{ asset('frontend/images/print_pic.png') }}">
            </div>
        </div>
    </div>
</section>

<div class="clearfix"></div>

@endsection
@section('jsContent')
<script>
    $(function(){
        load_banner_fx();
    });

    function load_banner_fx()
    {
        $.ajax({
            url: "{{ route('satirtha.banner-all-data') }}",
            type: "GET",
            dataType: "json",
            success: function(e){
                console.log(e);
                    $("#banner-frontend-id").html(e.banner_html);
                    load_banner_owl_fx();
                    load_auction_home_page_fx();
            }, error: function(e){

            }
        })
    }

    function load_auction_home_page_fx()
    {
        $.ajax({
            url: "{{ route('satirtha.auction.home-page') }}",
            type: "GET",
            dataType: "json",
            success: function(event){
                $("#auction-home-id").html(event.auctionHtml);
            }, error: function(event){

            }
        })
    }

    function load_banner_owl_fx()
    {
        var owl = $('.main-slider');
        owl.owlCarousel({
            autoplay: true,
            autoplayTimeout: 4000,
            loop: true,
            items: 1,
            center: true,
            nav: true,
            thumbs: false,
            thumbImage: false,
            thumbsPrerendered: true,
            thumbContainerClass: 'owl-thumbs',
            thumbItemClass: 'owl-thumb-item',
            navText: ['<span class="prev"><i class="fas fa-angle-left"></i></span>','<span class="next"><i class="fas fa-angle-right"></i></span>'],

        });	
        var owl = $('.testi_slider');
        owl.owlCarousel({
            autoplay: true,
            autoplayTimeout: 4000,
            loop: true,
            items: 1,
            center: true,
            nav: true,
            thumbs: true,
            thumbImage: false,
            thumbsPrerendered: true,
            thumbContainerClass: 'owl-thumbs',
            thumbItemClass: 'owl-thumb-item',
            navText: ['<span class="prev"><i class="fas fa-angle-left"></i></span>','<span class="next"><i class="fas fa-angle-right"></i></span>'],
        });
        var owl = $('.product_rolling');
        owl.owlCarousel({
            autoplay: true,
            autoplayTimeout: 4000,
            loop: true,
            items:4,
            itemsMobile:[568,2],
            itemsTablet:[768,3],
            itemsTablet:[1024,3],
            center: false,
            nav: true,
            thumbs: true,
            thumbImage: false,
            thumbsPrerendered: true,
            thumbContainerClass: 'owl-thumbs',
            thumbItemClass: 'owl-thumb-item',
            navText: ['<span class="prev"><i class="fas fa-angle-left"></i></span>','<span class="next"><i class="fas fa-angle-right"></i></span>'],
            responsive: {
                0: {
                items: 1
                },

                600: {
                items: 2
                },

                1024: {
                items: 3
                },

                1366: {
                items: 4
                }
            }
        });
    }
</script>
@endsection