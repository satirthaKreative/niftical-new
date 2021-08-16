@extends('frontend.app')
@section('content')

<style type="text/css">
.pl_area{
    padding: 70px 0 50px;
    background: #eee;
}
.pl_con{
    padding: 30px;
    background: #fff;
    box-shadow: 0 0 19px -12px #000;
    border-radius: 15px;
    margin: 0 0 30px;
}
.pl_con img{
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 15px;
    box-shadow: 0 0 20px -12px #000;
}
.pl_con h2{
    color: #000;
    font-size: 20px;
    font-weight: 500;
    margin: 15px 0 20px;
}
.pl_con h4{
    color: #777;
    font-size: 16px;
    margin-bottom: 20px;
    font-weight: 400;
}
.pl_con h4 span{
    color: #4d008d;
    padding: 5px 10px;
    background: #ccc;
    margin-left: 10px;
    border-radius: 5px;
    font-weight: 600;
}
.pl_con h5{
    color: #777;
    font-size: 16px;
    margin-bottom: 20px;
    font-weight: 400;
}
.pl_con h5 span{
    color: #4d008d;
    font-weight: 600;
}
.pl_con p{
    color: #666;
    font-weight: 400;
    line-height: 26px;
    font-size: 14px;
}
.pl_con .progress{
    margin-bottom: 20px;
}
.pl_con .col-lg-7{
    position: relative;
}
a.view_ad{
    color: #fff;
    background: #4d008d;
    display: inline-block;
    margin-top: 15px;
    font-size: 14px;
    padding: 14px 20px;
    border-radius: 10px;
    text-transform: uppercase;
    font-weight: 600;
    position: absolute;
    right: 0;
    bottom: 0;
}
a.view_ad:hover{
    background: #000;
}
.pl_sort_area{
    width: 100%;
    text-align: right;
}
.pl_sort_area select{
    margin: 0 0 25px;
    border: solid 2px #000;
    height: 44px;
    padding: 10px 15px;
    border-radius: 5px;
    font-size: 16px;
}
@media (max-width: 767px){
.pl_con {
    padding: 20px;
    margin: 0 0 20px;
}
a.view_ad{
    position: relative;
    margin: 10px 0 0;
}
.pl_area {
    padding: 40px 15px 30px;
}
.pl_con img {
    height: auto;
}
}

#auction-home-id
{
    width: 100%;
}

</style>

<div class="inner-ban">
    <img src="{{ asset('frontend/images/inner-ban.jpg') }}" alt="">
    <div class="ban text">
        <h2>Product Listing</h2>
        <ul>
            <li><a href="#">Home <i class="fas fa-chevron-right"></i></a></li>
            <li>Product Listing</li>
        </ul>
    </div>
</div>

<section class="pl_area">
    <div class="container">
        <div class="row" >
            <div class="pl_sort_area">
                <select id="auction-sort-time-id" onchange=auction_sort_time_fx()><option value="">Default Sorting</option><option value="oldAuction">Old Auction</option><option value="newAuction">New Auction</option></select>
            </div>
            <div id="auction-home-id"></div>
        </div>
    </div>
</section>
@endsection
@section('jsContent')
    <script>
        $(function(){
            load_auction_home_page_fx();
        });

        function load_auction_home_page_fx()
        {
            var id = "";
            $.ajax({
                url: "{{ route('satirtha.auction.listing-products') }}",
                type: "GET",
                data: {id: id},
                dataType: "json",
                success: function(event){
                    $("#auction-home-id").html(event.auctionHtml);
                }, error: function(event){

                }
            })
        }

        function auction_sort_time_fx()
        {
            var auction_val = $("#auction-sort-time-id").val();
            if(auction_val == "" || auction_val == null)
            {
                load_auction_home_page_fx();
            }
            else
            {
                $.ajax({
                    url: "{{ route('satirtha.auction.listing-products') }}",
                    type: "GET",
                    data: {id: auction_val},
                    dataType: "json",
                    success: function(event){
                        $("#auction-home-id").html(event.auctionHtml);
                    }, error: function(event){

                    }
                });
            }
        }
    </script>
@endsection