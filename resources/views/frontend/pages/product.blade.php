@extends('frontend.app')
@section('content')

<div class="inner-ban">
    <img src="{{ asset('frontend/images/inner-ban.jpg') }}" alt="">
    <div class="ban text">
        <h2>Products</h2>
        <ul>
            <li><a href="#">Home <i class="fas fa-chevron-right"></i></a></li>
            <li>Products</li>
        </ul>
    </div>
</div>

<section class="feature_area">
  <div class="container">
    <div class="row" id="product-listing-id">
        <!-- loading product listing -->
    </div>
  </div>
</section>

<div class="clearfix"></div>
@endsection
@section('jsContent')
<script>
    $(function(){
        load_products_fx();load_product_footer_fx();
    });


    function load_products_fx()
    {
        $.ajax({
            url: "{{ route('satirtha.load-all-products') }}",
            type: "GET",
            dataType: "json",
            success: function(event){
                $("#product-listing-id").html(event.product_datas);
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

    function load_product_particular_fx(id)
    {
        $.ajax({
            url: "{{ route('satirtha.load-modal-product-details') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
                $(".header-product-modal-select-class").html(event.product_names);
                $('.header-product-modal-select-class').select2();
            }, error: function(event){

            }
        })
    }
</script>
@endsection