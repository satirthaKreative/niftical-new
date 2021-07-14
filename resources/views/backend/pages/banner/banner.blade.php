@extends('backend.app')
@section('content')
<style>
.md_pic_con{
  position: relative;
  width: 23%;
    margin: 0 1% 10px;
    float: left;
}
#edit-type-gallery-images-id, #edit-type-thumbnail-image-id{
  padding-top: 10px;
}
.edit-modal-btn-view-class{
  width: 100%;
  clear: both;
}
.md_pic_con a{
  position: absolute;
    top: 5px;
    left: 5px;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    border-radius: 50%;
    font-size: 12px;
}
.scroll-demo-table {
    min-height: auto;
    max-height: 254px;
    overflow-y: auto;
    padding-right: 5px;
}
.product-modal-open-height-scroll{
    overflow-y: auto;
    max-height: 400px;
    min-height: auto;
}

/* on off panel */
.MainContainer .Switch {
	position: relative;
	display: inline-block;
	font-size: 1.6em;
	font-weight: bold;
	color: #ccc;
	text-shadow: 0px 1px 1px rgba(255,255,255,0.8);
	height: 18px;
	padding: 6px 6px 5px 6px;
	border: 1px solid #ccc;
	border: 1px solid rgba(0,0,0,0.2);
	border-radius: 4px;
	background: #ececec;
	box-shadow: 0px 0px 4px rgba(0,0,0,0.1), inset 0px 1px 3px 0px rgba(0,0,0,0.1);
	cursor: pointer;
	font-size: 16px;
}
body.IE7 .Switch { width: 78px; }
.Switch span {
	display: inline-block;
	width: 35px;
}
.MainContainer .Switch span.On { color: #33d2da; }
.MainContainer .Switch .Toggle {
	position: absolute;
	top: 1px;
	width: 37px;
	height: 25px;
	border: 1px solid #ccc;
	border: 1px solid rgba(0,0,0,0.3);
	border-radius: 4px;
	background: #fff;
	background: -moz-linear-gradient(top, #ececec 0%, #ffffff 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ececec), color-stop(100%, #ffffff));
	background: -webkit-linear-gradient(top, #ececec 0%, #ffffff 100%);
	background: -o-linear-gradient(top, #ececec 0%, #ffffff 100%);
	background: -ms-linear-gradient(top, #ececec 0%, #ffffff 100%);
	background: linear-gradient(top, #ececec 0%, #ffffff 100%);
	box-shadow: inset 0px 1px 0px 0px rgba(255,255,255,0.5);
	z-index: 999;
	-webkit-transition: all 0.15s ease-in-out;
	-moz-transition: all 0.15s ease-in-out;
	-o-transition: all 0.15s ease-in-out;
	-ms-transition: all 0.15s ease-in-out;
}
.MainContainer .Switch.On .Toggle { left: 2%; }
.MainContainer .Switch.Off .Toggle { left: 54%; }
/* Round Switch */
.MainContainer .Switch.Round {
	padding: 0px 20px;
	border-radius: 40px;
}
body.IE7 .Switch.Round { width: 1px; }
.MainContainer .Switch.Round .Toggle {
	border-radius: 40px;
	width: 14px;
	height: 14px;
}
.MainContainer .Switch.Round.Off .Toggle {
	left: 3%;
	background: #33d2da;
}
.MainContainer .Switch.Round.On .Toggle { left: 58%; }
.info {
	font-size: 1.2em;
	margin-bottom: 4px;
}
/* end on off panel */
</style>
  <!-- The Modal -->
  <div class="modal" id="banner-add-show-modal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Banner</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body product-modal-open-height-scroll">
          <form action="{{ route('admin.banner-add') }}" id="product-admin-modal-id" method="POST" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
              <label for="pwd">Banner Heading Quote:</label>
              <input type="text" class="form-control" placeholder="Enter Banner Heading Quote" name="banner_heading_quote" id="banner-name-id" required> 
            </div>
            <div class="form-group">
              <label for="pwd">Banner Heading Name:</label>
              <textarea class="form-control" placeholder="Enter Banner Heading Name" name="banner_heading_name" id="banner-heading-id"></textarea>
            </div>
            <div class="form-group">
              <label for="pwd">Banner Paragraph:</label>
              <textarea class="form-control" placeholder="Enter Paragraph Description" name="banner_paragraph" rows=6 id="banner-des-id"></textarea>
            </div>
            <div class="form-group">
              <label for="pwd">Banner Image:</label>
              <input type="file" class="form-control" name="banner_image" placeholder="Enter Banner Image" id="banner-image-id" required>
            </div>
            <button type="submit" id="category-modal-call-id" class="btn btn-primary">Submit</button>&nbsp;<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </form>
        </div>

      </div>
    </div>
  </div>
  <!-- edit modal -->
  <div class="modal" id="banner-edit-show-modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <input type="hidden" name="product_hidden_long_id" value="">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Banner</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body product-modal-open-height-scroll">
          <form action="{{ route('admin.banner-update') }}" id="product-admin-modal-id" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="edit_banner_name_first_name" id="edit-banner-form-hidden-id" value="" />
          <div class="form-group">
              <label for="pwd">Banner Heading Quote:</label>
              <input type="text" class="form-control" placeholder="Enter Banner Heading Quote" name="banner_heading_quote" id="banner-name-edit-id" required> 
            </div>
            <div class="form-group">
              <label for="pwd">Banner Heading Name:</label>
              <textarea class="form-control" placeholder="Enter Banner Heading Name" name="banner_heading_name" id="banner-heading-edit-id"></textarea>
            </div>
            <div class="form-group">
              <label for="pwd">Banner Paragraph:</label>
              <textarea class="form-control" placeholder="Enter Paragraph Description" name="banner_paragraph" rows=6 id="banner-des-edit-id"></textarea>
            </div>
            <div class="form-group">
              <label for="pwd">Banner Image:</label>
              <input type="file" class="form-control" name="banner_image" placeholder="Enter Banner Image" id="banner-image-edit-id" >
            </div>
            <div id="edit-type-thumbnail-image-id">

            </div>
            <div class="clearfix"></div>
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
          <h1>Banner Details</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Banner Details</li>
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
              <h3 class="card-title">Banner Details</h3>
                <div class="row">
                    <div class="col-12" id="status_report">

                    </div>
                </div>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="javascript: ;" class="btn btn-info btn-sm" id="add-banner-id" onclick="add_banner()">Add Banner</a>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive scroll-demo-table p-0" id="backend-table-id">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Banner Images</th>
                    <th>Banner Heading</th>
                    <th>Banner Description</th>
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
    </div><!-- /.container-fluid -->
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
    url: "{{ route('admin.show-actual-banner') }}",
    type: "GET",
    dataType: "json",
    success: function(e){
      $("#campaign-tbl-id").html(e.product_full_data);
      $("table").dataTable();
    }, error: function(e){

    }
  })
}

// banner addition 
function add_banner()
{
  $("#banner-add-show-modal").modal('show');
}

function change_action(id,status_call)
{
    $.ajax({
      url: "{{ route('admin.banner-change-action') }}",
      type: "GET",
      data: {id: id, status_call: status_call},
      dataType: 'json',
      success: function(event){
        if(event.status_code == "success")
        {
          success_pass_alert_show_msg("Banner Changed successfully");
          load_banner_fx();
          location.reload();
        }
        else
        {
          error_pass_alert_show_msg("Something went wrong");
        }
      }, error: function(event){

      }
    })
}

function edit_action(id)
{
  $("#edit-banner-form-hidden-id").val(id);
  $("#banner-edit-show-modal").modal('show');
    $.ajax({
        url: "{{ route('admin.show-edit-actual-banner') }}",
        type: "GET",
        data: {id: id},
        dataType: "json",
        success: function(event){
          $("#banner-name-edit-id").val(event.banner_quote);
          $("#banner-heading-edit-id").val(event.banner_name);
          $("#banner-des-edit-id").val(event.banner_des);
          $("#edit-type-thumbnail-image-id").html(event.banner_img);
        }, error: function(event){

        }
    })
}

function del_action(id)
{
  var x = confirm("Are you really want to delete the banner?");
  if(x)
  {
    $.ajax({
      url: "{{ route('admin.banner-del-action') }}",
      type: "GET",
      data: {id: id},
      dataType: 'json',
      success: function(event){
        if(event.status_code == "success")
        {
          success_pass_alert_show_msg("Banner deleted successfully");
          load_banner_fx();
          location.reload();
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