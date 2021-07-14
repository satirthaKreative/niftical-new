@extends('backend.app')
@section('content')
<style>
.scroll-demo-table {
    min-height: auto;
    max-height: 254px;
    overflow-y: auto;
    padding-right: 5px;
}

.dropdown {
  position: relative;
}

a {
  color: #fff;
}

.dropdown dd,
.dropdown dt {
  margin: 0px;
  padding: 0px;
}

.dropdown ul {
  margin: -1px 0 0 0;
}

.dropdown dd {
  position: relative;
}

.dropdown a,
.dropdown a:visited {
  color: #fff;
  text-decoration: none;
  outline: none;
  font-size: 12px;
}

.dropdown dt a {
  display: block;
  padding: 8px 20px 5px 10px;
  min-height: 25px;
  line-height: 24px;
  overflow: hidden;
  border: 0;
  width: 100%;
  border: 1px solid #ced4da;
  background: #fff;
  box-shadow: inset 0 0 0 transparent;
  color: #333;
}
.dropdown dt a p{
  margin: 0;
}

.dropdown dt a span,
.multiSel span {
  cursor: pointer;
  display: inline-block;
  padding: 0 3px 2px 0;
}

.dropdown dd ul {
  background: #f1eded;
  border: 0;
  color: #fff;
  display: none;
  left: 0px;
  padding: 2px 15px 2px 10px;
  position: absolute;
  top: 2px;
  width: 100%;
  list-style: none;
  height: 100px;
  overflow: auto;
}
.dropdown dd ul li{
  color: #333;
  font-size: 14px;
}
.dropdown dt a span{
  color: #333;
}
.dropdown dd ul li input{
  margin-right: 5px;
}

.dropdown span.value {
  display: none;
}

.dropdown dd ul li a {
  padding: 5px;
  display: block;
}

.dropdown dd ul li a:hover {
  background-color: #fff;
}

</style>
  <!-- The Modal -->
  <div class="modal" id="category-show-modal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Subscriber's Mail</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form action="{{ route('admin.subscribe-email-sending-file') }}" method="GET">
          @csrf
            <div class="form-group">
              <label for="email">Subscriber Email:</label>
              <select class="form-control" id="subscriber-mail-name-id" name="subscriber_mail_name[]" multiple required>

              </select>
            </div>
            <div class="form-group">
              <label for="pwd">Content / Links:</label>
              <textarea class="form-control" placeholder="Enter mail content" name="subscriber_mail_content" id="subscriber-mail-content-id" required></textarea>
            </div>
            <button type="submit" id="category-modal-call-id" class="btn btn-primary">Submit</button>&nbsp;<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
          <h1>Subscriber's</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Subscriber</li>
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
              <h3 class="card-title">Subscriber's Table</h3>
                <div class="row">
                    <div class="col-12" id="status_report">

                    </div>
                </div>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="javascript: ;" class="btn btn-info btn-sm" id="add-banner-id" onclick="add_product_category()"><i class="fa fa-envelope"></i> Send Mail to Subscribers</a>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive scroll-demo-table p-0" id="backend-table-id">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Subscriber Email</th>
                    <th>Status</th>
                    <th>Admin Action</th>
                  </tr>
                </thead>
                <tbody id="campaign-tbl-id">
                  <tr>
                    <td colspan="4"><center class="text-info"><i class="fa fa-spinner"></i> Loading data's</center></td>
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
        url: "{{ route('admin.show-actual-subscriber') }}",
        type: "GET",
        dataType: "json",
        success: function(event){
            if(event.action_type == "yes"){
              $("#campaign-tbl-id").html(event.subscriber_full_data);
              $("table").dataTable();
            }else if(event.action_type == "no"){
              $("#campaign-tbl-id").html(event.subscriber_full_data);
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
  $.ajax({
    url: "{{ route('admin.subscribers_email_view_panel') }}",
    type: "GET",
    dataType: "json",
    success: function(event){
      $("#subscriber-mail-name-id").html(event.subscriber_email);
    }, error: function(event){

    }
  })
}


function change_action(id,status_call)
{
    $.ajax({
      url: "{{ route('admin.subscriber-admin-change-status') }}",
      type: "GET",
      data: {id: id, status_call: status_call},
      dataType: 'json',
      success: function(event){
        if(event.status_code == "success")
        {
          success_pass_alert_show_msg("Subscribers Action Changed successfully");
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
  var x = confirm("Are you really want to delete this subscribers?");
  if(x)
  {
    $.ajax({
      url: "{{ route('admin.subscriber-admin-del-status') }}",
      type: "GET",
      data: {id: id},
      dataType: 'json',
      success: function(event){
        if(event.status_code == "success")
        {
          success_pass_alert_show_msg("Subscriber deleted successfully");
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