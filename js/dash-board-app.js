// $('.well').popup({
//   escape: false,
//   blur: false,
//   scrolllock: true,
//   transition: 'all 0.3s'
// });

$(document).ready(function(){
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

});
/*  tab  */
$(".tab_content").hide();
    $(".tab_content:first").show();

  /* if in tab mode */
    $("ul.dshtabs li").click(function() {

      $(".tab_content").hide();
      var activeTab = $(this).attr("rel");
      $("#"+activeTab).fadeIn();

      $("ul.dshtabs li").removeClass("active");
      $(this).addClass("active");

	  $(".tab_drawer_heading").removeClass("d_active");
	  $(".tab_drawer_heading[rel^='"+activeTab+"']").addClass("d_active");

    });
	/* if in drawer mode */
	$(".tab_drawer_heading").click(function() {

      $(".tab_content").hide();
      var d_activeTab = $(this).attr("rel");
      $("#"+d_activeTab).fadeIn();

	  $(".tab_drawer_heading").removeClass("d_active");
      $(this).addClass("d_active");

	  $("ul.dshtabs li").removeClass("active");
	  $("ul.dshtabs li[rel^='"+d_activeTab+"']").addClass("active");
    });

	$('ul.dshtabs li').last().addClass("tab_last");
