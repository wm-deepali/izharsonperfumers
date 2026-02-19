// some scripts

// jquery ready start
$(document).ready(function() {
	// jQuery code

  // var html_download = '<a href="http://bootstrap-ecommerce.com/templates.html" class="btn btn-dark rounded-pill" style="font-size:13px; z-index:100; position: fixed; bottom:10px; right:10px;">Download theme</a>';
  //  $('body').prepend(html_download);
    

	//////////////////////// Prevent closing from click inside dropdown
    $(document).on('click', '.dropdown-menu', function (e) {
      e.stopPropagation();
    });


     ///////////////// fixed menu on scroll for desctop
    if ($(window).width() < 768) {

     	$('.nav-home-aside .title-category').click( function(e){
     		e.preventDefault();
     		$('.menu-category').slideToggle('fast', function() { $('.menu-category .submenu').hide() });
     	});

     	$('.has-submenu a').click( function(e){
     		e.preventDefault();
     		$(this).next().slideToggle('fast');
     	});
 
    } // end if


    // custom checkbox inside card effect
    $('.js-check :radio').change(function () {
        var check_attr_name = $(this).attr('name');
        if ($(this).is(':checked')) {
            $('input[name='+ check_attr_name +']').closest('.js-check').removeClass('active');
            $(this).closest('.js-check').addClass('active');
           // item.find('.radio').find('span').text('Add');

        } else {
            item.removeClass('active');
            // item.find('.radio').find('span').text('Unselect');
        }
   
    });

	//////////////////////// Bootstrap tooltip
	if($('[data-toggle="tooltip"]').length>0) {  // check if element exists
		$('[data-toggle="tooltip"]').tooltip()
	} // end if


	// offcanvas menu
	$("[data-trigger]").on("click", function(e){
        e.preventDefault();
        e.stopPropagation();
        var offcanvas_id =  $(this).attr('data-trigger');
        $(offcanvas_id).toggleClass("show");
        $('body').toggleClass("offcanvas-active");
        $(".screen-overlay").toggleClass("show");
    }); 

   	// Close menu when pressing ESC
    $(document).on('keydown', function(event) {
        if(event.keyCode === 27) {
           $(".mobile-offcanvas").removeClass("show");
           $("body").removeClass("overlay-active");
        }
    });
    // Close menu by clicking
    $(".btn-close, .screen-overlay").click(function(e){
    	$(".screen-overlay").removeClass("show");
        $(".mobile-offcanvas").removeClass("show");
        $("body").removeClass("offcanvas-active");
    }); 
    
}); 





$('#primium-category').owlCarousel({
    loop:false,
    margin:30,
    nav:true,
	autoplay:true,
	autoHeight:true,
    responsive:{
        0:{
            items:1
        },
        400:{
            items:2
        },
		 600:{
            items:3
        },
		768:{
            items:3
        },
        1000:{
            items:6
        }
    }
})

  $(document).ready(function() {
    var owl = $('.home_slider');
    owl.owlCarousel({
      margin: 0,
      nav: true,
      loop: true,
      autoplay:true,
      autoplayTimeout:5000,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 1
        },
		768:{
            items:1
        },
        1000: {
          items: 1
        }
      }
    })
  })
 $(document).ready(function() {
    var owl = $('#hot-deal,#top-selling,#most-popular');
    owl.owlCarousel({
      margin: 30,
      nav: true,
      loop: true,
      autoplay:true,
      autoplayTimeout:5000,
      responsive: {
        0: {
          items: 1
        },
		400:{
            items:2
        },
        600: {
          items: 3
        },
		768:{
            items:4
        },
        1000: {
          items: 4
        }
      }
    })
  })
 $(document).ready(function() {
    var owl = $('#npro,#tpro,#mpro');
    owl.owlCarousel({
      margin: 30,
      nav: true,
      loop: true,
      autoplay:true,
      autoplayTimeout:5000,
      responsive: {
        0: {
          items: 1
        },
		400:{
            items:2
        },
        600: {
          items: 2
        },
		768:{
            items:2
        },
        1000: {
          items: 3
        }
      }
    })
  })
   $(document).ready(function() {
    var owl = $('#testimonial');
    owl.owlCarousel({
      margin: 30,
      nav: true,
      loop: true,
      autoplay:true,
      autoplayTimeout:5000,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 2
        },
		768:{
            items:2
        },
        1000: {
          items: 3
        }
      }
    })
  })
  $(document).ready(function() {
    var owl = $('#our-product');
    owl.owlCarousel({
      margin: 30,
      nav: true,
      loop: true,
      autoplay:true,
      autoplayTimeout:5000,
      responsive: {
        0: {
          items: 1
        },
		400:{
            items:2
        },
        600: {
          items: 3
        },
		768:{
            items:3
        },
        1000: {
          items: 5
        }
      }
    })
  })
 
// jquery end

function openNav() {
    document.getElementById("mySidenav").style.left = "0px";
    $("#overlay").removeClass("hidden");
  }
  
  function closeNav() {
    document.getElementById("mySidenav").style.left = "-1000px";
    $("#overlay").addClass("hidden");
  }
  function openNav2() {
    document.getElementById("mySidenav2").style.left = "0px";
    $("#overlay").hiddenClass("hidden");
  }
  
  function closeNav2() {
    document.getElementById("mySidenav2").style.left = "1000px";
    $("#overlay").addClass("hidden");
  }
  $('.dpMenu .subMenu').click(function () {
    $(this).parent(".dpMenu").toggleClass('open-menu');
});


 $("#filterbtn").click(function(){
  $(".listing-left-sidebar").addClass("listing-left-show");
  $("#overlay").removeClass("hidden");
 })

 $("#closebtn").click(function(){
  $(".listing-left-sidebar").removeClass("listing-left-show");
  $("#overlay").addClass("hidden");
 })




/*start here product slider */

var sync1 = $(".slider");
var sync2 = $(".navigation-thumbs");

var thumbnailItemClass = '.owl-item';

var slides = sync1.owlCarousel({
  video:true,
  startPosition: 12,
  items:1,
  loop:true,
  margin:10,
  autoplay:true,
  autoplayTimeout:6000,
  autoplayHoverPause:false,
  nav: false,
  dots: true
}).on('changed.owl.carousel', syncPosition);

function syncPosition(el) {
  $owl_slider = $(this).data('owl.carousel');
  var loop = $owl_slider.options.loop;

  if(loop){
    var count = el.item.count-1;
    var current = Math.round(el.item.index - (el.item.count/2) - .5);
    if(current < 0) {
        current = count;
    }
    if(current > count) {
        current = 0;
    }
  }else{
    var current = el.item.index;
  }

  var owl_thumbnail = sync2.data('owl.carousel');
  var itemClass = "." + owl_thumbnail.options.itemClass;


  var thumbnailCurrentItem = sync2
  .find(itemClass)
  .removeClass("synced")
  .eq(current);

  thumbnailCurrentItem.addClass('synced');

  if (!thumbnailCurrentItem.hasClass('active')) {
    var duration = 300;
    sync2.trigger('to.owl.carousel',[current, duration, true]);
  }   
}
var thumbs = sync2.owlCarousel({
  startPosition: 12,
  items:4,
  loop:false,
  margin:10,
  autoplay:false,
  nav: false,
  dots: false,
  onInitialized: function (e) {
    var thumbnailCurrentItem =  $(e.target).find(thumbnailItemClass).eq(this._current);
    thumbnailCurrentItem.addClass('synced');
  },
})
.on('click', thumbnailItemClass, function(e) {
    e.preventDefault();
    var duration = 300;
    var itemIndex =  $(e.target).parents(thumbnailItemClass).index();
    sync1.trigger('to.owl.carousel',[itemIndex, duration, true]);
}).on("changed.owl.carousel", function (el) {
  var number = el.item.index;
  $owl_slider = sync1.data('owl.carousel');
  $owl_slider.to(number, 100, true);
});







/*start here Quantity section */

var buttonPlus  = $(".qty-btn-plus");
var buttonMinus = $(".qty-btn-minus");

var incrementPlus = buttonPlus.click(function() {
  var $n = $(this)
  .parent(".qty-container")
  .find(".input-qty");
  $n.val(Number($n.val())+1 );
});

var incrementMinus = buttonMinus.click(function() {
  var $n = $(this)
  .parent(".qty-container")
  .find(".input-qty");
  var amount = Number($n.val());
  if (amount > 0) {
    $n.val(amount-1);
  }
});

/*end here Quantity section */
$('.select-size').click(function(){
     $('.select-size').removeClass('highlight_stay');
     $(this).addClass('highlight_stay');
});

$('.select-color').click(function(){
     $('.select-color').removeClass('highlight_color');
     $(this).addClass('highlight_color');
});


$('.address-bbok-box').click(function(){
     $('.address-bbok-box').removeClass('select_addressbook_color');
     $(this).addClass('select_addressbook_color');
});

/*end here product slider*/


/*start here update password*/
function changepwd(){
  var oldpassword = document.getElementById("oldpassword").value;
  var newpassword = document.getElementById("newpassword").value;
  var confirmpassword = document.getElementById("confirmpassword").value;
  var error_message = document.getElementById("error_message");
  error_messgae.style.padding="10px;";
  var text;
  if(oldpassword.length < 8){
    text = "Please enter old password";
    error_messgae.innerHTML = text;
    return false ; 
  }
  if(newpassword.length < 8 ){
    text = "Please Enter New Password";
    error_message.innerHTML = text;
    return false;
  }
  if (confirmpassword.length < 8 ){
    text = "Please Enter Confirm Password";
    error_message.innerHTML = "text";
    return false;
  }

  alert("Successfully Update Passowrd!");
  return true;
}
/*end here update password*/



/*start here form validation*/
function validate(){
  var fname = document.getElementById("fname").value;
  var saddress= document.getElementById("saddress").value;
  var state = document.getElementById("state").value;
  var city = document.getElementById ("city").value;
  var zipcode = document.getElementById ("zipcode").value;
  var phonenumber = document.getElementById ("phonenumber").value;
  var emailaddress = document.getElementById("emailaddress").value;
  var error_message = document.getElementById("error_message");
  error_message.style.padding="10px";
  var text;
  if(fname.length <5){
    text ="Please Enter Full Name";
    error_message.innerHTML =text;
    return false;
  }
  if(saddress.length <5){
    text ="Enter Street Address";
    error_message.innerHTML = text;
    return false;
  }
  if(state.length <3){
    text = "Please Enter Your State";
    error_message.innerHTML = text;
    return false;
  }

  if(city.length <3){
    text = "Please Enter Your city";
    error_message.innerHTML = text;
    return false;
  }
  if(zipcode.length <3){
    text ="Please Enter Your Zipcode";
    error_message.innerHTML = text;
    return false;

  }

  if(isNaN(phonenumber) || phonenumber.length != 10){
    text ="Please Enter Phone Number";
    error_message.innerHTML= text;
    return false;
  }
 if(emailaddress.indexOf("@") == -1 || emailaddress.length < 6){
    text = "Please Enter valid Email";
    error_message.innerHTML = text;
    return false;
  }

 alert("Successfully Add Address!");
 return true;

}
/*end here form validation */


function copyToClipboard() {

  var inputElement=document.getElementById('codecopy');
  inputElement.select();
  document.execCommand('copy');
    alert("Copied to clipboard");
  
}



/*start here login page */
$("#emailbtn").click(function(){
  $(".email-form").removeClass("hidden");
  $(".mobile-form").addClass("hidden");
   $(".otpsection").addClass("hidden");
})

$("#mobilebtn").click(function(){
  $(".email-form").addClass("hidden");
  $(".mobile-form").removeClass("hidden");
})

$(".send-otp").click(function(){
  $(".otpsection").removeClass("hidden");
})

$(".otpinputfield").keyup(function () {
    if (this.value.length == this.maxLength) {
      $(this).next('.otpinputfield').focus();
    }
});

/*end here login page*/



$("#vertical-menu h3").click(function () {
    //slide up all the link lists
    $("#vertical-menu ul ul").slideUp();
    $('.plus',this).html('+');
    //slide down the link list below the h3 clicked - only if its closed
    if (!$(this).next().is(":visible")) {
        $(this).next().slideDown();
        //$(this).remove("span").append('<span class="minus">-</span>');
        $('.plus').html('+');
        $('.plus',this).html('-');
    }
})



