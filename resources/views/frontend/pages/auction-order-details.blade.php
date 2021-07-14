@extends('frontend.app')
@section('content')
<section class="new_details_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="nd_head">
                    <h2 id="auction-heading">Load Product</h2>
                </div>
                <a href="#"><div class="at_logo_pic">
                    <img src="{{ asset('frontend/images/at_pic.jpg') }}">
                    <h5>Air Jordan</h5>
                </div></a>
                <div class="at_logo_sub">
                   <h3>EDITION 1/1</h3>
                   <h4>NFT</h4>
                   <h4>PHYSICAL</h4>
                   <h5>ENDED</h5>
                </div>
                <div class="award-cara owl-carousel" id="auction-order-details-slider-id">
                   
               </div>
            </div>
        </div>
    </div>
</section>

<section class="new_details_bot">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7 new_details_bot_left">
                <p id="short-description-id"></p>
                <p id="full-description-id"></p>
                <blockquote><i class="fas fa-id-card"></i><p>All winners will be required to submit their contact information for shipping purposes after the auction ends.</p></blockquote>
                <h2>Product Other Details</h2>
                <div class="new_details_bot_left_info">
                    <div class="new_details_bot_left_ban">
                        <img src="{{ asset('frontend/images/at_pic.jpg') }}">
                    </div>
                    <div class="new_details_bot_left_info_con">
                        <div class="new_details_bot_left_pic">
                            <img src="{{ asset('frontend/images/at_pic.jpg') }}">
                        </div>
                        <!-- <h3>Air Jordan <span>1 CREATION</span></h3> -->
                        <p id="another-description-id"></p>
                        <div class="nt_details_bot">
                            <ul>
                                <li><a href="#"><i class="fas fa-link"></i>https://www.jordan.com/collection/</a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i>Jumpman23</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5">
                <div class="nd_right_b1">
                    <div class="nd_right_b1_top">
                        <h5>ITEM HAS BEEN SOLD</h5>
                        <h2><span>3.92779</span>ETH <label>(16 bids)</label></h2>
                        <h4>$10,990.19</h4>
                        <a class="but1" href="#"> Claim Physical </a>
                        <a class="but2" href="#">  Opensea </a>
                    </div>
                    <div class="nd_right_b1_bot">
                        <h6>AUCTION ENDED</h6>
                    </div>
                </div>
                <div class="nd_right_b2">
                    <h2>Recent bids</h2>
                    <div class="nd_right_b2_info">
                        <div class="nd_right_b2_info_con">
                            <div class="nd_right_b2_info_con1">
                                <img src="{{ asset('frontend/images/at_pic.jpg') }}">
                            </div>
                            <div class="nd_right_b2_info_con2">
                                <h3>Welcome Home - Radical Face <span>2 weeks ago</span></h3>
                            </div>
                            <div class="nd_right_b2_info_con3">
                                <h4>3.92779 <label>ETH</label>
                                <span>$10,990.19</span></h4>
                            </div>
                        </div>
                        <div class="nd_right_b2_info_con">
                            <div class="nd_right_b2_info_con1">
                                <img src="{{ asset('frontend/images/at_pic.jpg') }}">
                            </div>
                            <div class="nd_right_b2_info_con2">
                                <h3>Welcome Home - Radical Face <span>2 weeks ago</span></h3>
                            </div>
                            <div class="nd_right_b2_info_con3">
                                <h4>3.92779 <label>ETH</label>
                                <span>$10,990.19</span></h4>
                            </div>
                        </div>
                        <div class="nd_right_b2_info_con">
                            <div class="nd_right_b2_info_con1">
                                <img src="{{ asset('frontend/images/at_pic.jpg') }}">
                            </div>
                            <div class="nd_right_b2_info_con2">
                                <h3>Welcome Home - Radical Face <span>2 weeks ago</span></h3>
                            </div>
                            <div class="nd_right_b2_info_con3">
                                <h4>3.92779 <label>ETH</label>
                                <span>$10,990.19</span></h4>
                            </div>
                        </div>
                        <a class="load" href="#">Lode More</a>
                    </div>
                </div>
                <div class="nd_right_b3">
                    <a href="#"><i class="fas fa-play"></i> Learn How To Buy</a>
                    <h6>Explanation video will appear in a pop-up</h6>
                </div>
                <div class="nd_right_b2">
                    <h2>Proof of Authenticity</h2>
                    <div class="nd_right_b2_info nd_right_b2_info2">
                        <a class="load" href="#">View On-Chain Data <i class="fas fa-link"></i></a>
                        <a class="load" href="#">View on Etherscan <i class="fas fa-external-link-alt"></i></a>
                        <a class="load" href="#">View on OpenSea <i class="fas fa-external-link-alt"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@php $page = $_SERVER['PHP_SELF']; @endphp
@php $page1 = explode('/',$page); @endphp
@php $end_page = end($page1); @endphp 
<div class="clearfix"></div>
@endsection
@section('jsContent')
<script>
    $(function(){
        load_auction_order_fx();
    });

    function load_auction_order_fx()
    {
        var id = "<?php echo $end_page; ?>";
        $.ajax({
            url: "{{ route('satirtha.auction.order-details') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
                console.log(event);
                $("#auction-order-details-slider-id").html(event.auctionHtml);
                load_owl_carousal_fx();
                $("#short-description-id").html(event.auctionShortDesc);
                $("#full-description-id").html(event.auctionFullDesc);
                $("#another-description-id").html(event.auctionAnotherDesc);
                $("#auction-heading").html(event.auctionHeading);
            }, error: function(event){

            }
        })
    }

    function load_owl_carousal_fx()
    {
        var owl = $('.award-cara');
        owl.owlCarousel({
            autoPlay: 3000, //Set AutoPlay to 3 seconds
            items: 3,
            nav: false,
            dots: true,
            center: true,
            loop: true,
            autoplay: true,
            smartSpeed: 1500,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            navText: ['<span class="prev"><i class="fas fa-angle-left"></i></span>','<span class="next"><i class="fas fa-angle-right"></i></span>']
        });

    }
</script>
@endsection