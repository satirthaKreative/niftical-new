@extends('frontend.app')
@section('content')

<style type="text/css">
.content {
  display: none;
}
.noContent {
  color: #000 !important;
  background-color: transparent !important;
  pointer-events: none;
}

#bid-accept-css-id {
    display: block !important;
    width: 100% !important;
    padding: 15px 15px !important;
    background: #4d008d !important;
    margin: 5px 0 10px !important;
    border-radius: 10px !important;
    font-size: 0 !important;
}

#bid-accept-css-id > .nd_right_b2_info_con2 > h3{
    color: #ffffff !important;
}

#bid-accept-css-id > .nd_right_b2_info_con3 > h4{
    color: #ffffff !important;
}

#bid-accept-css-id > .nd_right_b2_info_con3 > h4 > label{
    color: #ffffff !important;
}
</style>

<!-- The Modal -->
<div class="modal" id="pre-auction-order-details-modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Auction Bid</h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <center><img src="{{ asset('frontend/images/login_pic.png') }}"><h3>you need to logged in first! After that you are able to bid on action</h3></center>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <a href="{{ route('satirtha.join') }}">Login</a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- end Modal  -->
<!-- The Modal -->
<div class="modal" id="auction-order-details-modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Bid Price</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="/action_page.php">
            <div class="form-group">
                <label for="user-name">User Name:</label>
                @guest
                    @php $username = ""; @endphp
                @else
                    @php $username = Auth::user()->name; @endphp
                @endguest
                <input type="text" class="form-control" placeholder="Enter user name" value="{{ $username }}" id="bid-user-name-id">
            </div>
            <div class="form-group">
                <label for="bid-price">Bid Price:</label>
                <input type="text" class="form-control" placeholder="Enter bid price" id="bid-price-id">
            </div>
            <div class="text-center">
                <button type="button" class="btn btn-primary" onclick="bid_price_submit()">Submit</button> <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        
      </div>

    </div>
  </div>
</div>
<!-- end Modal  -->
<section class="new_details_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="nd_head">
                    <h2 id="auction-heading"></h2>
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
                <!-- <blockquote><i class="fas fa-id-card"></i><p>All winners will be required to submit their contact information for shipping purposes after the auction ends.</p></blockquote> -->
                <h2>Product Other Details</h2>
                <div class="new_details_bot_left_info">
                    <!-- <div class="new_details_bot_left_ban">
                        <img src="{{ asset('frontend/images/at_pic.jpg') }}">
                    </div> -->
                    <div class="new_details_bot_left_info_con">
                        <!-- <div class="new_details_bot_left_pic">
                            <img src="{{ asset('frontend/images/at_pic.jpg') }}">
                        </div>
                        <h3>Air Jordan <span>1 CREATION</span></h3> -->
                        <p id="another-description-id"></p>
                        <!-- <div class="nt_details_bot">
                            <ul>
                                <li><a href="#"><i class="fas fa-link"></i>https://www.jordan.com/collection/</a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i>Jumpman23</a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5">
                <div class="nd_right_b1">
                    <div class="nd_right_b1_top">
                        <h5 class="item-auction-status1">...</h5>
                        <!-- <h2><span>3.92779</span>ETH <label>(16 bids)</label></h2>
                        <h4>$10,990.19</h4> -->
                        @guest
                            <a class="but1" href="javascript:;" onclick="pre_load_user_auction_order_details_fx()"> Bid The Deal </a>
                        @else
                            <a class="but1" href="javascript:;" onclick="auction_order_details_fx()"> Bid The Deal </a>
                        @endguest
                        <!-- <a class="but2" href="#">  Opensea </a> -->
                    </div>
                    <div class="nd_right_b1_bot">
                        <h6 class="item-auction-status2">...</h6>
                    </div>
                </div>
                <div class="nd_right_b2">
                    <h2>Recent bids</h2>
                    <div class="nd_right_b2_info">
                        <!-- <div class="nd_right_b2_info_con content">
                            <div class="nd_right_b2_info_con1">
                                <img src="{{ asset('frontend/images/no-photo.png') }}">
                            </div>
                            <div class="nd_right_b2_info_con2">
                                <h3>Welcome Home - Radical Face <span>2 weeks ago</span></h3>
                            </div>
                            <div class="nd_right_b2_info_con3">
                                <h4>3.92779 <label>ETH</label>
                                <span>$10,990.19</span></h4>
                            </div>
                        </div> -->
                        
                        <!-- <a class="load" href="#" id="loadMore">Load More</a> -->
                    </div>
                </div>
                <!-- <div class="nd_right_b3">
                    <a href="#"><i class="fas fa-play"></i> Learn How To Buy</a>
                    <h6>Explanation video will appear in a pop-up</h6>
                </div> -->
                <!-- <div class="nd_right_b2">
                    <h2>Proof of Authenticity</h2>
                    <div class="nd_right_b2_info nd_right_b2_info2">
                        <a class="load" href="#">View On-Chain Data <i class="fas fa-link"></i></a>
                        <a class="load" href="#">View on Etherscan <i class="fas fa-external-link-alt"></i></a>
                        <a class="load" href="#">View on OpenSea <i class="fas fa-external-link-alt"></i></a>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>
@php $page = $_SERVER['REQUEST_URI']; @endphp
@php $page1 = explode('/',$page); @endphp
@php $end_page = end($page1); @endphp 
@php echo base64_decode($end_page); @endphp
<div class="clearfix"></div>
@endsection
@section('jsContent')

<script>
    $(function(){
        load_auction_order_fx();
        load_auction_bidders_for_product_fx();
    });

    function load_auction_bidders_for_product_fx()
    {
        var load_val = "<?php echo $end_page; ?>";
        $.ajax({
            url: "{{ route('satirtha.auction-bidders-for-products') }}",
            type: "GET",
            data: {id: load_val},
            dataType: "json",
            success: function(event){
                $(".nd_right_b2_info").html(event);
                load_bid_auction_order_fx();
            }, error: function(event){

            }
        })
    }

    function load_bid_auction_order_fx()
    {
        $(".content").slice(0, 3).show();
        $("#loadMore").on("click", function(e){
            e.preventDefault();
            $(".content:hidden").slice(0, 3).slideDown();
            if($(".content:hidden").length == 0) {
            $("#loadMore").text("No Content").addClass("noContent");
            }
        });
    }

    function load_auction_order_fx()
    {
        var id = "<?php echo $end_page; ?>";
        $.ajax({
            url: "{{ route('satirtha.auction.order-details') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
                $("#short-description-id").html(event.auctionShortDesc);
                $("#full-description-id").html(event.auctionFullDesc);
                $("#another-description-id").html(event.auctionAnotherDesc);
                $("#auction-heading").html(event.auctionHeading);
                load_auction_status_fx();
                $("#auction-heading").html(event.auctionProductName);
                $("#auction-order-details-slider-id").html(event.auctionHtml);
                load_owl_carousal_fx();
                
                
            }, error: function(event){

            }
        })
    }

    function load_auction_status_fx()
    {
        var page_product_id = "<?php echo $end_page; ?>";
        $.ajax({
            url: "{{ route('satirtha.load-auction-product-status') }}",
            type: "GET",
            data: {id: page_product_id},
            dataType: "json",
            success: function(event){

                if(event == "ongoing")
                {
                    $(".item-auction-status1").html("AUCTION IS GOING ON THIS PRODUCT");
                    $(".item-auction-status2").html("AUCTION IS GOING ON");
                }

                if(event == "ended")
                {
                    $(".item-auction-status1").html("AUCTION IS ENDING");
                    $(".item-auction-status2").html("AUCTION ENDED");
                    $(".nd_right_b1_top").html('<h5 class="item-auction-status1">AUCTION IS ENDING</h5><a class="but1" href="javascript:;"> AUCTION ENDED </a>');
                    load_auction_ended_action_fx();
                }
            }, error: function(event){

            }
        })
    }


    function auction_order_details_fx(){
        $("#auction-order-details-modal").modal('show');
    }

    function pre_load_user_auction_order_details_fx()
    {
        $("#pre-auction-order-details-modal").modal('show');
    }

    function load_auction_ended_action_fx()
    {
        var page_product_id = "<?php echo $end_page; ?>";
        $.ajax({
            url: "{{ route('satirtha.auction-ended-action') }}",
            type: "GET",
            data: {id: page_product_id},
            dataType: "json",
            success: function(event){
                load_auction_bidders_for_product_fx();
            }, error: function(event){

            }
        })
    }


    
   
</script>

    @guest

    @else 
    <script>

        function bid_price_submit()
        {
            var bid_user_name = $("#bid-user-name-id").val();
            var bid_price = $("#bid-price-id").val();
            var user_id = "<?php echo Auth::user()->id; ?>";
            var page_product_id = "<?php echo $end_page; ?>";
            
            $.ajax({
                url: "{{ route('satirtha.auction-product-bid') }}",
                type: "GET",
                data: { bid_user_name: bid_user_name, bid_price: bid_price, user_id: user_id, page_product_id: page_product_id },
                dataType: "json",
                success: function(event){
                    if(event == "already")
                    {
                        $("#auction-order-details-modal").modal('hide');
                        error_pass_alert_show_msg('You are already bid on this product');
                    }

                    if(event == "success")
                    {
                        $("#auction-order-details-modal").modal('hide');
                        success_pass_alert_show_msg("bid successfully done");
                    }

                    if(event == "error")
                    {
                        $("#auction-order-details-modal").modal('hide');
                        error_pass_alert_show_msg('You are not-able to bid on this product');
                    }
                }, error: function(event){

                }
            })
            
        }

    </script>
    @endguest
@endsection