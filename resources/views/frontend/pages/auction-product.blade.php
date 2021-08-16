@extends('frontend.app')
@section('content')

@guest
<script>
    window.location.href = "{{ route('satirtha.join') }}";
</script>
@else
<div class="modal fade search-hold" id="myModal_auc" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h2>Bid Summary</h2>
                <div class="sum_table_con">
                    <table>
                        <tr>
                            <th>Buyer Name</th>
                            <th>Bid Price</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td>Buyer Name</td>
                            <td>$4561.00</td>
                            <td><a href="#" class="accept">Accept</a><a href="#" class="declain">Decline</a></td>
                        </tr>
                         <tr>
                            <td>Buyer Name</td>
                            <td>$4561.00</td>
                            <td><a href="#" class="accept">Accept</a><a href="#" class="declain">Decline</a></td>
                        </tr>
                         <tr>
                            <td>Buyer Name</td>
                            <td>$4561.00</td>
                            <td><a href="#" class="accept">Accept</a><a href="#" class="declain">Decline</a></td>
                        </tr>
                         <tr>
                            <td>Buyer Name</td>
                            <td>$4561.00</td>
                            <td><a href="#" class="accept">Accept</a><a href="#" class="declain">Decline</a></td>
                        </tr>
                        <tr>
                            <td>Buyer Name</td>
                            <td>$4561.00</td>
                            <td><a href="#" class="accept">Accept</a><a href="#" class="declain">Decline</a></td>
                        </tr>
                         <tr>
                            <td>Buyer Name</td>
                            <td>$4561.00</td>
                            <td><a href="#" class="accept">Accept</a><a href="#" class="declain">Decline</a></td>
                        </tr>
                         <tr>
                            <td>Buyer Name</td>
                            <td>$4561.00</td>
                            <td><a href="#" class="accept">Accept</a><a href="#" class="declain">Decline</a></td>
                        </tr>
                         <tr>
                            <td>Buyer Name</td>
                            <td>$4561.00</td>
                            <td><a href="#" class="accept">Accept</a><a href="#" class="declain">Decline</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade search-hold" id="myModal_end_auc" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('frontend/images/stop_end_pic.png') }}">
                <p>Are you really want to end this auction?</p>
                <a href="#" class="yes">Yes</a>
                <a href="#" class="no">No</a>
            </div>
        </div>
        
    </div>
</div>

<section class="acution_area">
    <div class="container">
        <div class="row">
            <h2>Auction Products</h2>
            <table>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>&nbsp;</th>
                </tr>
                <tr>
                    <td><img src="{{ asset('frontend/images/p_pic10.png') }}"></td>
                    <td>Canvas Photo Printing</td>
                    <td><a href="#" class="view" data-toggle="modal" data-target="#myModal_auc"><i class="fas fa-eye"></i>View Summery</a><a href="#" class="end_ac" data-toggle="modal" data-target="#myModal_end_auc"><i class="fa fa-times"></i>End Auction</a></td>
                </tr>
                <tr>
                    <td><img src="{{ asset('frontend/images/p_pic10.png') }}"></td>
                    <td>Canvas Photo Printing</td>
                    <td><a href="#" class="view" data-toggle="modal" data-target="#myModal_auc"><i class="fas fa-eye"></i>View Summery</a><a href="#" class="end_ac" data-toggle="modal" data-target="#myModal_end_auc"><i class="fa fa-times"></i>End Auction</a></td>
                </tr>
                <tr>
                    <td><img src="{{ asset('frontend/images/p_pic10.png') }}"></td>
                    <td>Canvas Photo Printing</td>
                    <td><a href="#" class="view" data-toggle="modal" data-target="#myModal_auc"><i class="fas fa-eye"></i>View Summery</a><a href="#" class="end_ac" data-toggle="modal" data-target="#myModal_end_auc"><i class="fa fa-times"></i>End Auction</a></td>
                </tr>
            </table>
        </div>
    </div>
</section>

<div class="clearfix"></div>
@endsection
@section('jsContent')

@endsection
@endguest