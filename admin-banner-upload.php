<?php
session_start();
//print_r($_SESSION);
include('config.php');

if(isset($_POST['submit'])){

	$grantType = $_POST['grant-type'];
	$selectedDate = date("Y-m-d",strtotime($_POST['upload_date']));
	$year = date("Y", strtotime($selectedDate));
	//print_r($year);die;
    if(count($_FILES['upload']['name']) > 0){
        //Loop through each file
        for($i=0; $i<count($_FILES['upload']['name']); $i++) {
          //Get the temp file path
            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

            //Make sure we have a filepath
            if($tmpFilePath != ""){
            
                //save the filename
                $shortname = $_FILES['upload']['name'][$i];

                //$fileName = time().'_'.$_FILES["upload"]["name"];
			    $file_path = "upload/banner/";
	                        
		        $filePath = $file_path.basename($shortname);
		        //print_r($shortname);die;
                //save the url and the file
               // $filePath = "upload/banner" . date('d-m-Y-H-i-s').'-'.$_FILES['upload']['name'][$i];
                $createdDate = date('d-m-Y-H-i-s');
                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $filePath)) {

                    $files[] = $shortname;
                    //insert into db 
                    //use $shortname for the filename
                    //use $filePath for the relative url to the file

                    $bannerQuery = "INSERT INTO banner_uploads (name,year,grant_area,file_path)
							VALUES ('".$shortname."','".$year."','".$grantType."','".$filePath."')";

									$con->query($bannerQuery) === TRUE;
									$flagdoc=1;
								



                }
              }
        }
    }
    echo"<script language='javascript'>
	alert('Banner uploaded successfully');

	</script>";
   
}

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Banner Upload</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="css/reset.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" href="css/pikaday.css">
	<link rel="icon" type="image/x-icon" href="images/favicon.ico" />
	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
	<!--<link rel="stylesheet" type="text/css" href="css/owl.theme.default.css">-->
	<link rel="stylesheet" type="text/css" href="css/media-new.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src= "js/owl.carousel.min.js"></script>
	<script src= "js/validate.js"></script>
	<script src= "js/parsley.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/vast-engineering/jquery-popup-overlay@2/jquery.popupoverlay.min.js"></script>

</head>

<body>
	<div class="form-page">


		<section class="section1">
			<div class="container">
				<header>
					<div class="logo"><a href="https://www.thakur-foundation.org/"><img src="images/logo.png" alt=""></a></div>
					<?php  if (isset($_SESSION['loggedin'])==1  && isset($_SESSION['admin'])==1) {?>

					<a href="<?php echo $base_url?>logoutadmin.php"><button id="#" class=" login btn-small btn-large"><img src="images/login-icon.png" alt="">LOGOUT</button></a>
					<?php }else{?>
					<button id="#" class="popup1_open login btn-small btn-large"><img src="images/login-icon.png" alt="">LOGIN</button>

					<?php } ?>

				</header>
				<div class="clear"></div>
				<?php  if (isset($_SESSION['loggedin'])==1  && isset($_SESSION['admin'])==1) {?>
				<div class="toplinksec admin-toplinksec">
					<div class="slctbg">
						<select id="drpdwn" class="selectbx">
							<option value="" disabled selected>My Account</option>
							<option value="https://www.thakur-foundation.org/admin-dashboard.php">Admin Dashboard</option>


						</select>
					</div>
				</div>
				<?php } ?>

			</div>

		</section>

		<section class="header-parallax" id="form-header">
			<div class="main_container">
				<div class="tbl">
					<div class="serbx td">
						<h1>Admin Banner Upload</h1>

					</div>
				</div>

			</div>
		</section>


		<section>
			<?php  if (isset($_SESSION['loggedin'])==1) {?>
			<div class="main_container">
				<div class="form-cnt">
					<div class="form-sec">
						<form class="" id="adminform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"  enctype="multipart/form-data" data-parsley-validate novalidate>

							<fieldset>
								<legend>Select Banner file</legend>
								<ul class="formbx admin-banner">
									<li>
										<p>Upload Date <span>(YY/MM/DD)</span> </p>
										<input type="text" id="datepicker1" name="upload_date" placeholder=""  class="dtepick" data-parsley-required-message="Please Enter Review Date"  data-parsley-trigger="change" autocomplete="off" required >
									</li>
									<!-- <li>
										<p>Last Name </p>
										<input type="text" id="lastname"  class="text-brd" placeholder="" readonly />
									</li> -->
									<li>
										<p>Grant Type </p>
										<select name="grant-type" id="grantType">
											<option value="Public Health">Public Health</option>
											<option value="Civil Liberties">Civil Liberties</option>
											<option value="Right to Information">Right to Information</option>
											<option value="Evidence based Science">Evidence based Science</option>
										</select>
									</li>
									<li class="fileup files" id="resumeup">
										<input type="hidden" id="hidden_resume" value="">
										<input type="file" id='upload' name="upload[]" class="hde rtable req" data-multiple-caption="{count} files selected" data-parsley-required-message="Please select banner file" multiple="multiple" 
										required />
										<label for="upload"><span>Upload Resume</span><b></b></label><br/>
										<b class="grttxt">(Please select any one file only. Pdf/Doc/Docx file upto size 2 MB only)</b>

										<table id="fileList" style="width: 100%;"></table>
									</li>
									<br/>
									
									<li class="inpfield">
										<input type="submit" onclick="javascript:return validateform();"  value="Submit" name="submit" class="btn " />
										
									</li>
								</ul>
							</fieldset>								
						</form>

					</div>
				</div>
			</div>
			<?php }?>
		</section>


		<!-- <script src="js/app.js"></script> -->
		<script src="js/moment.js"></script>
		<script src="js/pikaday.js"></script>
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script> -->

		<script>
		var picker = new Pikaday(
		{
			field: document.getElementById('datepicker'),
			firstDay: 1,
			minDate: new Date(1986, 12, 31),
			maxDate: new Date(2020, 12, 31),
			format : "YYYY-MM-DD",
			defaultDate: null,
			yearRange: [2000,2020]
		});
		var datepicker1 = new Pikaday({
			field: document.getElementById('datepicker1'),
			firstDay: 1,
			minDate: new Date(1986, 12, 31),
			format : "YYYY-MM-DD",
			maxDate: new Date(2020, 12, 31),
			defaultDate: null,
			yearRange: [2000,2020]

		});

		</script>

	</div>


	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
	<script src="https://www.thakur-foundation.org/js/jquery.maskMoney.js?v=1"></script>

	<?php include('footer.php');?>
</body>
</html>
