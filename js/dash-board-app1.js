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


//var startDate,
//        endDate,
//        updateStartDate = function() {
//            startPicker.setStartRange(startDate);
//            endPicker.setStartRange(startDate);
//            endPicker.setMinDate(startDate);
//        },
//        updateEndDate = function() {
//            startPicker.setEndRange(endDate);
//            startPicker.setMaxDate(endDate);
//            endPicker.setEndRange(endDate);
//        },
//        startPicker = new Pikaday({
//            field: document.getElementById('start'),
//            minDate: new Date(),
//            maxDate: new Date(2020, 12, 31),
//            onSelect: function() {
//                startDate = this.getDate();
//                updateStartDate();
//            }
//        }),
//        endPicker = new Pikaday({
//            field: document.getElementById('end'),
//            minDate: new Date(),
//            maxDate: new Date(2020, 12, 31),
//            onSelect: function() {
//                endDate = this.getDate();
//                updateEndDate();
//            }
//        }),
//        _startDate = startPicker.getDate(),
//        _endDate = endPicker.getDate();
//
//        if (_startDate) {
//            startDate = _startDate;
//            updateStartDate();
//        }
//
//        if (_endDate) {
//            endDate = _endDate;
//            updateEndDate();
//        }
//        picker.setMoment(moment().dayOfYear(366));
