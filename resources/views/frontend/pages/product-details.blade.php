@extends('frontend.app')
@section('content')

<!-- add to cart modal -->
<div class="modal fade" id="myModal3">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>        
        <!-- Modal body -->
        <div class="modal-body">
          <h3>Customize Your Product</h3>
          <form action="{{ route('satirtha.review-product-additional-details') }}" method="GET">
            @csrf
            @foreach($productSingleQuery as $PSQuery)
                <input type="hidden" name="product_id" value="{{ $PSQuery['id'] }}">
            @endforeach
                <input type="text" name="product_customize_name" id="product_customize_name_id" placeholder="Enter Your Name For Print">
                <input type="text" name="product_customize_link" id="product_customize_link_id" placeholder="Link to side to be placed on QR Code">
                <button type="button" class="skip" onclick="skip_to_cart()">Skip</button>
              	<button class="addtocart" type="submit">Add To Cart</button>
          </form>
        </div>        
      </div>
    </div>
</div>
<!-- end of add to cart modal -->


<div class="inner-ban">
    <img src="{{ asset('frontend/images/inner-ban.jpg') }}" alt="">
    <div class="ban text">
    @foreach($productSingleQuery as $PSQuery)
        <h2>{{ $PSQuery['product_name'] }}</h2>
        <ul>
            <li><a href="{{ route('satirtha.home') }}">Home <i class="fas fa-chevron-right"></i></a></li>
            <li>Products</li>
        </ul>
    @endforeach
    </div>
</div>

<section class="prod_details_area">
  <div class="container">
    <div class="row">
        <div class="col-md-6">
            <div id="product-slider" class="has-social-share">
                <div class="col">
                  <div id="product-slider__main" class="object-fit--contain">
                  @foreach($productSingleQuery as $PSQuery)
                  <div class="zoom">
                    <img class="lazyload" data-src="{{ str_replace('public','storage',asset($PSQuery['product_thumbnail'])) }}" alt="" />
                  </div>
                  @endforeach

                  @foreach($productSingleImgsQuery as $PSQuery)
                  <div class="zoom">
                    <img class="lazyload" data-src="{{ str_replace('public','storage',asset($PSQuery['product_images'])) }}" alt="" />
                  </div>
                  @endforeach
                </div>
                </div>
                <div class="col">
                  <div id="product-slider__nav" class="object-fit--contain">
                  @foreach($productSingleQuery as $PSQuery)
                    <img class="lazyload" data-src="{{ str_replace('public','storage',asset($PSQuery['product_thumbnail'])) }}" alt="" />
                  @endforeach
                    
                  @foreach($productSingleImgsQuery as $PSQuery)
                    <img class="lazyload" data-src="{{ str_replace('public','storage',asset($PSQuery['product_images'])) }}" alt="" />
                  @endforeach

                </div>
                </div>
            </div>
        </div>

        @foreach($productSingleQuery as $PSQuery)
        <div class="col-md-6">
            <h2>{{ $PSQuery['product_name'] }}</h2>
            <h3>$ {{  $PSQuery['product_price'] }}</h3>
            <ul id="customer-full-review-star-id">
                <!-- <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><span>20 customer ratings</span></li> -->
            </ul>
            <p>{{  $PSQuery['product_short_description'] }}</p>
            <a href="#" data-toggle="modal" data-target="#myModal3">Add To Cart</a>
        </div>
        @endforeach
    </div>
  </div>
</section>

<section class="prod_details_tab">
    <div class="container">
        <div class="row">
            <div class="tab">
              <button class="tablinks" onclick="openCity(event, 'description')" id="defaultOpen">Description <span></span></button>
              <button class="tablinks" onclick="openCity(event, 'info')">Additional Information <span></span></button>
              <button class="tablinks" onclick="openCity(event, 'review')">Reviews <span></span></button>
            </div>

            <div id="description" class="tabcontent">
                <p>{{ $PSQuery['product_full_description'] }} </p>
            </div>

            <div id="info" class="tabcontent">
              <p>{{ $PSQuery['product_additional_information'] }}</p>
            </div>

            <div id="review" class="tabcontent">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="review-sec">
                            <h3>Review</h3>
                            <form action="">
                                <input type="hidden" name="review_star_name" id="review-star-id" value="0">
                                @foreach($productSingleQuery as $PSQuery)
                                <input type="hidden" name="review_product_name" id="review-product-id" value="{{ $PSQuery['id'] }}">
                                @endforeach
                                <i class = "fa fa-star" aria-hidden = "true" id = "st1"></i>
                                <i class = "fa fa-star" aria-hidden = "true" id = "st2"></i>
                                <i class = "fa fa-star" aria-hidden = "true" id = "st3"></i>
                                <i class = "fa fa-star" aria-hidden = "true" id = "st4"></i>
                                <i class = "fa fa-star" aria-hidden = "true" id = "st5"></i>
                                <!-- <div class="star">
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class='fas fa-star-half-alt'></i></a>                        
                                </div> -->
                                <div class="input_holder">
                                    <input type="text" id="review-star-name" name="review_star_name" placeholder="Name*">
                                </div>
                                <div class="input_holder">
                                    <textarea rows="4" name="review_star_msg" id="review-star-msg" cols="" placeholder="Message"></textarea>
                                </div>
                                <div class="input_holder">
                                    <input type="submit" name="submit_review_name" id="submit-review-id" value="Submit">
                                </div>

                            </form>                    
                        </div>
                    </div>
                </div>
                
                <div class="comment_sec">
                    <h3>Comments</h3>
                    <ul id="comments-ul-id">
                        @foreach($reviewQuery as $rQuery)
                        <li>
                            <div class="c_img">
                                <img src="{{ asset('backend/dist/img/avatar5.png') }}" alt="">
                            </div>
                            
                            <h3>{{ $rQuery['customer_name'] }}</h3>
                            <p>
                            <?php 
                                $countReview =  $rQuery['review_start_count']; 
                                $fullStarCount = $rQuery['review_start_count'];
                                $noStarCount = 5 - $rQuery['review_start_count'];

                                for($i = 0; $i < $fullStarCount; $i++ )
                                {
                            ?>
                                <i class = "fa fa-star" aria-hidden = "true" style="color: yellow"></i>
                            <?php 
                                }

                                for($j = 0; $j < $noStarCount; $j++ )
                                {
                            ?>
                                <i class = "fa fa-star" aria-hidden = "true"></i>
                            <?php 
                                }
                            ?>
                            
                            </p>
                            <p>{{ $rQuery['customer_msg'] }}</p>
                        </li>
                        @endforeach
                    </ul>
                </div>


                
            </div>
        </div>
    </div>
            
</section>

<div class="clearfix"></div>
@endsection
@section('jsContent')
<script>
    $(function(){
        load_products_fx();load_product_footer_fx();

        /// star

            $("#st1").click(function() {
                $("#review-star-id").val(1);
                $(".fa-star").css("color", "#ccc");
                $("#st1").css("color", "yellow");

            });
            $("#st2").click(function() {
                $("#review-star-id").val(2);
                $(".fa-star").css("color", "#ccc");
                $("#st1, #st2").css("color", "yellow");

            });
            $("#st3").click(function() {
                $("#review-star-id").val(3);
                $(".fa-star").css("color", "#ccc")
                $("#st1, #st2, #st3").css("color", "yellow");

            });
            $("#st4").click(function() {
                $("#review-star-id").val(4);
                $(".fa-star").css("color", "#ccc");
                $("#st1, #st2, #st3, #st4").css("color", "yellow");

            });
            $("#st5").click(function() {
                $("#review-star-id").val(5);
                $(".fa-star").css("color", "#ccc");
                $("#st1, #st2, #st3, #st4, #st5").css("color", "yellow");

            });

        /// end star
    });


    function load_products_fx()
    {
        $.ajax({
            url: "{{ route('satirtha.load-all-products') }}",
            type: "GET",
            dataType: "json",
            success: function(event){
                $("#product-listing-id").html(event.product_datas);
                load_product_star_review_fx();
            }, error: function(event){

            }
        })
    }

    function load_product_footer_fx()
    {
        $.ajax({
            url: "{{ route('satirtha.load-modal-product-details') }}",
            type: "GET",
            dataType: "json",
            success: function(event){
                $(".header-product-modal-select-class").html(event.product_names);
                $('.header-product-modal-select-class').select2();
            }, error: function(event){

            }
        })
    }

    $("#submit-review-id").click(function(e){
        e.preventDefault();
        var review_star_count = $("#review-star-id").val();
        var review_product_id = $("#review-product-id").val();
        var review_star_name = $("#review-star-name").val();
        var review_star_msg = $("#review-star-msg").val();

        if(review_star_count == 0)
        {
            error_pass_alert_show_msg("Please choose star rating");
        }
        else if(review_star_name == "")
        {
            error_pass_alert_show_msg("Please enter your name");
        }
        else if(review_star_msg == "")
        {
            error_pass_alert_show_msg("Please enter your comment");
        }
        else
        {
            $.ajax({
                url: "{{ route('satirtha.review-on-product') }}",
                type: "GET",
                data: {review_star_count: review_star_count, review_product_id: review_product_id, review_star_name: review_star_name, review_star_msg: review_star_msg},
                dataType: "json",
                success: function(event)
                {
                    if(event == "success")
                    {
                        success_pass_alert_show_msg("Successfully Saved");
                        $(".fa-star").css("color", "#ccc");
                        $("#review-star-id").val(0);
                        $("#review-star-name").val(" ");
                        $("#review-star-msg").val(" ");
                        load_review_panel();
                    }
                    else if(event == "error")
                    {
                        error_pass_alert_show_msg("Data not inserted successfully");
                    }
                },
                error: function(event)
                {

                }
            });
        }
    });

    // load review panel
    function load_review_panel()
    {
        var review_product_id = $("#review-product-id").val();
        $.ajax({
            url: "{{ route('satirtha.product-review-panel-load') }}",
            type: "GET",
            data: {review_id: review_product_id},
            dataType:  "json",
            success: function(event){
                $("#comments-ul-id").html(event);
            }, error: function(event){

            }
        })
    }

    // load star review 
    function load_product_star_review_fx()
    {
        var product_id = $("#review-product-id").val();
        $.ajax({
            url: "{{ route('satirtha.review-star-count') }}",
            type: "GET",
            data: {productId: product_id},
            dataType: "json",
            success: function(event){
                $("#customer-full-review-star-id").html(event);
                load_product_additional_data_fx(product_id);
            }, error: function(event){

            }
        })
    }


    function load_product_additional_data_fx(pId)
    {
        $.ajax({
            url: "{{ route('satirtha.show-additional-product-details') }}",
            type: "GET",
            data: {pId: pId},
            dataType: "json",
            success: function(event){
                $("#product_customize_name_id").val(event.custom_name);
                $("#product_customize_link_id").val(event.custom_link);
            }, error: function(event){

            }
        })
    }

    function skip_to_cart()
    {
        var product_id = $("#review-product-id").val();
        $.ajax({
            url: "{{ route('satirtha.additional-product-skip-fx') }}",
            type: "GET",
            data: {pId: product_id},
            dataType: "json",
            success: function(event){
                window.location.href="{{ route('satirtha.show-cart-page') }}";
            }, error: function(event){

            }
        });
    }

    
</script>
@endsection