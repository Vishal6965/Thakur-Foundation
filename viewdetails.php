<?php
session_start();
include('config.php');
if(isset($_GET['appid'])){
  $application_id= $_GET['appid'];
}else{

	$application_id= '';


}
 ?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" type="text/css" href="css/reset.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" href="css/pikaday.css">

<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
<!--<link rel="stylesheet" type="text/css" href="css/owl.theme.default.css">-->
<link rel="stylesheet" type="text/css" href="css/media-new.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src= "js/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/vast-engineering/jquery-popup-overlay@2/jquery.popupoverlay.min.js"></script>

</head>

<body>
<div class="form-page">


	<section class="section1">
	    <div class="container">
				<header>
		      <div class="logo"><a href="http://mockup.org.uk/thakur-foundation/thakurfoundation/"><img src="images/logo.png" alt=""></a></div>
		      	<?php  if (isset($_SESSION['loggedin'])==1 ) {?>
		       <a href="<?php echo $base_url?>logoutadmin.php"><button id="#" class=" login btn-small btn-large"><img src="images/login-icon.png" alt="">LOGOUT</button></a>
		      <?php }else{?>
  					<button id="#" class="popup1_open login btn-small btn-large"><img src="images/login-icon.png" alt="">LOGIN</button>

		      <?php } ?>

		    </header>
			<div class="clear"></div>


		</div>

	</section>

	<section class="header-parallax" id="form-header">
		<div class="main_container">
			<div class="tbl">
				<div class="serbx td">
				 <h1>Grant Applicant Information</h1>

				</div>
			</div>

		</div>
	</section>


<section>
</section>
<?php 
$details="SELECT ga.*,ur.name as fname,lastname as lname, ur.mobile,ur.email  from grants_applicants ga LEFT JOIN user_register ur on ur.id=ga.user_id where ga.application_id='".$application_id."' ";

$resultinfouser = $con->query($details);
 

if (!empty($resultinfouser) && $resultinfouser->num_rows > 0) {
  while($rows = $resultinfouser->fetch_assoc()) {
	$mail_address1=$rows['mail_address'];
	//$primaryphone=$rows[''];
	$secondary_phone1=$rows['secondary_phone'];
	$nationality1	=$rows['nationality'];
	$age 			=$rows['age'];
	$resume 		=$rows['resume'];
	$last_org_work1 =$rows['last_org_work'];
	$pastbyline1	=$rows['pastbyline'];
	$ref11			=$rows['ref1'];
	$ref21			=$rows['ref2'];
	$ref31			=$rows['ref3'];
	$description_assignment1=$rows['description_assignment'];
	$statement_purpose1=$rows['statement_purpose'];
	$interest1		=$rows['interest'];
	$lname 			=$rows['lname'];
	$fname 			=$rows['fname'];
	$primaryphone 	=$rows['mobile'];
	$email 			=$rows['email'];
}}?>



<section>
 <div class="form-sec">


		<form class="" id="grantform"  method="post"  enctype="multipart/form-data" data-parsley-validate novalidate>
		<ul id="myfrmdata" class="formbx">
			<li>
			<p>First Name </p>
			<input type="text"  name="fname" value="<?php if(isset($fname)) echo $fname;else $fname;  ?>"  class="text-brd"  readonly  />

			</li>
		<li>
		<p>Last Name </p>
		<input type="text"  name="lname" value="<?php if(isset($lname)) echo $lname;else $lname; ?>" class="text-brd"readonly  />
		</li>
			<li>
					<p>E-mail address </p>
					<input type="email"  name="email"  value="<?php if(isset($email)) echo $email;else $email ;?>" class="text-brd" readonly />
					</li>

					<li>
					<p>Mailing Address </p>
					<input type="text"  name="mail_add"value="<?php  if(isset($mail_address1))echo $mail_address1;else $mail_address1; ?>"  class="text-brd" placeholder="" readonly />
					</li>

					<li>
					<p>Primary Phone Number </p>
					<input type="text" name="primaryphone" value="<?php if(isset($primaryphone)) echo $primaryphone;else $primary_phone;  ?>"  class="text-brd" readonly >
					</li>

					<li>
					<p>Secondary Phone Number </p>
					<input type="text"  name="secondaryphone" value="<?php if(isset($secondary_phone1)) echo $secondary_phone1;else $secondary_phone1 ?> " readonly>
					</li>

					<li>
					<p>Last Organization Worked for</p>
					<textarea class="text-brd" readonly><?php if(isset($last_org_work1)) echo $last_org_work1;else $last_org_work1; ?></textarea>
					</li>

					<li>
					<p>Past By-lines </p>
					<textarea readonly><?php if(isset($pastbyline1))echo $pastbyline1; else $pastbyline1; ?></textarea>
					</li>

					<li>
					<p>Reference 1</p>
					<textarea  readonly><?php if(isset($ref11)) echo $ref11;else $ref11=""; ?></textarea>
					</li>
					<li>
					<p>Reference 2 </p>
					<textarea readonly ><?php if(isset($ref21)) echo $ref21;else $ref21=""; ?></textarea>

					</li>
					<li>
					<p>Reference 3</p>
					<textarea readonly><?php if(isset($ref31)) echo $ref31; else $ref31=""; ?></textarea>
					</li>
					<li>
					<p> Area of interest </p>
					<input type="text" value="<?php if(isset($interest1)) echo $interest1; else $interest1 =""; ?>" readonly>
					
					</select>
								</li>

					<li>
					<p>Description of the assignment </p>
					<textarea readonly><?php if(isset($description_assignment1)) echo $description_assignment1;else $description_assignment1  ?></textarea>

					</li>

					<li>
					<p>Statement of Purpose </p>
					<textarea readonly ><?php if(isset($statement_purpose1)) echo $statement_purpose1;else  $statement_purpose1; ?></textarea>

					</li>
					<li>
					<p>Resume: <?php if(isset($resume)) {?>
					<p><a href="<?php echo $base_url?>upload/resume/<?php echo $resume;?>" target="_blank"><?php echo $resume ?></a>
					<?php }else{$resume;}?></p></p>
					 
					
				</li>
				<li>
				<p>
					
					Portfolio:<br/>
					<?php 
					$portdetails="SELECT * from portfolio where application_id='".$application_id."' ";
					$portresultinfouser = $con->query($portdetails);
 					if (!empty($portresultinfouser) && $portresultinfouser->num_rows > 0) {
						  while($rowp  = $portresultinfouser->fetch_assoc()) {
						  	$portfolio = $rowp['portfolio'];?>
					<p><a href="<?php echo $base_url?>upload/resume/<?php echo $portfolio;?>"><?php echo $portfolio; ?></a></p>
					<?php }}  ?>
					</p>	
				</li>
			</ul>
		</form>
		
	</div>



</section>



<?php include('footer.php');