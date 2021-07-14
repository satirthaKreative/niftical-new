@extends('frontend.app')
@section('content')
<div class="inner-ban">
    <img src="{{ asset('frontend/images/inner-ban.jpg') }}" alt="">
    <div class="ban text">
        <h2>Products</h2>
        <ul>
            <li><a href="{{ route('satirtha.home') }}">Home <i class="fas fa-chevron-right"></i></a></li>
            <li>Contact</li>
        </ul>
    </div>
</div>

<section class="contact-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 sec1">
                <h3>Reach Us</h3>
                <ul>
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <h4>Location</h4>
                        <p>Brooklyn, NY</p>
                    </li>
                    <!-- <li>
                        <i class="fas fa-phone-volume"></i>
                        <h4>Contacts</h4>
                        <p><a href="#">703-416-0046, 703-859-0361</a></p>
                    </li> -->
                    <li>
                        <i class="fas fa-envelope"></i>
                        <h4>Email</h4>
                        <p><a href="#">info@nifticals.io</a></p>
                    </li>
                </ul>
            </div>
            <div class="col-lg-8 sec2">
                <h3>Send Us a Message</h3>
                <form action="">
                    <input type="text" placeholder="Name" id="contact-name-id">
                    <input type="text" placeholder="Email Address" id="contact-email-id">
                    <textarea name="" id="contact-msg-id" placeholder="Message"></textarea>
                    <input type="submit" value="send" id="contact-submit-send-id">
                </form>
            </div>
        </div>
    </div>
</section>

<div class="clearfix"></div>
@endsection
@section('jsContent')
<script>
    $("#contact-submit-send-id").on('click',function(e){
        e.preventDefault();
        var contact_name = $("#contact-name-id").val();
        var contact_email = $("#contact-email-id").val();
        var contact_msg = $("#contact-msg-id").val();

        if(contact_name == "" || contact_email == null)
        {
            error_pass_alert_show_msg("Please enter your contact name");
        }
        else if(contact_email == "" || contact_email == null)
        {
            error_pass_alert_show_msg("Please enter your contact email");
        }
        else if( !validateEmail(contact_email))
        {
            error_pass_alert_show_msg("Please enter valid email address");
        }
        else if(contact_msg == "" || contact_msg == null)
        {
            error_pass_alert_show_msg("Please enter your contact message");
        }
        else
        {
            $.ajax({
                url: "{{ route('satirtha.store-contact-email') }}",
                type: "GET",
                data: {contact_name: contact_name, contact_email: contact_email, contact_msg: contact_msg},
                dataType: "json",
                success: function(event)
                {
                    if(event == "success")
                    {
                        success_pass_alert_show_msg('Successfully contact mail sent! Thank you choose our service');
                    }
                    else if(event == "error")
                    {
                        error_pass_alert_show_msg("Something went wrong! Try again later");
                    }
                    else
                    {
                        error_pass_alert_show_msg("!!! Server Down !!!");
                    }
                    
                }, 
                error: function(event)
                {

                }
            })
        }
    });

    // javascript checking
    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
    }
</script>
@endsection