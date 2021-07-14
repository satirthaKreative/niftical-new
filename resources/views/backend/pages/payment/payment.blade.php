@extends('backend.app')
@section('content')
<style>
.scroll-demo-table {
    min-height: auto;
    max-height: 254px;
    overflow-y: auto;
    padding-right: 5px;
}
</style>
  <!-- The Modal -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Product Payment</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Product Payment</li>
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
              <h3 class="card-title">Product Payment Table</h3>
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
                    <th>User Name</th>
                    <th>Payment Status</th>
                    <th>Status</th>
                    <th>Admin Action</th>
                  </tr>
                </thead>
                <tbody id="campaign-tbl-id">
                  <tr>
                    <td colspan="5"><center class="text-info"><i class="fa fa-spinner"></i> Loading data's</center></td>
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
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
@section('adminjsContent')
<script>
// load product category
$(function(){
    load_product_category();
});

// show product categories
function load_product_category()
{
    $.ajax({
        url: "{{ route('admin.show-actual-payment') }}",
        type: "GET",
        dataType: "json",
        success: function(event){
            if(event.action_type == "yes"){
              $("#campaign-tbl-id").html(event.category_full_data);
              $("table").dataTable();
            }else if(event.action_type == "no"){
              $("#campaign-tbl-id").html(event.category_full_data);
            }else{
              $("#campaign-tbl-id").html('<tr><td colspan="5"><center class="text-danger"><i class="fa fa-times"></i> Something went wrong</center></td></tr>');
            }
        }, error: function(event){

        }
    })
}


// change status
function change_action(id,status_call)
{
    $.ajax({
      url: "{{ route('admin.product-change-action-payment') }}",
      type: "GET",
      data: {id: id, status_call: status_call},
      dataType: 'json',
      success: function(event){
        if(event.status_code == "success")
        {
          success_pass_alert_show_msg("Payment Status Changed successfully");
          load_product_category();
        }
        else
        {
          error_pass_alert_show_msg("Something went wrong");
        }
      }, error: function(event){

      }
    })
}


// del action 
function del_action(id)
{
  var x = confirm("Are you really want to delete the payment?");
  if(x)
  {
    $.ajax({
      url: "{{ route('admin.product-del-action-payment') }}",
      type: "GET",
      data: {id: id},
      dataType: 'json',
      success: function(event){
        if(event.status_code == "success")
        {
          success_pass_alert_show_msg("Payment deleted successfully");
          load_product_category();
        }
        else
        {
          error_pass_alert_show_msg("Something went wrong");
        }
      }, error: function(event){

      }
    })
  }
}
</script>
@endsection