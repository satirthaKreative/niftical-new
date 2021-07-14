@extends('frontend.app')
@section('content')

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
.order_details_area table tr:nth-child(1) {background-color: #1919a2b8 !important;}
.order_details_area table tr:nth-child(odd) {background-color: #e8e8ff;}
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
            <div class="pdetail_table_con">
                <table>
                    <tr>
                        <th>image</th>
                        <th>order id</th>
                        <th>name</th>
                        <th>quantity</th>
                        <th>price</th>
                    </tr>
                    <tr>
                        <td><img src="prod_pic.jpeg"></td>
                        <td>#1234567890</td>
                        <td>18 mega pixel camera</td>
                        <td>1</td>
                        <td>$200.00</td>
                    </tr>
                    <tr>
                        <td><img src="prod_pic.jpeg"></td>
                        <td>#1234567890</td>
                        <td>18 mega pixel camera</td>
                        <td>1</td>
                        <td>$200.00</td>
                    </tr>
                    <tr>
                        <td><img src="prod_pic.jpeg"></td>
                        <td>#1234567890</td>
                        <td>18 mega pixel camera</td>
                        <td>1</td>
                        <td>$200.00</td>
                    </tr>
                    <tr>
                        <td><img src="prod_pic.jpeg"></td>
                        <td>#1234567890</td>
                        <td>18 mega pixel camera</td>
                        <td>1</td>
                        <td>$200.00</td>
                    </tr>
                    <tr>
                        <td><img src="prod_pic.jpeg"></td>
                        <td>#1234567890</td>
                        <td>18 mega pixel camera</td>
                        <td>1</td>
                        <td>$200.00</td>
                    </tr>
                    <tr>
                        <td><img src="prod_pic.jpeg"></td>
                        <td>#1234567890</td>
                        <td>18 mega pixel camera</td>
                        <td>1</td>
                        <td>$200.00</td>
                    </tr>
                    <tr>
                        <td><img src="prod_pic.jpeg"></td>
                        <td>#1234567890</td>
                        <td>18 mega pixel camera</td>
                        <td>1</td>
                        <td>$200.00</td>
                    </tr>
                    <tr>
                        <td><img src="prod_pic.jpeg"></td>
                        <td>#1234567890</td>
                        <td>18 mega pixel camera</td>
                        <td>1</td>
                        <td>$200.00</td>
                    </tr>
                    <tr>
                        <td><img src="prod_pic.jpeg"></td>
                        <td>#1234567890</td>
                        <td>18 mega pixel camera</td>
                        <td>1</td>
                        <td>$200.00</td>
                    </tr>
                    <tr>
                        <td><img src="prod_pic.jpeg"></td>
                        <td>#1234567890</td>
                        <td>18 mega pixel camera</td>
                        <td>1</td>
                        <td>$200.00</td>
                    </tr>
                    <tr>
                        <td><img src="prod_pic.jpeg"></td>
                        <td>#1234567890</td>
                        <td>18 mega pixel camera</td>
                        <td>1</td>
                        <td>$200.00</td>
                    </tr>
                    <tr>
                        <td><img src="prod_pic.jpeg"></td>
                        <td>#1234567890</td>
                        <td>18 mega pixel camera</td>
                        <td>1</td>
                        <td>$200.00</td>
                    </tr>
                    <tr>
                        <td><img src="prod_pic.jpeg"></td>
                        <td>#1234567890</td>
                        <td>18 mega pixel camera</td>
                        <td>1</td>
                        <td>$200.00</td>
                    </tr>
                    <tr>
                        <td><img src="prod_pic.jpeg"></td>
                        <td>#1234567890</td>
                        <td>18 mega pixel camera</td>
                        <td>1</td>
                        <td>$200.00</td>
                    </tr>
                    <tr>
                        <td><img src="prod_pic.jpeg"></td>
                        <td>#1234567890</td>
                        <td>18 mega pixel camera</td>
                        <td>1</td>
                        <td>$200.00</td>
                    </tr>
                    <tr>
                        <td><img src="prod_pic.jpeg"></td>
                        <td>#1234567890</td>
                        <td>18 mega pixel camera</td>
                        <td>1</td>
                        <td>$200.00</td>
                    </tr>
                    <tr>
                        <td><img src="prod_pic.jpeg"></td>
                        <td>#1234567890</td>
                        <td>18 mega pixel camera</td>
                        <td>1</td>
                        <td>$200.00</td>
                    </tr>
                    <tr>
                        <td><img src="prod_pic.jpeg"></td>
                        <td>#1234567890</td>
                        <td>18 mega pixel camera</td>
                        <td>1</td>
                        <td>$200.00</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
@section('jsContent')

@endsection