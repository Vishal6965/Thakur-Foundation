/*TABS*/
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
/*END TABS*/

/*TIMELINE*/
// Timeline Body Animations Below ===
function VerticalTimeline( element ) {
		this.element = element;
		this.blocks = this.element.getElementsByClassName("js-cd-block");
		this.images = this.element.getElementsByClassName("js-cd-img");
		this.contents = this.element.getElementsByClassName("js-cd-content");
		this.offset = 0.8;
		this.hideBlocks();
	};

	VerticalTimeline.prototype.hideBlocks = function() {
		//hide timeline blocks which are outside the viewport
		if ( !"classList" in document.documentElement ) {
			return;
		}
		var self = this;
		for( var i = 0; i < this.blocks.length; i++) {
			(function(i){
				if( self.blocks[i].getBoundingClientRect().top > window.innerHeight*self.offset ) {
					self.images[i].classList.add("cd-is-hidden"); 
					self.contents[i].classList.add("cd-is-hidden"); 
				}
			})(i);
		}
	};

	VerticalTimeline.prototype.showBlocks = function() {
		if ( ! "classList" in document.documentElement ) {
			return;
		}
		var self = this;
		for( var i = 0; i < this.blocks.length; i++) {
			(function(i){
				if( self.contents[i].classList.contains("cd-is-hidden") && self.blocks[i].getBoundingClientRect().top <= window.innerHeight*self.offset ) {
					// add bounce-in animation
					self.images[i].classList.add("cd-timeline__img--bounce-in");
					self.contents[i].classList.add("cd-timeline__content--bounce-in");
					self.images[i].classList.remove("cd-is-hidden");
					self.contents[i].classList.remove("cd-is-hidden");
				}
			})(i);
		}
	};

	var verticalTimelines = document.getElementsByClassName("js-cd-timeline"),
		verticalTimelinesArray = [],
		scrolling = false;
	if( verticalTimelines.length > 0 ) {
		for( var i = 0; i < verticalTimelines.length; i++) {
			(function(i){
				verticalTimelinesArray.push(new VerticalTimeline(verticalTimelines[i]));
			})(i);
		}

		//show timeline blocks on scrolling
		window.addEventListener("scroll", function(event) {
			if( !scrolling ) {
				scrolling = true;
				(!window.requestAnimationFrame) ? setTimeout(checkTimelineScroll, 250) : window.requestAnimationFrame(checkTimelineScroll);
			}
		});
	}

	function checkTimelineScroll() {
		verticalTimelinesArray.forEach(function(timeline){
			timeline.showBlocks();
		});
		scrolling = false;
	};

/*END TIMELINE*/

$(document).ready(function(){
	// use for active link
   var str = location.href.toLowerCase();
   $('#cssmenu a').each(function() {
       if (str.indexOf(this.href.toLowerCase()) > -1) {
           $("li.active").removeClass("active");
           $(this).parent().addClass("active");

       }
   });


// if ($("#prvplcy #cssmenu li").hasClass('active')){
//   $("#cssmenu li").removeClass('active');
// }

if ($("#addGrant #cssmenu li").hasClass('active')){
  $("#cssmenu li").removeClass('active');
}

// if ($("#addGrant #cssmenu li").hasClass('active')){
//   $("#cssmenu li").removeClass('active');
//   $("#cssmenu li:nth-child(2)").addClass('active');
// }

	// responsive nav
	// var responsiveNav = $('#toggle-nav');
	// var navBar = $('.nav-bar');
	// responsiveNav.on('click',function(e){
	// 	e.preventDefault();
	// 	console.log(navBar);
	// 	navBar.toggleClass('active')
	// });

	// pseudo active
	if($('#docs').length){
		var sidenav = $('ul.side-nav').find('a');
		var url = window.location.pathname.split( '/' );
		var url = url[url.length-1];

		sidenav.each(function(i,e){
			var active = $(e).attr('href');
			if(active === url){
				$(e).parent('li').addClass('active');
				return false;
			}
		});
	}

	$('.owl-nav').appendTo($('.spot-box'));

});

// hljs.configure({tabReplace: '  '});
// hljs.initHighlightingOnLoad();
$(document).ready(function() {
	$.fn.parallax = function(strength) {
         var scroll_top = $(window).scrollTop();
         var move_value = Math.round(scroll_top * strength);
         this.css('background-position-y', '-'+ move_value +'px');
         this.css('background-position', '0 -'+ move_value +'px');
     };
     $(window).on('scroll', function() {
       var wind  = $(window).innerWidth();
       console.log(wind);

       if(wind > 767){
         // alert("ch")
         $('.header-parallax').parallax(0.280);
         $('.header-parallax1').parallax(0.280);
         $('.header-parallax2').parallax(0.380);
         $('.header-parallax3').parallax(0.5);
          $('.header-parallax4').parallax(0.1);
       }
     });

	//
  // $('.header-parallax').parallax({speed : 0.60});
	// $('.header-parallax1').parallax({speed : 0.15});
	// $('.header-parallax2').parallax({speed : 0.40});
	// $('.header-parallax3').parallax({speed : 0.05});

	$('.opnsgn').click(function(){
		// alert("clk")
		$('.sgn-popup').addClass('open');
	});
	$('.opnlgn').click(function(){
		// alert("clk")
		$('.sgn-popup').removeClass('open');
		$('.fgt-popup').removeClass('open');
	});
	$('.fgtpass').click(function(){
		// alert("clk")
		$('.fgt-popup').addClass('open');
	});

	$('#popup1').popup({
	  focusdelay: 400,
    opacity:0.8
	// outline: true,
	// vertical: 'top'
	});

	$('#thankyou').popup({
		focusdelay: 400,
    opacity:0.8
	});

	$('#saveforlater_popup').popup({
		focusdelay: 400,
    opacity:0.8
	});

	$('#forgotmail').popup({
		focusdelay: 400,
    opacity:0.8
	});

	$('#changepassword').popup({
		focusdelay: 400,
    opacity:0.8
	});

	$('#submitgrant').popup({
		focusdelay: 400,
    opacity:0.8
	});

	$('#uppop').popup({
		focusdelay: 400,
    opacity:0.8
	});

	$('#uppop_statutory').popup({
		focusdelay: 400,
    opacity:0.8
	});
	
	$('#popup-know-more').popup({
		focusdelay: 400,
    opacity:0.8
	});

	/*$('.sub-botton1').click( function(){
		$('#thankyou').popup('show');


	})*/



 $('#tabs li').click(function(){
	 // alert("ch")
	 $('.advisory-detail .detail').removeClass('act');
 });

 $('.overvtab li').click( function(){
   // alert("")
   var detid = $(this).attr('data-prcess');
   $('.overvtab li').removeClass('actTab');
   $('.overview-data').removeClass('currtab');
   $(this).addClass('actTab');
   $("#"+detid).addClass('currtab');
 })


});




$(document).on('click', '.cls', function(){
	$(this).remove();
	$('.info').removeClass('act');
	$('.info').css({
		opacity: '0',
	});
});
$(document).on('click', 'li .col', function(){
	var clsele = $('<span class="rt-close cls_btn cls"></span>').length;
	if( clsele <= 1 ){
		$('#close').remove();
		// alert('')
		$(this).before('<span class="rt-close cls_btn cls" id="close"></span>')
	}

});
// $("li .col").each(function(){
// 		$(this).click(function(){
// 				$(this).find('.info').addClass('act');
// 				$(this).find('.info').css({
// 						opacity: '1',
// 						// display:'block'
// 				});
//
//
// 				// console.log(clsele);
//
// 				// $('<span class="rt-close cls_btn cls"></span>').appendTo($(this).parent());
// 				// console.log( $(this) );
//
// 		}
// 		// $('<span class="rt-close cls_btn cls"></span>').detach();
// 	)
// });

var inputs = document.querySelectorAll( '.inputfile1' );
Array.prototype.forEach.call( inputs, function( input )
{
	var label	 = input.nextElementSibling,
		labelVal = label.innerHTML;

	input.addEventListener( 'change', function( e )
	{
		var fileName = '';
		if( this.files && this.files.length > 1 )
			fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
		else
			fileName = e.target.value.split( '\\' ).pop();
      // console.log(fileName);

		if( fileName )
			label.querySelector( 'b' ).innerHTML = fileName;
		else
			label.innerHTML = labelVal;
	});
});

$(document).ready(function() {
var wind = $(window).innerWidth()
// console.log(wind);
	// alert("ch")
	var sldLeng = $('#tabs-1 .advisory').length;
	// console.log(sldLeng);
	if(wind > 1024 && sldLeng < 4)  {
		//$('.advisory.lst').hide();
		//$('.navSldr').show();
	}
	$('.nxt').click( function(){
		if(sldLeng >= 4  ){
			$('#tabs-1 .frst').hide();
			// $('#tabs-1 .frst').fadeIn();
			$('#tabs-1 .lst').css({
				"display":"block",
				"margin-right":"0",
				"margin-left": "20px",

			});
			$(this).addClass('actarr')
			$(this).prev().removeClass('actarr');
			$('.advisory-detail .detail').removeClass('act');
			// $('.lst').prev().css( marginRight , "20" );

		}
	});
	$('.prv').click( function(){
		if(sldLeng >= 4  ){
			$('#tabs-1 .lst').hide();
			$('#tabs-1 .frst').fadeIn();
			$(this).addClass('actarr');
			$(this).next().removeClass('actarr');
			$('.advisory-detail .detail').removeClass('act');

		}
	})

  $(".scrolto").click(function() {
      $('html, body').animate({
          scrollTop: $("#hwusecokk").offset().top - 15
      }, 2000);
  })

});

( function(){
  $('.shwcnt').hide();
  $('.showMore').click( function(){
    $(this).prev('div').slideToggle('slow')
    .siblings('div:visible').slideUp('slow');
    $(this).toggleClass('open');
    $('.advisory-mob ').siblings().removeClass('open').end()
    // $('.shwcnt').show();
  });

  $('#drpdwn').on('change', function(){
    var url = $(this).val();

    if(url){
      window.location = url;
      }
      return false;
  })

$('.dshtabs li').click( function(){
  // alert("")
var detid = $(this).attr('rel');
  $('.dshtabs li').removeClass('active');
  $('.tab_content').removeClass('active');
  $(this).addClass('active');
  $("#"+detid).addClass('active');
})



})();
