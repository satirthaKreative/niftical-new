
<footer>
    <div class="foot_info">
        <div class="container">   
            <div class="row">
                <div class="col-md-12">
                    <form>
                        <input type="email" name="" placeholder="Email Address">
                        <input type="submit" name="" value="Subscribe">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="foot_menu">
        <div class="container">   
            <div class="row">
                <div class="col-md-12 text-center">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Categories</a></li>
                        <li><a href="#">Products</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Login</a></li>
                    </ul>
                </div>
                <!-- <div class="col-md-4 col-sm-4 text-right">
                    <ul>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms and Conditions</a></li>
                    </ul>
                </div> -->
            </div>
        </div>
    </div>
    <div class="foot_bot">
        <div class="container">   
            <div class="foot_bot_con">
                <div class="row">
                    <h5>Copyright  2021 | All right reserved</h5>
                    <ul>
                        <li><a href="https://twitter.com/Nifticals"><i class="fab fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<!--  <a href="#0" class="cd-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>     -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.js"></script>
<script src="js/jquery.slimNav_sk78.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script type="text/javascript" src="https://wp.incredibbble.com/writsy-shop/wp-content/themes/writsy-shop/assets/vendor/jquery-zoom/jquery.zoom.min.js?ver=1.7.18"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.1.0/lazysizes.min.js"></script>
<script type="text/javascript" src="https://mreq.github.io/slick-lightbox/dist/slick-lightbox.js"></script>

<script type="text/javascript">
$(document).ready(function() {	
	$('#navigation nav').slimNav_sk78();
	var owl = $('.main-slider');
    owl.owlCarousel({
        autoplay: true,
        autoplayTimeout: 4000,
        loop: true,
        items: 1,
        center: true,
        nav: true,
        thumbs: false,
        thumbImage: false,
        thumbsPrerendered: true,
        thumbContainerClass: 'owl-thumbs',
        thumbItemClass: 'owl-thumb-item',
        navText: ['<span class="prev"><i class="fas fa-angle-left"></i></span>','<span class="next"><i class="fas fa-angle-right"></i></span>'],

    });	
    var owl = $('.testi_slider');
    owl.owlCarousel({
        autoplay: true,
        autoplayTimeout: 4000,
        loop: true,
        items: 1,
        center: true,
        nav: true,
        thumbs: true,
        thumbImage: false,
        thumbsPrerendered: true,
        thumbContainerClass: 'owl-thumbs',
        thumbItemClass: 'owl-thumb-item',
        navText: ['<span class="prev"><i class="fas fa-angle-left"></i></span>','<span class="next"><i class="fas fa-angle-right"></i></span>'],
    });
    var owl = $('.product_rolling');
    owl.owlCarousel({
        autoplay: true,
        autoplayTimeout: 4000,
        loop: true,
        items:4,
        itemsMobile:[568,2],
        itemsTablet:[768,3],
        itemsTablet:[1024,3],
        center: false,
        nav: true,
        thumbs: true,
        thumbImage: false,
        thumbsPrerendered: true,
        thumbContainerClass: 'owl-thumbs',
        thumbItemClass: 'owl-thumb-item',
        navText: ['<span class="prev"><i class="fas fa-angle-left"></i></span>','<span class="next"><i class="fas fa-angle-right"></i></span>'],
        responsive: {
            0: {
              items: 1
            },

            600: {
              items: 2
            },

            1024: {
              items: 3
            },

            1366: {
              items: 4
            }
          }
    });

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

<script src="js/jquery.easing.min.js" type="text/javascript"></script> 
<script>
$(function() {

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
    if(animating) return false;
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
            current_fs.css({'transform': 'scale('+scale+')'});
            next_fs.css({'left': left, 'opacity': opacity});
        }, 
        duration: 800, 
        complete: function(){
            current_fs.hide();
            animating = false;
        }, 
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
    });
});

$(".previous").click(function(){
    if(animating) return false;
    animating = true;
    
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
            current_fs.css({'left': left});
            previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
        }, 
        duration: 800, 
        complete: function(){
            current_fs.hide();
            animating = false;
        }, 
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
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



</body>
</html>
