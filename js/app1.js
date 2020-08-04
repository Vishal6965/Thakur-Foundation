$(document).ready(function() {
   // use for active link
//    var str = location.href.toLowerCase();
//    $('.nav li a').each(function() {
//        if (str.indexOf(this.href.toLowerCase()) > -1) {
//            $("li.actnv").removeClass("actnv");
//            $(this).parent().addClass("actnv");
//			 //$("li.actnvSb").removeClass("actnvSb");
//            $(this).parent().parent().parent().addClass("actnvSb");
//        }
//    });
	// use for mobile animation
	$('.menu-icon').on('click', function(e) {
	  e.preventDefault();
	  $(this).next().toggleClass('mnavact');
	  return $(this).toggleClass('mnavact');
	});
	$("ul.mnavact li").each(function( index ) {
	$( this ).css({'animation-delay': (index/10)+'s'});

});

});
$(document).click(function (e) {
    var containers = $('.menu-icon, .nav ul');
    if (!containers.is(e.target) && containers.has(e.target).length === 0){
        containers.removeClass('mnavact');
    }
});
$(document).ready(function() {

  $('.contactbtn1').click(function() {
     //alert();
	  $('#sidebar').toggleClass('open');
  });
});

$(document).ready(function() {

  $('.contactbtn').click(function() {
     //alert();
	 $('#sidebar').toggleClass('open')
  });
});












$(window).scroll(function(){
    if ($(window).scrollTop() >= 300) {
       $('nav').addClass('fixed-header');
    }
    else {
       $('nav').removeClass('fixed-header');
    }
});



var lastId,
 topMenu = $("#mainNav"),
 topMenuHeight = topMenu.outerHeight()+1,
 // All list items
 menuItems = topMenu.find("a"),
 // Anchors corresponding to menu items
 scrollItems = menuItems.map(function(){
   var item = $($(this).attr("href"));
    if (item.length) { return item; }
 });

// Bind click handler to menu items
// so we can get a fancy scroll animation
menuItems.click(function(e){
  var href = $(this).attr("href"),
      offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+1;
  $('html, body').stop().animate({
      scrollTop: offsetTop
  }, 850);
  e.preventDefault();
});

// Bind to scroll
$(window).scroll(function(){
   // Get container scroll position
   var fromTop = $(this).scrollTop()+topMenuHeight;

   // Get id of current scroll item
   var cur = scrollItems.map(function(){
     if ($(this).offset().top < fromTop)
       return this;
   });
   // Get the id of the current element
   cur = cur[cur.length-1];
   var id = cur && cur.length ? cur[0].id : "";

   if (lastId !== id) {
       lastId = id;
       // Set/remove active class
       menuItems
         .parent().removeClass("actnv")
         .end().filter("[href=#"+id+"]").parent().addClass("actnv");
   }
});
