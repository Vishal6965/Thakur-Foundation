$('.well').popup({
  escape: false,
  blur: false,
  scrolllock: true,
  transition: 'all 0.3s'
});

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
