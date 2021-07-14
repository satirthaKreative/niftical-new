@extends('backend.app')
@section('content')

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Order Deatils</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Order Deatils</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Order Deatils</h3>
                <div class="row">
                    <div class="col-12" id="status_report">

                    </div>
                </div>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">

                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive scroll-demo-table p-0" id="backend-table-id">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Status</th>
                    <th>Admin Action</th>
                  </tr>
                </thead>
                <tbody id="campaign-tbl-id">
                  <tr>
                    <td colspan="6"><center class="text-info"><i class="fa fa-spinner"></i> Loading data's</center></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
    </div
    ><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
@section('adminjsContent')
<script>
$(function(){
  load_banner_fx();
});


// banner show 
function load_banner_fx()
{
  $.ajax({
    url: "{{ route('admin.show-actual-order-details') }}",
    type: "GET",
    dataType: "json",
    success: function(e){
      $("#campaign-tbl-id").html(e);
      $("table").dataTable();
    }, error: function(e){

    }
  })
}

// 

function order_track_fx(id)
{
  var tracking_id = $("#order-track-id"+id).val();
  $.ajax({ 
    url: "{{ route('admin.order-track-admin-check') }}",
    type: "GET",
    data: {id: id, tracking_id: tracking_id},
    dataType: "json",
    success: function(event){
      window.location.reload();
    }, error: function(event){

    }
  })
}


</script>
@endsection