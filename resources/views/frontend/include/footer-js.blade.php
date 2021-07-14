

<script type="text/javascript">	

$(document).ready(function() {	
	$('#navigation nav').slimNav_sk78();


    if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter("#files");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });        
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});
</script>


@if(Session::has('success_msg'))
<script>
    swal({
      title: "Successful!",
      text: "{{ Session::get('success_msg') }}",
      icon: "success",
      button: false,
      timer: 3000
    });
</script>
@endif

<!-- error alert -->
@if(Session::has('error_msg'))
<script>
    swal({
      title: "Error!",
      text: "{{ Session::get('error_msg') }}",
      icon: "error",
      button: false,
      timer: 3000
    });
</script>
@endif

<script>
  function success_pass_alert_show_msg(alert_main_msg)
  {
    swal({
      title: "Successful!",
      text: alert_main_msg,
      icon: "success",
      button: false,
      timer: 3000
    });
  }

 

  function error_pass_alert_show_msg(alert_main_msg)
  {
    swal({
      title: "Error!",
      text: alert_main_msg,
      icon: "error",
      button: false,
      timer: 3000
    });
  }

  
</script>

<script>
$(function() {

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
    if(animating) return true;
    animating = false;
    
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    
    //activate next step on progressbar using the index of next_fs
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    
    //show the next fieldset
    next_fs.show(); 
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale current_fs down to 80%
            scale = 1 - (1 - now) * 0.2;
            //2. bring next_fs from the right(50%)
            left = (now * 50)+"%";
            //3. increase opacity of next_fs to 1 as it moves in
            opacity = 1 - now;
            
            next_fs.css({ 'opacity': opacity});
        },  
        complete: function(){
            current_fs.hide();
            animating = false;
        }, 
    });
});

$(".previous").click(function(){
    if(animating) return true;
    animating = false;
    
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    
    //de-activate current step on progressbar
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    
    //show the previous fieldset
    previous_fs.show(); 
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale previous_fs from 80% to 100%
            scale = 0.8 + (1 - now) * 0.2;
            //2. take current_fs to the right(50%) - from 0%
            left = ((1-now) * 50)+"%";
            //3. increase opacity of previous_fs to 1 as it moves in
            opacity = 1 - now;
            // current_fs.css({'left': left});
            previous_fs.css({'opacity': opacity});
        }, 
        complete: function(){
            current_fs.hide();
            animating = false;
        }, 
    });
});

$(".submit").click(function(){
    return false;
})

});
</script>

<script type="text/javascript">
$(function() {

  (function quantityProducts() {
    var $quantityArrowMinus = $(".quantity-arrow-minus");
    var $quantityArrowPlus = $(".quantity-arrow-plus");
    var $quantityNum = $(".quantity-num");

    $quantityArrowMinus.click(quantityMinus);
    $quantityArrowPlus.click(quantityPlus);

    function quantityMinus() {
      if ($quantityNum.val() > 1) {
        $quantityNum.val(+$quantityNum.val() - 1);
      }
    }

    function quantityPlus() {
      $quantityNum.val(+$quantityNum.val() + 1);
    }
  })();

});
</script>

<script type="text/javascript">
$( document ).ready(function() {
    
    var checkboxes = $("input[type='checkbox']"),
    actions = $("#actions");

    checkboxes.click(function() {
    
       actions.attr("hidden", !checkboxes.is(":checked"));
      
    });
      
});
</script>
<script type="text/javascript">
function show1(){
  document.getElementById('div1').style.display ='block';
  document.getElementById('div2').style.display ='none';
}
function show2(){
  document.getElementById('div2').style.display = 'block';
  document.getElementById('div1').style.display = 'none';
}
</script>

<script type="text/javascript">
 // SLICK
 $('#product-slider__main').slick({
  asNavFor: '#product-slider__nav',
  rows: 0,
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  prevArrow: '<span class="slick-prev"><</span>',
  nextArrow: '<span class="slick-next">></span>',
  fade: true,
  adaptiveHeight: true,
  autoplay: true,
  autoplaySpeed: 4000
});

var owl = $('.award-cara');
    owl.owlCarousel({
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        items: 3,
        nav: false,
        dots: true,
        center: true,
        loop: true,
        autoplay: true,
        smartSpeed: 1500,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        navText: ['<span class="prev"><i class="fas fa-angle-left"></i></span>','<span class="next"><i class="fas fa-angle-right"></i></span>']
    });

$('#product-slider__nav').slick({
    asNavFor: '#product-slider__main',
  // // rows: 1,
  // slidesToShow: 6,
  // slidesToScroll: 1,
  // focusOnSelect: true,
  // adaptiveHeight: true,
  // dots: false,
  // arrows: false
  arrows: false,
  dots: false,
  infinite: false,
  speed: 300,
  slidesToShow: 6,
  slidesToScroll: 6,
  focusOnSelect: true,
  adaptiveHeight: true,
});

$(".social-share").click(function() {
  $(this).toggleClass("is-visible");
});


// ZOOM
$('.zoom').zoom();

// STYLE GRAB
$('.zoom--grab').zoom({ on:'grab' });

// STYLE CLICK
$('.zoom--click').zoom({ on:'click' }); 

// STYLE TOGGLE
$('.zoom--toggle').zoom({ on:'toggle' });

$('#product-slider__main').slickLightbox({
  itemSelector        : '.zoom img',
  navigateByKeyboard  : true,
  src: 'src',
  lazy: true
});
</script>
<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

<script>
$(function(){
  $(".myDIV-class").hide();
});

function myFunction(id) {
  if(!$("#myDIV"+id).is(':visible'))
  {
    $("#myDIV"+id).show();
  }
  else
  {
    $("#myDIV"+id).hide();
  }
}
</script>