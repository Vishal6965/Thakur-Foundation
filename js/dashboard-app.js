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
    var label  = input.nextElementSibling,
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


/*  Select dropdown  */

// $('select').each(function () {
//
//     // Cache the number of options
//     var $this = $(this),
//         numberOfOptions = $(this).children('option').length;
//
//     // Hides the select element
//     $this.addClass('s-hidden');
//
//     // Wrap the select element in a div
//     $this.wrap('<div class="select"></div>');
//
//     // Insert a styled div to sit over the top of the hidden select element
//     $this.after('<div class="styledSelect"></div>');
//
//     // Cache the styled div
//     var $styledSelect = $this.next('div.styledSelect');
//
//     // Show the first select option in the styled div
//     $styledSelect.text($this.children('option').eq(0).text());
//
//     // Insert an unordered list after the styled div and also cache the list
//     var $list = $('<ul />', {
//         'class': 'options'
//     }).insertAfter($styledSelect);
//
//     // Insert a list item into the unordered list for each select option
//     for (var i = 0; i < numberOfOptions; i++) {
//         $('<li />', {
//             text: $this.children('option').eq(i).text(),
//             rel: $this.children('option').eq(i).val()
//         }).appendTo($list);
//     }
//
//     // Cache the list items
//     var $listItems = $list.children('li');
//
//     // Show the unordered list when the styled div is clicked (also hides it if the div is clicked again)
//     $styledSelect.click(function (e) {
//         e.stopPropagation();
//         $('div.styledSelect.active').each(function () {
//             $(this).removeClass('active').next('ul.options').hide();
//         });
//         $(this).toggleClass('active').next('ul.options').toggle();
//     });
//
//     // Hides the unordered list when a list item is clicked and updates the styled div to show the selected list item
//     // Updates the select element to have the value of the equivalent option
//     $listItems.click(function (e) {
//         e.stopPropagation();
//         $styledSelect.text($(this).text()).removeClass('active');
//         $this.val($(this).attr('rel'));
//         $list.hide();
//
//          var selectedText =  $("#sorting").val();
//          //alert(selectedText);
//           $('#sortText').val(selectedText);
//           var pageno = $('#pageno').val();
//           queryBuilder(pageno);
//         /* alert($this.val()); Uncomment this for demonstration! */
//     });
//
//     // Hides the unordered list when clicking outside of it
//     $(document).click(function () {
//         $styledSelect.removeClass('active');
//         $list.hide();
//     });
//
// });
