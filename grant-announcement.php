<?php
require_once 'classes/thakurfoundation_config.php';
date_default_timezone_set('Asia/Kolkata');
$currentDate = date("Y-m-d");
$obj = new FOUNDATION;
?>
<html>
    <head>
        <title>Thakur Foundation</title>
        <?php require_once 'head.php'; ?>
    </head>
    <body>
        <?php require_once 'header.php'; ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
        <!-- <section id="grant-announce-header" class="header-parallax">
            <div class="main_container" >
                <div class="tbl">
                    <div class="serbx">
                        <h1>Work to build a society that is more... <br>
                        <span class="textbt">aware, participative, inclusive, just.</span> </h1>
                    </div>
                </div>
            </div>
	</section> -->
    <section>
      <div class="banner-inner">
        <img src="images/grant-announcements-banner.jpg" alt="Banner" class="banner-img hidden-lg">
        <img src="images/grant-announcements-banner-sm.jpg" alt="Banner" class="banner-img hidden-sm">
        <div class="banner-txt">
          <h2>Grant Announcements</h2>
        </div>
      </div>
    </section>

	<section class="ourser">
		<div class="container">
			<div class="sub-title red">Choose the year and grant type to see grants announced in a particular year.</div>
		</div>
    </section>
	<section>
		<div class="container">
			<div class="grant-fltr form-sec">
				<form class="" id="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"  enctype="multipart/form-data" data-parsley-validate novalidate>
					<div class="select-drpbBx">
				  		<select name="year" id="year" class="year">
							<option value="2017">2017</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							<option value="2020" selected>2020</option>
				  		</select>
				  	</div>
					<div class="select-drpbBx">
				  		<select name="grant-type" id="granttype">
							<option value="Public Health" selected>Public Health</option>
							<option value="Civil Liberties">Civil Liberties</option>
							<option value="Right to Information">Right to Information</option>
							<option value="Evidence based Science">Evidence based Science</option>
				  		</select>
				  	</div>
				</form>
			</div>
		</div>	
	</section>
	<!-- <section class="grantanc header-parallax">
		<div class="container">
			<div class="grantancBx newBX">
		  		<figure>
					<img src="images/doc-checkup.jpg" alt="">
		  		</figure>
				<article>
					<p class="newttl">Thakur Foundation announces a grant to set up <br> India Mental Health Observatory</p>
      				<p class="hidden"></p>
					<p></p>
					<p class="colr-txt line">Centre for Mental Health Law &amp; Policy, <br>Indian Law Society, Pune</p>
					<p>Congratulations to the award recipients.</p>
					<a href="#popup-know-more" class="popup-know-more_open" data-popup-ordinal="1">Know More</a>
				</article>
			</div>
	  	</div>
	</section> -->
	<div class="getImage">
		<!-- <section class="grantanc header-parallax margin-b50">
			<div class="container "> -->
				<!-- <div class="grantancBx newBX">
			  		
				</div>
		  	</div>
		</section> -->
	</div>

<script>

   $(document).ready(function() {
    var selectedYear = $('#year').val();
    var selectedGrantType = $('#granttype').val();
    $.ajax({
            type: "POST",
            data: {year:selectedYear,grant_type:selectedGrantType},
            url: 'filtergrantannouncement.php',
            success: function(result)
            {           
                $(".getImage").empty();      
               var result = JSON.parse(result);
                console.log(result); 
                
                $.each(result, function (i) {
                    $.each(result[i], function (key, val) {
                        // console.log(key +"="+ val);
                        var res = val.split("|");
                        if(res[1].length > 2){
                         link = "href='"+res[1]+"'";
                        }else{
                         link = "";
                        }
                        var html ="";
                        html = "<section class='grantanc header-parallax margin-b50'><div class='container'><a "+link+" target='_blank'><img src="+res[0].replace("|", "")+" /></a></section></div>"; 
                        if(html != '')
                        {
                          $(".getImage").append(html);
                        }
                    });
                       
                });

            }
        });


   $("#year").change(function() {
   		var selectedYear = $(this).val();
   		var selectedGrantType = $('#granttype').val();

   		$.ajax({
            type: "POST",
            data: {year:selectedYear,grant_type:selectedGrantType},
            url: 'filtergrantannouncement.php',
            success: function(result)
            {           
                $(".getImage").empty();      
               var result = JSON.parse(result);
                console.log(result); 
                
                $.each(result, function (i) {
                    $.each(result[i], function (key, val) {
                         //console.log(key +"="+ val);
                         var res = val.split("|");
                         if(res[1].length > 2){
                          link = "href='"+res[1]+"'";
                         }else{
                          link = "";
                         }
                        var html ="";
                        html = "<section class='grantanc header-parallax margin-b50'><div class='container'><a "+link+"   target='_blank'><img src="+res[0].replace("|", "")+" /></a></section></div>"; 
                        if(html != '')
                        {
                        	$(".getImage").append(html);
                        }
                    });
                       
                });

            }
        });
  
	});

   $( "#granttype" ).change(function() {

   		var selectedGrantType = $(this).val();
   		var selectedYear = $('#year').val();
   		//alert(selectedGrantType);

   		$.ajax({
            type: "POST",
            data: {year:selectedYear,grant_type:selectedGrantType},
            url: 'filtergrantannouncement.php',
            success: function(result)
            {                 
              $(".getImage").empty();
                var result = JSON.parse(result);
                console.log(result); 
                
                $.each(result, function (i) {
                    $.each(result[i], function (key, val) {
                         // console.log(key +"="+ val);
                         var res = val.split("|");
                         if(res[1].length > 2){
                          link = "href='"+res[1]+"'";
                         }else{
                          link = "";
                         }
                        var html ="";
                        html = "<section class='grantanc header-parallax margin-b50'><div class='container'><a "+link+" target='_blank'><img src="+res[0].replace("|", "")+" /></a></section></div>"; 
                        if(html != '')
                        {
                        	$(".getImage").append(html);
                        }
                        
                    });
                       
                });

            }
        });
  
	});

   

 });
</script>



<?php include ('footer.php'); ?>
