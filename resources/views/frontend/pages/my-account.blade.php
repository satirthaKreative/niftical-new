@extends('frontend.app')
@section('content')

@guest
<script>
    window.location.href = "{{ route('satirtha.join') }}";
</script>
@else
<div class="inner-ban">
    <img src="{{ asset('frontend/images/inner-ban.jpg') }}" alt="">
    <div class="ban text">
        <h2>My Accounts</h2>
        <ul>
            <li><a href="#">Home <i class="fas fa-chevron-right"></i></a></li>
            <li>My Accounts</li>
        </ul>
    </div>
</div>

<section class="account">
    <div class="container">
        <div class="row">
              <div class="col-lg-3 col-md-4">
                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#account">My Account</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('satirtha.order-now') }}">My Orders</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#address">Manage address</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#edit">Edit Account</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#change">Change Password</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
                    </li>
                  </ul>
              </div>
              <div class="col-lg-9 col-md-8">
                  <div class="tab-content">
                    <div id="account" class="tab-pane active">
                      <div class="row account_info">
                          <div class="col-lg-4 col-md-3">
                              <div class="acc_info">
                                <h5>Name</h5>
                                <h3 id="myAccount-name-id"> <span class="text-danger fetching-data-of-my-account-class"><i class="fa fa-spinner"></i> fetching data</span> </h3>
                              </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="acc_info">
                              <h5>Email</h5>
                              <h3 id="myAccount-email-id"><span class="text-danger fetching-data-of-my-account-class"><i class="fa fa-spinner"></i> fetching data</span></h3>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="acc_info">
                              <h5>Contact Number</h5>
                              <h3 id="myAccount-phone-id"><span class="text-danger fetching-data-of-my-account-class"><i class="fa fa-spinner"></i> fetching data</span></h3>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="acc_info">
                              <h5>Birthday</h5>
                              <h3 id="myAccount-birthday-id"><span class="text-danger fetching-data-of-my-account-class"><i class="fa fa-spinner"></i> fetching data</span></h3>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="acc_info">
                              <h5>Street</h5>
                              <h3 id="myAccount-street-id"><span class="text-danger fetching-data-of-my-account-class"><i class="fa fa-spinner"></i> fetching data</span></h3>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="acc_info">
                              <h5>City</h5>
                              <h3 id="myAccount-city-id"><span class="text-danger fetching-data-of-my-account-class"><i class="fa fa-spinner"></i> fetching data</span></h3>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="acc_info">
                              <h5>State</h5>
                              <h3 id="myAccount-state-id"><span class="text-danger fetching-data-of-my-account-class"><i class="fa fa-spinner"></i> fetching data</span></h3>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-3">
                            <div class="acc_info">
                              <h5>State Full</h5>
                              <h3 id="myAccount-state-full-id"><span class="text-danger fetching-data-of-my-account-class"><i class="fa fa-spinner"></i> fetching data</span></h3>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-6">
                            <div class="acc_info">
                              <h5>Zip Code</h5>
                              <h3 id="myAccount-zipcode-id"><span class="text-danger fetching-data-of-my-account-class"><i class="fa fa-spinner"></i> fetching data</span></h3>
                            </div>
                          </div>
                      </div>
                    </div>
                    <div id="order" class="order_table tab-pane fade">
                      <table>
                          <tr>
                              <th>Order ID</th>
                              <th>Date</th>
                              <th>Status</th>
                              <th>Total</th>
                              <th>Actions</th>
                          </tr>
                          <?php for ($i=0; $i <2 ; $i++) { ?>
                          <tr>
                              <td>1</td>
                              <td>May 10, 2018</td>
                              <td>Processing</td>
                              <td>$25.00 for 1 item</td>
                              <td>
                                <button onclick="myFunction(<?= $i; ?>)">Details <i class="fas fa-chevron-down"></i></button></td>
                          </tr>
                          <tr>
                                <td colspan="5" style="padding: 0; padding: 0;     border-top: solid 1px transparent !important;     border-bottom: solid 1px transparent !important;">
                                    <table id="myDIV<?= $i; ?>" class="myDIV-class">
                                      <tr>
                                          <td><img src="images/acy-img.png"></td>
                                          <td>Acrylic block</td>
                                          <td>1</td>
                                          <td>$25.00</td>
                                          <td><a href="#">Track Your Order</a></td>
                                      </tr>
                                      <tr>
                                          <td><img src="images/acy-img.png"></td>
                                          <td>Acrylic block</td>
                                          <td>1</td>
                                          <td>$25.00</td>
                                          <td><a href="#">Track Your Order</a></td>
                                      </tr>
                                  </table>    
                                </td>
                            </tr>
                        <?php } ?>
                          <tr>
                              <td>2</td>
                              <td>May 10, 2018</td>
                              <td>Processing</td>
                              <td>$25.00 for 1 item</td>
                              <td>
                                <button onclick="myFunction(1)">Details <i class="fas fa-chevron-down"></i></button></td>
                          </tr>
                          <tr>
                              <td>3</td>
                              <td>May 10, 2018</td>
                              <td>Processing</td>
                              <td>$25.00 for 1 item</td>
                              <td>
                                <button onclick="myFunction(1)">Details <i class="fas fa-chevron-down"></i></button></td>
                          </tr>
                          <tr>
                              <td>4</td>
                              <td>May 10, 2018</td>
                              <td>Processing</td>
                              <td>$25.00 for 1 item</td>
                              <td>
                                <button onclick="myFunction(1)">Details <i class="fas fa-chevron-down"></i></button></td>
                          </tr>
                          <tr>
                              <td>1</td>
                              <td>May 10, 2018</td>
                              <td>Processing</td>
                              <td>$25.00 for 1 item</td>
                              <td>
                                <button onclick="myFunction(1)">Details <i class="fas fa-chevron-down"></i></button></td>
                          </tr>
                      </table>
                    </div>
                    <div id="address" class="man_address tab-pane fade">
                      <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. </p>
                      <div class="row">
                          <div class="col-lg-4 col-md-6">
                              <div class="man_info">
                                  <h3>Jasmine</h3>
                                  <ul>
                                      <li>4301 Peacock Springs Trl Orlando FL</li>
                                      <li>P: (123) 456-7890</li>
                                      <li><a href="#" data-toggle="modal" data-target="#myModal4">Edit</a></li>
                                  </ul>
                              </div>
                          </div>
                          <div class="col-lg-4 col-md-6">
                              <div class="man_info">
                                  <h3>Bernadette</h3>
                                  <ul>
                                      <li>4301 Peacock Springs Trl Orlando FL</li>
                                      <li>P: (123) 456-7890</li>
                                      <li><a href="#" data-toggle="modal" data-target="#myModal4">Edit</a></li>
                                  </ul>
                              </div>
                          </div>
                          <div class="col-lg-4 col-md-6">
                              <div class="man_info">
                                  <h3>Alexandra</h3>
                                  <ul>
                                      <li>4301 Peacock Springs Trl Orlando FL</li>
                                      <li>P: (123) 456-7890</li>
                                      <li><a href="#" data-toggle="modal" data-target="#myModal4">Edit</a></li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                    </div>
                    <div id="edit" class="edit_table tab-pane fade">
                      <form>
                          <div class="row">
                              <div class="col-lg-4 col-md-4">
                                  <input type="text" name="" id="update-my-account-username-id"  placeholder="Anthony E Simpson">
                              </div>
                              <div class="col-lg-4 col-md-4">
                                  <input type="email" name="" id="update-my-account-usermail-id" placeholder="John@gmail.com">
                              </div>
                              <div class="col-lg-4 col-md-4 my_Select">
                                  <select id="update-my-account-usercountry-id" name="country_code">
                                    @foreach($countryCodeQuery as $countryQuery)
                                      <option value="{{ $countryQuery['phonecode'] }}">+{{ $countryQuery['phonecode'] }}</option>
                                    @endforeach
                                  </select>
                                  <input type="tel" id="update-my-account-phonecode-id" placeholder="1234567890">
                              </div>
                              <div class="col-lg-4 col-md-4">
                                  <input type="date" name="" id="update-my-account-datecode-id">
                              </div>
                              <div class="col-lg-4 col-md-4">
                                  <input type="text" name="" placeholder="4767  Burnside Court" id="update-my-account-street-id">
                              </div>
                              <div class="col-lg-4 col-md-4">
                                  <input type="text" name="" placeholder="Phoenix" id="update-my-account-citycode-id">
                              </div>
                              <div class="col-lg-4 col-md-4">
                                  <input type="text" name="" placeholder="AZ" id="update-my-account-countrycode-id">
                              </div>
                              <div class="col-lg-4 col-md-4">
                                  <input type="text" name="" placeholder="Arizona" id="update-my-account-country-id">
                              </div>
                              <div class="col-lg-4 col-md-4">
                                  <input type="text" name="" placeholder="85004" id="update-my-account-zipcode">
                              </div>
                              <div class="col-lg-12">
                                  <input type="button" onclick="update_my_account_data_fx()" name="" value="Save">
                              </div>
                          </div>
                      </form>
                    </div>
                    <div id="change" class="edit_table tab-pane fade">
                      <form>
                          <div class="row">
                              <div class="col-lg-12">
                                  <input type="text" name="" id="profile-new-password-id" placeholder="New Password">
                              </div>
                              <div class="col-lg-12">
                                  <input type="text" name="" id="profile-confirm-password-id" placeholder="Confirm Password">
                              </div>
                              <div class="col-lg-12">
                                  <input type="button" onclick="save_my_account_pasword()"  name="" value="Save">
                              </div>
                          </div>
                      </form>
                    </div>
                  </div>
              </div>
        </div>
    </div>
</section>

<div class="clearfix"></div>
 <!-- logout functions -->
 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
  <!-- end of logout function -->
@endsection
@section('jsContent')
<script>
  $(function(){
    load_my_account_details();
    load_update_profile_data_fx();
  });

  // load my account details
  function load_my_account_details()
  {
    var logged_user_id = "{{ Auth::user()->id }}";
    $.ajax({
      url: "{{ route('satirtha.my-account-data-load') }}",
      type: "GET",
      data: {logged_user_id: logged_user_id},
      dataType: "json",
      success: function(event){
        $("#myAccount-name-id").html(event.user_actual_name);
        $("#myAccount-email-id").html(event.user_actual_email);
        $("#myAccount-phone-id").html(event.phone_num);
        $("#myAccount-birthday-id").html(event.user_birth);
        $("#myAccount-street-id").html(event.user_street);
        $("#myAccount-city-id").html(event.user_city);
        $("#myAccount-state-id").html(event.user_state_code);
        $("#myAccount-state-full-id").html(event.user_state);
        $("#myAccount-zipcode-id").html(event.zipcode);
      }, error: function(event){

      }
    })
  }


  // update my account page data
  function update_my_account_data_fx()
  {

    var update_my_account_username = $("#update-my-account-username-id").val();
    var update_my_account_usermail = $("#update-my-account-usermail-id").val();
    var update_my_account_countrycode = $("#update-my-account-usercountry-id").val();
    var update_my_account_phone_code = $("#update-my-account-phonecode-id").val();
    var update_my_account_date_code = $("#update-my-account-datecode-id").val();
    var update_my_account_street_code = $("#update-my-account-street-id").val();
    var update_my_account_city_code = $("#update-my-account-citycode-id").val();
    var update_my_account_country_code = $("#update-my-account-countrycode-id").val();
    var update_my_account_country_name = $("#update-my-account-country-id").val();
    var update_my_account_zipcode_name = $("#update-my-account-zipcode").val();

    if(update_my_account_username == "")
    {
      error_pass_alert_show_msg("Username can't be empty");
    }
    else if(update_my_account_usermail == "")
    {
      error_pass_alert_show_msg("Useremail can't be empty");
    }
    else if(!ValidateEmail(update_my_account_usermail))
    {
      error_pass_alert_show_msg("Please enter a valid email address");
    }
    else if(update_my_account_countrycode == "")
    {
      error_pass_alert_show_msg("please choose a valid  phone code");
    }
    else if(update_my_account_phone_code == "")
    {
      error_pass_alert_show_msg("please choose a valid  phone number");
    }
    else if(update_my_account_phone_code.length != 10)
    {
      error_pass_alert_show_msg("please choose a valid  10 digit phone number");
    }

    else
    {
  
      $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        url: "{{ route('satirtha.update-my-account-dataflow') }}",
        type: "GET",
        data: { update_my_account_username: update_my_account_username, update_my_account_usermail: update_my_account_usermail, update_my_account_countrycode: update_my_account_countrycode, update_my_account_phone_code: update_my_account_phone_code, update_my_account_date_code: update_my_account_date_code, update_my_account_street_code: update_my_account_street_code, update_my_account_city_code: update_my_account_city_code, update_my_account_country_code: update_my_account_country_code, update_my_account_zipcode_name: update_my_account_zipcode_name, update_my_account_country_name: update_my_account_country_name  },
        dataType: "json",
        success: function(e){
          if(e == "success")
          {
            success_pass_alert_show_msg("Successfully saved your details");
          }
          else if(e == "error")
          {
            error_pass_alert_show_msg("Something went wrong ! Try again later");
          }
          else if(e == "already")
          {
            error_pass_alert_show_msg("Email address already added by some other user");
          }
        }, error: function(e){

        }
      });

    }
  }


  // show update profile data 
  function load_update_profile_data_fx()
  {
    $.ajax({
      url: "{{ route('satirtha.my-account-show-data') }}",
      type: "GET",
      dataType: "json",
      success: function(event){
        $("#update-my-account-username-id").val(event.update_my_account_username);
        $("#update-my-account-usermail-id").val(event.update_my_account_usermail);
        if(event.update_my_account_countrycode != "" || event.update_my_account_countrycode != null)
        {
          $("#update-my-account-usercountry-id").val(event.update_my_account_countrycode);
        }
        $("#update-my-account-phonecode-id").val(event.update_my_account_phone_code);
        $("#update-my-account-datecode-id").val(event.update_my_account_date_code);
        $("#update-my-account-street-id").val(event.update_my_account_street_code);
        $("#update-my-account-citycode-id").val(event.update_my_account_city_code);
        $("#update-my-account-countrycode-id").val(event.update_my_account_country_code);
        $("#update-my-account-country-id").val(event.update_my_account_country_name);
        $("#update-my-account-zipcode").val(event.update_my_account_zipcode_name);
      }, error: function(event){

      }
    });
  }

  // save file

  function save_my_account_pasword()
  {
    var new_pass = $("#profile-new-password-id").val();
    var confirm_pass = $("#profile-confirm-password-id").val();

    if(new_pass == "")
    {
      error_pass_alert_show_msg("Please enter your new password");
    }
    else if(confirm_pass == "")
    {
      error_pass_alert_show_msg("Re-enter your confirm password");
    }
    else if(confirm_pass != new_pass)
    {
      error_pass_alert_show_msg("Both the password doesn't match");
    }
    else
    {
      $.ajax({
        url: "{{ route('satirtha.my-account-password-change') }}",
        type: "GET",
        data: {new_pass: new_pass},
        dataType: "json",
        success: function(e){
          if(e == "success")
          {
            success_pass_alert_show_msg("Save Successfully");
          }
          else if(e == "error")
          {
            error_pass_alert_show_msg("Old password doen't match");
          }
        }, error: function(e){

        }
      })
    }
  }

  // email validation checking 

  function ValidateEmail(mail) 
  {
  if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(mail))
    {
      return (true)
    }
      
      return (false)
  }
</script>
@endsection
@endguest