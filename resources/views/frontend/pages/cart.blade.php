@extends('frontend.app')
@section('content')
<style>
p.loading_text {
    text-align: center;
    font-size: 24px;
    margin-bottom: 0;
    color: #6a959e;
}
.p-details-popup {    position: relative;cursor:pointer;}
.p-details-popup:hover span{    visibility: visible;}
.p-details-popup span {
    visibility: hidden;
    width: 160px;
    background-color: #6a959e;
    color: #fff!important;
    text-align: center;
    border-radius: 6px;
    padding: 15px 10px;
    position: absolute;
    font-size: 12px;
    z-index: 1;
    bottom: 25px;
    text-transform: capitalize;
    left: -25%;
}
.p-details-popup span::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #6a959e transparent transparent transparent;
}

/*------sujay------*/
label.cardtype{
    padding-top: 10px;
}
label.cardtype input[type=radio]{
    width: 20px !important;
    margin: 2px 10px 0 0;
    height: 20px !important;
    float: left;
}
label.cardtype img{
    width: 100px;
    cursor: pointer;
}
</style>
<div class="inner-ban">
    <img src="{{ asset('frontend/images/inner-ban.jpg') }}" alt="">
    <div class="ban text">
        <h2>Cart</h2>
        <ul>
            <li><a href="{{ route('satirtha.home') }}">Home <i class="fas fa-chevron-right"></i></a></li>
            <li>Cart</li>
        </ul>
    </div>
</div>

<section class="cart_area">
    <div class="container">
        <div class="row">
            <form id="msform" action="https://sandbox.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="business" value="sb-vvyxq6145873@business.example.com">
                <input type="hidden" name="amount" class="sub-and-total-paypal-class" value="200" > 
 
                <input type="hidden" name="no_shipping" value="0">
                <input type="hidden" name="no_note" value="1">
                <input type="hidden" name="currency_code" value="USD">
                <input value="CustomerName" name="on0" type="hidden">
                <input value="CustomerEmail" name="on1" type="hidden">
                <input value="test" name="os0" required type="hidden"> 
                <input value="test@gmail.com" name="os1" required type="hidden"> 
                <input type="hidden" name="return" value="{{ route('satirtha.home') }}">

                <!-- progressbar -->
                <ul id="progressbar">
                <li class="active"><span>Shopping Cart</span></li>
                <li><span>Checkout</span></li>
                <li><span>Thank You</span></li>
                </ul>
                <!-- fieldsets -->
                <fieldset>
                    <div class="row">
                        <div class="col-md-8 cart_table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                               

                                <tbody id="cart-details-table-id">
                                    <tr>
                                        <td colspan=4><p class="loading_text"> Loading your cart details . . . </p></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="cart_right_bar">
                                <h3>Cart  Totals</h3>
                                <table>
                                    <tr>
                                        <td>Subtotal</td>
                                        <td class="text-right"><strong class="sub-and-total-class"></strong></td>
                                    </tr>
                                    <!-- <tr>
                                        <td>Shipping</td>
                                        <td class="text-right"><strong>Flat Rate: $10.00</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <td class="text-right"><strong>$0.00</strong></td>
                                    </tr> -->
                                    <tr>
                                        <td><strong>Total</strong></td>
                                        <td class="text-right"><strong class="sub-and-total-class"></strong></td>
                                    </tr>
                                </table>
                                <!-- <a href="#">Proceed to Checkout</a> -->
                            </div>
                        </div>
                    </div>
                    <input type="button" name="next" class="next action-button" value="Countinue Shopping" />
                </fieldset>
                <fieldset>
                <div class="row">
                        <div class="col-md-8 billing_add">
                            <h2>Billing Address</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="fname" required placeholder="First Name">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="lname" required placeholder="Last Name">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="cname" required placeholder="Company name">
                                    </div>
                                    <div class="col-md-6">
                                        <select name="country_region_name" required id="country-region-name-id">
                                            <option>Country / Region</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" name="sname1" required placeholder="Street address *">
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" name="sname2" required placeholder="Street address *">
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" name="city_name" required placeholder="Town / City *">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="zip_code" required placeholder="Postcode / ZIP *">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="phone_num" required placeholder="Phone *">
                                    </div>
                                    <div class="col-md-12">
                                        <input type="email" name="email_personal" required placeholder="Email address *">
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <h4>Pay securely using Paypal.</h4>
                                        <h5 class="sub-and-total-class">$0</h5>
                                    </div>
                                      <div class="col-md-12">
                                        <label class="cardtype"><input type="radio" checked name="cardtype"><img src="{{ asset('frontend/images/paypal_icon.png') }}" alt=""></label>
                                        
                                      </div>
                                      
                                    </div>
                        </div>
                        <div class="col-md-4">
                            <div class="cart_right_bar">
                                <h3>Cart  Totals</h3>
                                <table>
                                    <tr>
                                        <td>Subtotal</td>
                                        <td class="text-right"><strong class="sub-and-total-class"></strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total</strong></td>
                                        <td class="text-right"><strong class="sub-and-total-class"></strong></td>
                                    </tr>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                <input type="button" name="previous" class="previous action-button" value="Previous" />
                
                <input type="submit" name="submit" class="submit action-button" value="Submit" />
                </fieldset>
                <fieldset>
                <div class="row">
                    <div class="col-md-12">
                        <div class="thank_top_info">
                            <img src="{{ asset('frontend/images/thank_tick.png') }}">
                            <h3>Thank you, Your order has been placed.</h3>
                            <ul>
                                <li>
                                    <h4>Order number</h4>
                                    <h5>#1234567890987654321</h5>
                                </li>
                                <li>
                                    <h4>Status</h4>
                                    <h5>Processing</h5>
                                </li>
                                <li>
                                    <h4>Date</h4>
                                    <h5>November 20, 2020</h5>
                                </li>
                                <li>
                                    <h4>Total</h4>
                                    <h5>$63.98</h5>
                                </li>
                                <li>
                                    <h4>Payment method</h4>
                                    <h5>Debit Cart</h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8 thanks_area">
                            <div class="cart_right_bar">
                                <h3>Cart  Totals</h3>
                                <table>
                                    <tr>
                                        <td>Subtotal</td>
                                        <td class="text-right"><strong class="sub-and-total-id">$53.98</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td class="text-right"><strong>Flat Rate: $10.00</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <td class="text-right"><strong>$0.00</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="last"><strong>Total</strong></td>
                                        <td class="text-right last sub-and-total-class"><strong>$63.98</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="thankyou_right">
                                <h2>BILLING ADDRESS</h2>
                                <h4>John Doe</h4>
                                <h4>Donald Company</h4>
                                <h4>Steven street</h4>
                                <h4>El Carjon, CA 92020</h4>
                                <h4>123456789</h4>
                            </div>
                        </div>
                </div>
                <input type="button" name="previous" class="previous action-button" value="Previous" />
                <input type="submit" name="submit" class="submit action-button" value="Submit" />
                </fieldset>
                </form>
        </div>
    </div>
</section>

<div class="clearfix"></div>
@endsection
@section('jsContent')
<script>
    $(function(){
        load_cart_details_fx();
    });

    function load_cart_details_fx()
    {
        $.ajax({
            url: "{{ route('satirtha.show-cart-details') }}",
            type: "GET",
            dataType: "json",
            success: function(event){
                $("#cart-details-table-id").html(event.cart_details);
                load_total_price_cart_fx();
            }, error: function(event){

            }
        })
    }

    function load_total_price_cart_fx()
    {
        $.ajax({
            url: "{{ route('satirtha.total-cart-price') }}",
            type: "GET",
            dataType: "json",
            success: function(event){
                $(".sub-and-total-class").html("$"+event);
                $(".sub-and-total-paypal-class").val(event);
                load_country_region_fx();
            }, error: function(event){

            }
        })
    }

    function product_delete_cart_fx(product_id)
    {
        $.ajax({
            url: "{{ route('satirtha.product-delete-cart') }}",
            type: "get",
            data: {id: product_id},
            dataType: "json",
            success: function(event){
                if(event == "success")
                {
                    success_pass_alert_show_msg("Product removed successfully from cart");
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
                else if(event == "error")
                {
                    error_pass_alert_show_msg("Product didn't removed successfully from cart");
                }
                else
                {
                    error_pass_alert_show_msg("Server down! in maintanance");
                }
            }, error: function(event){

            }
        })
    }

    function product_cart_quantity_change_fx(cart_id, cart_quantity, status_check)
    {
        $.ajax({
            url: "{{ route('satirtha.product-cart-quantity-fx') }}",
            type: "GET",
            data: {cart_id: cart_id, cart_quantity: cart_quantity, status_check: status_check},
            dataType: "json",
            success: function(event)
            {
                $("#product-cart-id"+cart_quantity).val(event);
                location.reload();
            },
            error: function(event)
            {

            }
        })
    }


    function load_country_region_fx()
    {
        $.ajax({
            url: "{{ route('satirtha.country-cart-fx') }}",
            type: "GET",
            dataType: "json",
            success: function(event)
            {
                jQuery("#country-region-name-id").html(event);
            }, 
            error: function(event)
            {

            }
        })
    } 
</script>
@endsection