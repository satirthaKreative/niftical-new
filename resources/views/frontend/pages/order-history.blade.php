@extends('frontend.app')
@section('content')
@guest
<script>
    window.location.href = "{{ route('satirtha.join') }}";
</script>
@else
<style type="text/css">
body{
    margin: 0;
}
.order_details_area{
    padding: 60px 0;
}
.order_details_area table{
    width: 100%;
}
.order_details_area table img{
    width: 100%;
    box-shadow: 0 0 12px -9px #000;
}
.order_details_area table tr th{
    padding: 15px 10px;
    font-size: 16px;
    color: #fff;
    font-weight: 600;
    text-align: center;
    text-transform: uppercase;
}
.order_details_area table tr:nth-child(1) {background-color: #6a00a0 !important;}
.order_details_area table tr:nth-child(odd) {background-color: #6a00a030;}
.order_details_area table tr:nth-child(even) {background-color: #e6e6e629;}
.order_details_area table tr td{
    padding: 15px 10px;
    font-size: 16px;
    color: #000;
    text-align: center;
}
.order_details_area table tr td:nth-child(1){
    width: 150px;
}
.pdetail_table_con{
    max-height: 1200px;
    overflow: auto;
    width: 100%;
}
/* Style the tab */
.tab {
  overflow: hidden;
  width: 100%;
      padding: 15px;
    background: #74449d52;
    border-radius: 10px 10px 0 0;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  outline: none;
  cursor: pointer;
  padding: 12px 16px;
  transition: 0.3s;
  font-size: 17px;
    background: #ccc;
    margin-right: 10px;
    border-radius: 10px;
    border: solid 2px #666;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #4d008da1;
    border: solid 2px #4d008d;
    color: #fff;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #4d008da1;
    border: solid 2px #4d008d;
    color: #fff;
}

/* Style the tab content */
.tabcontent {
  display: none;
  width: 100%;
}
@media  (max-width: 991px){
.order_details_area{
    padding: 40px 15px;
}
.order_details_area table {
    width: 740px;
}
}
@media  (max-width: 767px){
.order_details_area{
    padding: 30px 15px;
}
.order_details_area table tr th {
    padding: 10px 10px;
    font-size: 14px;
}
.order_details_area table tr td:nth-child(1) {
    width: 100px;
}
.order_details_area table tr td {
    padding: 10px 10px;
    font-size: 14px;
}
}
</style>

<div class="inner-ban">
    <img src="{{ asset('frontend/images/inner-ban.jpg') }}" alt="">
    <div class="ban text">
        <h2>Order Details</h2>
        <ul>
            <li><a href="#">Home <i class="fas fa-chevron-right"></i></a></li>
            <li>Order Details</li>
        </ul>
    </div>
</div>

<section class="order_details_area">
    <div class="container">
        <div class="row">
            <div class="tab">
              <button class="tablinks" onclick="openCity(event, 'od')" id="defaultOpen">Order History</button>
              <button class="tablinks" onclick="openCity(event, 'hod')">Auction Order History</button>
            </div>

            <div id="od" class="tabcontent">
                <div class="pdetail_table_con">
                    <table id="od-order-details-id">
                    <tr>
                                                    <th>image</th>
                                                    <th>name</th>
                                                    <th>price</th>
                                                    <th>Date</th>
                                                </tr>
                        <tr>
                            <td colspan=4 class="text-info"><center><i class="fa fa-spinner"></i> loading order history</center></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div id="hod" class="tabcontent">
                <div class="pdetail_table_con">
                    <table id="hod-order-details-id">
                        <tr>
                            <th>image</th>
                            <th>name</th>
                            <th>price</th>
                            <th>Date</th>
                        </tr>
                        <tr>
                            <td colspan=4 class="text-info"><center><i class="fa fa-spinner"></i> loading auction order history</center></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('jsContent')
<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

<script>
    $(function(){
        load_normal_order_history_fx();
    });

    function load_normal_order_history_fx()
    {
        $.ajax({
            url: "{{ route('satirtha.normal-order-history') }}",
            type: "GET",
            dataType: "json",
            success: function(event){
                $("#od-order-details-id").html(event.normal_order_history_html);
                $("#hod-order-details-id").html(event.auction_order_history_html);
                // load_auction_order_history_fx();
            }, error: function(event){
                
            }
        })
    }

    function load_auction_order_history_fx()
    {
        $.ajax({
            url: "{{ route('satirtha.order-history-listing') }}",
            type: "GET",
            dataType: "json",
            success: function(resp){
                $("#od-order-details-id").html(resp);
            }, error: function(resp){
                
            }
        });
    }
</script>
@endsection
@endguest