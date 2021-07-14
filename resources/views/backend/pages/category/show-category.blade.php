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
  <div class="modal" id="category-show-modal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Product Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form action="">
            <div class="form-group">
              <label for="email">Category Name:</label>
              <input type="text" class="form-control" placeholder="Enter Category Name" id="category-name-id">
            </div>
            <div class="form-group">
              <label for="pwd">Category Quote:</label>
              <input type="text" class="form-control" placeholder="Enter Category Quote" id="category-quote-id">
            </div>
            <button type="button" onclick="add_cate_data_fx()" id="category-modal-call-id" class="btn btn-primary">Submit</button>&nbsp;<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </form>
        </div>

      </div>
    </div>
  </div>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Product Category</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Product Category</li>
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
              <h3 class="card-title">Product Category Table</h3>
                <div class="row">
                    <div class="col-12" id="status_report">

                    </div>
                </div>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="javascript: ;" class="btn btn-info btn-sm" id="add-banner-id" onclick="add_product_category()">Add Product category</a>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive scroll-demo-table p-0" id="backend-table-id">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Category Details</th>
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
        url: "{{ route('admin.show-actual-category') }}",
        type: "GET",
        dataType: "json",
        success: function(event){
            if(event.action_type == "yes"){
              $("#campaign-tbl-id").html(event.category_full_data);
              $("table").dataTable();
            }else if(event.action_type == "no"){
              $("#campaign-tbl-id").html(event.category_full_data);
            }else{
              $("#campaign-tbl-id").html('<tr><td colspan="5"><center class="text-info"><i class="fa fa-spinner"></i> Something went wrong</center></td></tr>');
            }
        }, error: function(event){

        }
    })
}

// modal open
function add_product_category()
{
  $("#category-show-modal").modal('show');
  $("#category-modal-call-id").attr('onclick','add_cate_data_fx()');
}

// adding category
function add_cate_data_fx()
{
  var category_name = $("#category-name-id").val();
  var category_quote = $("#category-quote-id").val();

  if(category_name == null || category_name == "")
  {
    error_pass_alert_show_msg("Category name can't be null");
  }
  else
  {
    $.ajax({
      url: "{{ route('admin.product-add-category') }}",
      type: "GET",
      data: {cname: category_name, cquote: category_quote},
      dataType: 'json',
      success: function(event){
        if(event.status_code == "success")
        {
          success_pass_alert_show_msg("Category added successfully");
          load_product_category();
          $("#category-name-id").val("");
          $("#category-quote-id").val("");
          $("#category-show-modal").modal('hide');
        }
        else
        {
          error_pass_alert_show_msg(event.status_code);
        }
      }, error: function(event){

      }
    })
  }
}

/// edit category
function edit_action(id)
{
  $("#category-show-modal").modal('show');
    $.ajax({
        url: "{{ route('admin.show-edit-actual-category') }}",
        type: "GET",
        data: {id: id},
        dataType: "json",
        success: function(event){
          $("#category-name-id").val(event.cname);
          $("#category-quote-id").val(event.cquote);
          $("#category-modal-call-id").attr('onclick','edit_cate_data_fx('+id+')');
        }, error: function(event){

        }
    })
}

/// update category
function edit_cate_data_fx(id)
{
  var category_name = $("#category-name-id").val();
  var category_quote = $("#category-quote-id").val();

  if(category_name == null || category_name == "")
  {
    error_pass_alert_show_msg("Category name can't be null");
  }
  else
  {
    $.ajax({
      url: "{{ route('admin.product-update-category') }}",
      type: "GET",
      data: {cname: category_name, cquote: category_quote, cid: id},
      dataType: 'json',
      success: function(event){
        if(event.status_code == "success")
        {
          success_pass_alert_show_msg("Category Updated successfully");
          load_product_category();
          $("#category-name-id").val("");
          $("#category-quote-id").val("");
          $("#category-show-modal").modal('hide');
        }
        else
        {
          error_pass_alert_show_msg(event.status_code);
        }
      }, error: function(event){

      }
    })
  }
}

// change status
function change_action(id,status_call)
{
    $.ajax({
      url: "{{ route('admin.product-change-action-category') }}",
      type: "GET",
      data: {id: id, status_call: status_call},
      dataType: 'json',
      success: function(event){
        if(event.status_code == "success")
        {
          success_pass_alert_show_msg("Category Status Changed successfully");
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
  var x = confirm("Are you really want to delete the category?");
  if(x)
  {
    $.ajax({
      url: "{{ route('admin.product-del-action-category') }}",
      type: "GET",
      data: {id: id},
      dataType: 'json',
      success: function(event){
        if(event.status_code == "success")
        {
          success_pass_alert_show_msg("Category deleted successfully");
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