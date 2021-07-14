@extends('frontend.app')
@section('content')
<div class="inner-ban">
    <img src="{{ asset('frontend/images/inner-ban.jpg') }}" alt="">
    <div class="ban text">
        <h2>Products</h2>
        <ul>
            <li><a href="{{ route('satirtha.home') }}" >Home <i class="fas fa-chevron-right"></i></a></li>
            <li>Categories</li>
        </ul>
    </div>
</div>

<section class="prod_area">
    <div class="container">
        <div class="row">
        <div class="col-lg-3 side-bar">
            <h4>Categories</h4>
            <ul>
                <li><a href="#">All</a></li>
                <li><a href="#">Canvas Arts</a></li>
                <li><a href="#">metallic </a></li>
                <li><a href="#">acrylic prints</a></li>
            </ul>
        </div>  
        <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-6">
                <div class="prod_pic">
                    <div class="prod_pic_con">
                        <img src="{{ asset('frontend/images/p_pic1.png') }}">
                        <div class="hov-but">
                        <a href="#" data-toggle="modal" data-target="#myModal2">Order Now</a>
                    </div>
                    </div>
                    <h3>Canvas Photo Printing</h3>
                    <h4>$77.65</h4>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-6">
                <div class="prod_pic">
                    <div class="prod_pic_con">
                        <img src="{{ asset('frontend/images/p_pic2.png') }}">
                        <div class="hov-but">
                        <a href="#" data-toggle="modal" data-target="#myModal2">Order Now</a>
                    </div>
                    </div>
                    <h3>Canvas Photo Printing</h3>
                    <h4>$77.65</h4>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-6">
                <div class="prod_pic">
                    <div class="prod_pic_con">
                        <img src="{{ asset('frontend/images/p_pic3.png') }}">
                        <div class="hov-but">
                        <a href="#" data-toggle="modal" data-target="#myModal2">Order Now</a>
                    </div>
                    </div>
                    <h3>Canvas Photo Printing</h3>
                    <h4>$77.65</h4>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-6">
                <div class="prod_pic">
                    <div class="prod_pic_con">
                        <img src="{{ asset('frontend/images/p_pic4.png') }}">
                        <div class="hov-but">
                        <a href="#" data-toggle="modal" data-target="#myModal2">Order Now</a>
                    </div>
                    </div>
                    <h3>Metallic Arts Golden Steel Wall Clocks</h3>
                    <h4>$77.65</h4>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-6">
                <div class="prod_pic">
                    <div class="prod_pic_con">
                        <img src="{{ asset('frontend/images/p_pic5.png') }}">
                        <div class="hov-but">
                        <a href="#" data-toggle="modal" data-target="#myModal2">Order Now</a>
                    </div>
                    </div>
                    <h3>Canvas Photo Printing</h3>
                    <h4>$77.65</h4>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-6">
                <div class="prod_pic">
                    <div class="prod_pic_con">
                        <img src="{{ asset('frontend/images/p_pic6.png') }}">
                        <div class="hov-but">
                        <a href="#" data-toggle="modal" data-target="#myModal2">Order Now</a>
                    </div>
                    </div>
                    <h3>Canvas Photo Printing</h3>
                    <h4>$77.65</h4>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-6">
                <div class="prod_pic">
                    <div class="prod_pic_con">
                        <img src="{{ asset('frontend/images/p_pic7.png') }}">
                        <div class="hov-but">
                        <a href="#" data-toggle="modal" data-target="#myModal2">Order Now</a>
                    </div>
                    </div>
                    <h3>Canvas Photo Printing</h3>
                    <h4>$77.65</h4>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-6">
                <div class="prod_pic">
                    <div class="prod_pic_con">
                        <img src="{{ asset('frontend/images/p_pic8.png') }}">
                        <div class="hov-but">
                        <a href="#" data-toggle="modal" data-target="#myModal2">Order Now</a>
                    </div>
                    </div>
                    <h3>Metallic Arts Golden Steel Wall Clocks</h3>
                    <h4>$77.65</h4>
                </div>
            </div>
            </div>
        </div>          
            
        </div>
    </div>
</section>


<div class="clearfix"></div>
@endsection
@section('jsContent')

@endsection