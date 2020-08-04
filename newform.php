<?php
session_start();
//print_r($_POST);
include('config.php');
require('class.smtp.php');
require('class.phpmailer.php');
require ('PHPMailerAutoload.php');
require ('admintemp.php');
require ('amountmail.php');
if(isset($_SESSION['admin'])){
$admin = $_SESSION['admin'];

if($admin == 0 || $admin != 1)
{
	header("Location:http://onlinereviews.org.uk/thakur-foundation/thakurfoundation/index.php");
}
}



if(isset($_POST['appl_id']))  $application_id= $_POST['appl_id'];else $application_id="";
if(isset($_POST['receipt_date'])) $new_date= $_POST['receipt_date'];else $new_date='null';

 $receipt_date = $new_date;

if(!empty($_POST['review_date']))
{
	$review_date1= "'".$_POST["review_date"]."'";
}
 else
 {
 	$review_date1='NULL';
 } 

 $review_date = $review_date1;

 if(isset($_GET['appl_id'])){
include('getautocomplete.php');
 $application_id=base64_decode($_GET['appl_id']);
temp($application_id);
}

// print_r($review_date);
if(!empty($_POST['project_start_release_date'])) $project_start_release_date1= "'".$_POST['project_start_release_date']."'";else $project_start_release_date1='NULL';



 $project_start_release_date=$project_start_release_date1;
/*if(isset($_POST['decision'])) $decision= $_POST['decision'];else $decision="";*/
if(isset($_POST['approve_grant_amount'])) $approve_grant_amount= $_POST['approve_grant_amount'];else $approve_grant_amount="";
if(isset($_POST['approve_expense_amount'])) $approve_expense_amount= $_POST['approve_expense_amount'];else $approve_expense_amount="";
if(!empty($_POST['first_tranche_release_date'])) $first_tranche_release_date1= "'".$_POST['first_tranche_release_date']."'";else $first_tranche_release_date1='NULL';

$first_tranche_release_date = $first_tranche_release_date1;

if(isset($_POST['first_tranche_amount'])) $first_tranche_amount= $_POST['first_tranche_amount'];else $first_tranche_amount="";
if(isset($_POST['first_expense_tranche_amount'])) $first_expense_tranche_amount= $_POST['first_expense_tranche_amount'];else $first_expense_tranche_amount="";
if(isset($_POST['first_tranche_amount_paid'])) $first_tranche_amount_paid= $_POST['first_tranche_amount_paid'];else $first_tranche_amount_paid="";
if(isset($_POST['first_expense_tranche_paid'])) $first_expense_tranche_paid= $_POST['first_expense_tranche_paid'];else $first_expense_tranche_paid="";
if(!empty($_POST['projectcted_interim_review_date'])) $projected_interim_review_date1= "'".$_POST['projectcted_interim_review_date']."'";else $projected_interim_review_date1='NULL';

$projected_interim_review_date = $projected_interim_review_date1;

if(!empty($_POST['actual_interim_review_date'])) $actual_interim_review_date1= "'".$_POST['actual_interim_review_date']."'";else $actual_interim_review_date1='NULL';

$actual_interim_review_date = $actual_interim_review_date1;

if(isset($_POST['interim_tranche_amount'])) $interim_tranche_amount= $_POST['interim_tranche_amount'];else $interim_tranche_amount="";
if(isset($_POST['interim_tranche_amount_paid'])) $interim_tranche_amount_paid= $_POST['interim_tranche_amount_paid'];else $interim_tranche_amount_paid="";
if(!empty($_POST['projected_publication_date'])) $projected_publication_date1= "'".$_POST['projected_publication_date']."'";else $projected_publication_date1='NULL';

$projected_publication_date = $projected_publication_date1;

if(!empty($_POST['actual_publication_date'])) $actual_publication_date1= "'".$_POST['actual_publication_date']."'";else $actual_publication_date1='NULL';
 $actual_publication_date = $actual_publication_date1;


if(!empty($_POST['final_tranche_release_date'])) $final_tranche_release_date1= "'".$_POST['final_tranche_release_date']."'";else $final_tranche_release_date1='NULL';
$final_tranche_release_date = $actual_publication_date1;
if(isset($_POST['final_tranche_paid'])) $final_tranche_paid= $_POST['final_tranche_paid'];else $final_tranche_paid="";
if(isset($_POST['final_expense_paid'])) $final_expense_paid= $_POST['final_expense_paid'];else $final_expense_paid="";
if(isset($_POST['grantstatus']))  $grantstatus= $_POST['grantstatus'];else $grantstatus="";
if(isset($_POST['mentors'])) $mentors=  $_POST['mentors'] ;else $mentors='1';
if(!empty($_POST['completion_date'])) $completion_date1= "'".$_POST['completion_date']."'";else $completion_date1='NULL';

$completion_date = $completion_date1;
if(!empty($_POST['publication_date'])) $publication_date1= "'".$_POST['publication_date']."'";else $publication_date1='NULL';
$publication_date = $publication_date1;



if(!empty($_POST['final_expense_release_date'])) $final_expense_release_date1= "'".$_POST['final_expense_release_date']."'";else $final_expense_release_date1='NULL';
$final_expense_release_date = $final_expense_release_date1;

if(isset($_POST['final_expense_amount'])) $final_expense_amount= $_POST['final_expense_amount'];else $final_expense_amount="";
if(isset($_POST['final_tranche_amount'])) $final_tranche_amount= $_POST['final_tranche_amount'];else $final_tranche_amount="";






if(isset($_POST['saveforlater'])){

$infologgedin ="SELECT ur.email,ur.name from user_register ur LEFT JOIN grants_applicants ga on ga.user_id=ur.id where ga.application_id='".$application_id."' ";
//$info = "SELECT * FROM user_register where id='".$user_id."' ";

$resultinfouser = $con->query($infologgedin);
if (!empty($resultinfouser) && $resultinfouser->num_rows > 0) {
//if ($resultinfouser->num_rows > 0) {
    // output data of each row
    while($rows = $resultinfouser->fetch_assoc()) {
//print_r($rows);exit;
    	$emailuser=$rows['email'];
    	$nameuser=$rows['name'];
    }


  }

$seluser = "SELECT * FROM admin where application_id='".$application_id."' ";
//$seluser = "SELECT * FROM grants_applicants  where id= '4' ";
$result = $con->query($seluser);
 $result->num_rows;

if (!empty($result) && $result->num_rows > 0) {



							  $sqlinsert = "UPDATE `admin` SET  `receipt_date`='$receipt_date',
							  `review_date` 				= $review_date,
							  `project_start_date` 			= $project_start_release_date,

							  `approved_grant_amount` 		= '$approve_grant_amount' ,
							  `approved_expense_amount`		=  '$approve_expense_amount',
							  `first_tranche_release_date` 	= $first_tranche_release_date ,
							  `first_tranche_amount` 		= '$first_tranche_amount' ,
							  `first_expense_tranche_amount` = '$first_expense_tranche_amount' ,
							  `first_tranche_amount_paid`	='$first_tranche_amount_paid' ,
							  `first_expense_tranche_paid`	='$first_expense_tranche_paid' ,

								`projected_interim_review_date` = $projected_interim_review_date ,
								`actual_interim_review_date`	= $actual_interim_review_date ,
								`interim_tranche_amount` 		= '$interim_tranche_amount' ,
								`interim_tranche_amount_paid` 	= '$interim_tranche_amount_paid' ,
								 `projected_publication_date` 	= $projected_publication_date,
								 `actual_publication_date` 		= $actual_publication_date,
								 `final_tranche_release_date` 	= $final_tranche_release_date,
								 `final_tranche_amount` 		= '$final_tranche_amount',
								 `final_expense_release_date` 	= $final_expense_release_date,
								 `final_expense_amount` 		= '$final_expense_amount',
								 `final_tranche_paid` 			= '$final_tranche_paid',
								 `final_expense_paid` 			= '$final_expense_paid',
								 `grant_status` 				= '$grantstatus',
								 `mentor_id` 					= '$mentors',
								 `completion_date` 				= $completion_date,
								 `publication_date` 			= $publication_date,
								 `submit` = '1'
							  where  application_id				='".$application_id."' ";
									  

/*if( !empty($_FILES['impact'])){
					//print_r($_FILES);
						$targetDir = "upload/impact/";
						    $allowTypes = array('pdf','mp4','mp3','flv');

						    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
						    if(!empty(array_filter($_FILES['impact']['name']))){
						        foreach($_FILES['impact']['name'] as $key=>$val){
						            // File upload path
						            $fileName =time(). basename($_FILES['impact']['name'][$key]);
						            $targetFilePath = $targetDir . $fileName;
						            $totalFileSize = array_sum($_FILES['impact']['size']);
						            $maxFileSize = 25 * 1024 * 1024 ;
						            // Check whether file type is valid
						            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

						            if(in_array($fileType, $allowTypes)){

											if ($totalFileSize < $maxFileSize) {

						                // Upload file to server
						                move_uploaded_file($_FILES["impact"]["tmp_name"][$key], $targetFilePath);
						                      $port ="INSERT INTO impact (application_id,impact)
																		VALUES ('".$_POST['appl_id']."','".$fileName."')";

																			$con->query($port) === TRUE;




						               } else{

						               	$output= "Please select  Total impact size upto 25MB";
						               }
						            }else{
						                 $output= "Please select impact only pdf,mp4,mp3 type.";
						            }
						        }

						}


					}*/
					if ($con->query($sqlinsert) === TRUE) {

						//$grantstatus='';
						$sub='';
						$reg='';
						 while($rows = $result->fetch_assoc()) {
						 	$checkGrantStatus = $rows['grant_status'];
						 	$checkfirst_tranche_amount_paidStatus 	= $rows['first_tranche_amount_paid'];
						 	$checkfinal_tranche_paidStatus 			= $rows['final_tranche_paid'];
							$checkfinal_expense_paidStatus 			= $rows['final_expense_paid'];
							$checkfirst_expense_tranche_paidStatus  = $rows['first_expense_tranche_paid'];
							$checkinterim_tranche_amount_paidStatus = $rows['interim_tranche_amount_paid'];
							$checkfirst_tranche_amount_paidStatus = $rows['first_tranche_amount_paid'];

						 }
					 		if($grantstatus != '1' || $grantstatus != '2' || $grantstatus != '3'){
								if($grantstatus != $checkGrantStatus) {
							
								$reg = postgrantstatus($nameuser,$emailuser,$application_id,$grantstatus,$approve_grant_amount,$approve_expense_amount);
							
						       }
						    }
							if($first_expense_tranche_paid != $checkfirst_expense_tranche_paidStatus) {

								if($first_expense_tranche_paid == 'yes')
								{
									$notify  = "first_expense_tranche_paid";
									$amnt  	 = amountstatus($nameuser,$emailuser,$application_id,$first_expense_tranche_amount,$final_tranche_amount,$final_expense_amount,$interim_tranche_amount,$first_tranche_amount,$notify);
								}
							}
							if($final_tranche_paid != $checkfinal_tranche_paidStatus) {
							
								if($final_tranche_paid == 'yes')
								{
									$notify = "final_tranche_paid";
									$amnt   =  amountstatus($nameuser,$emailuser,$application_id,$first_expense_tranche_amount,$final_tranche_amount,$final_expense_amount,$interim_tranche_amount,$first_tranche_amount,$notify);
								}	
									
									}

							if($final_expense_paid != $checkfinal_expense_paidStatus) {
							
								if($final_expense_paid == 'yes')
								{
									$notify = "final_expense_paid";
									$amnt   =  amountstatus($nameuser,$emailuser,$application_id,$first_expense_tranche_amount,$final_tranche_amount,$final_expense_amount,$notify);
								}	
									
									}
							if($interim_tranche_amount_paid != $checkinterim_tranche_amount_paidStatus) {
							
								if($interim_tranche_amount_paid == 'yes')
								{
									$notify = "interim_tranche_amount";
									$amnt   =  amountstatus($nameuser,$emailuser,$application_id,$first_expense_tranche_amount,$final_tranche_amount,$final_expense_amount,$interim_tranche_amount,$notify);
								}	
									
									}
							if($first_tranche_amount_paid != $checkfirst_tranche_amount_paidStatus) {
							
								if($first_tranche_amount_paid == 'yes')
								{
									$notify = "first_tranche_amt";
									$amnt   =  amountstatus($nameuser,$emailuser,$application_id,$first_expense_tranche_amount,$final_tranche_amount,$final_expense_amount,$interim_tranche_amount,$first_tranche_amount,$notify);
								}	
									
									}	
							echo"<script language='javascript'>
					 		 alert('Application saved successfully');

									</script>";
							 }

}else{

$seluser1 = "SELECT application_id FROM grants_applicants where complete='1' ";
//$seluser = "SELECT * FROM grants_applicants  where id= '4' ";
$result1 = $con->query($seluser1);
$storeArray = Array();
if (!empty($result1) && $result1->num_rows > 0) {
 while($rows = $result1->fetch_array()) {
 	$storeArray[] =  $rows['application_id'];

}}






//print_r($storeArray);
if (in_array($application_id, $storeArray)) {

$sqlinsert = "INSERT INTO admin (application_id,
 receipt_date,
 review_date,
project_start_date,
 approved_grant_amount,
 approved_expense_amount,
 first_tranche_release_date,
 first_tranche_amount,
 first_expense_tranche_amount,
 first_tranche_amount_paid,
 first_expense_tranche_paid,
 projected_interim_review_date,
 actual_interim_review_date,
 interim_tranche_amount,
 interim_tranche_amount_paid,
 projected_publication_date,
 actual_publication_date,
 final_tranche_release_date,
 final_tranche_amount,
 final_expense_release_date,
 final_expense_amount,
 final_tranche_paid,
 final_expense_paid,
 grant_status,
 mentor_id,
 completion_date,
 publication_date,
 submit)
VALUES ('".$application_id."',
'".$receipt_date."',
".$review_date.",
".$project_start_release_date.",
'".$approve_grant_amount."',
'".$approve_expense_amount."',
".$first_tranche_release_date.",
'".$first_tranche_amount."',
'".$first_expense_tranche_amount."',
'".$first_tranche_amount_paid."',
'".$first_expense_tranche_paid ."',
".$projected_interim_review_date .",
".$actual_interim_review_date.",
'".$interim_tranche_amount."',
'". $interim_tranche_amount_paid ."',
".$projected_publication_date.",
".$actual_publication_date.",
".$final_tranche_release_date.",
'".$final_tranche_amount."',
".$final_expense_release_date.",
'".$final_expense_amount."',
'".$final_tranche_paid."',
'".$final_expense_paid."',
'".$grantstatus."',
'".$mentors."',
".$completion_date.",
".$publication_date.",'1')";
							/*if ($con->query($sqlinsert) === TRUE) {
													$lastid = mysqli_insert_id($con);
													//echo "good";
												}
												  else {
												    $con->error;
												}*/

/*if(isset($_FILES['impact']) && !empty($_FILES['impact'])){

						$targetDir = "upload/impact/";
						    $allowTypes = array('pdf','mp4','mp3','flv');

						    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
						    if(!empty(array_filter($_FILES['impact']['name']))){
						        foreach($_FILES['impact']['name'] as $key=>$val){
						            // File upload path
						            $fileName =time().basename($_FILES['impact']['name'][$key]);
						            $targetFilePath = $targetDir . $fileName;
						            $totalFileSize = array_sum($_FILES['impact']['size']);
						            $maxFileSize = 25 * 1024 * 1024 ;
						            // Check whether file type is valid
						            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

						            if(in_array($fileType, $allowTypes)){

											if ($totalFileSize < $maxFileSize) {
									    $output= 'Your files exceed the limit of 100MB capacity';

						                // Upload file to server
						                move_uploaded_file($_FILES["impact"]["tmp_name"][$key], $targetFilePath);
						                      $port ="INSERT INTO impact (application_id,impact)
																		VALUES ('".$_POST['appl_id']."','".$fileName."')";

													$con->query($port) === TRUE;




						               } else{

						               	$output= "Please select  Total impact size upto 25MB";
						               }
						            }else{
						                 $output= "Please select impact only pdf,mp4,mp3 type.";
						            }
						        }

						}
					}*/

					if ($con->query($sqlinsert) === TRUE) {


						$sub='';
						$reg='';
						$checkGrantStatus = '';
					 	$checkfirst_tranche_amount_paidStatus 	= '';
					 	$checkfinal_tranche_paidStatus 			= '';
						$checkfinal_expense_paidStatus 			= '';
						$checkfirst_expense_tranche_paidStatus  = '';
						$checkinterim_tranche_amount_paidStatus = '';
						$checkfirst_tranche_amount_paidStatus	= '';
						 while($rows = $result->fetch_assoc()) {
						 	$checkGrantStatus = $rows['grant_status'];
						 	$checkfirst_tranche_amount_paidStatus 	= $rows['first_tranche_amount_paid'];
						 	$checkfinal_tranche_paidStatus 			= $rows['final_tranche_paid'];
							$checkfinal_expense_paidStatus 			= $rows['final_expense_paid'];
							$checkfirst_expense_tranche_paidStatus  = $rows['first_expense_tranche_paid'];
							$checkinterim_tranche_amount_paidStatus = $rows['interim_tranche_amount_paid'];
							$checkfirst_tranche_amount_paidStatus = $rows['first_tranche_amount_paid'];

						 }

						if($checkGrantStatus == '' || empty($checkGrantStatus))
						{
					 		if($grantstatus != '1' || $grantstatus != '2' || $grantstatus != '3')
					 		{
								if($grantstatus != $checkGrantStatus) 
								{							
									$reg = postgrantstatus($nameuser,$emailuser,$application_id,$grantstatus,$approve_grant_amount,$approve_expense_amount);							
						        }
						    }
						}

						if($checkfirst_expense_tranche_paidStatus == '' || empty($checkfirst_expense_tranche_paidStatus))
						{						    
						    if($first_expense_tranche_paid != $checkfirst_expense_tranche_paidStatus) {

								if($first_expense_tranche_paid == 'yes')
								{
									$notify  = "first_expense_tranche_paid";
									$amnt  	 = amountstatus($nameuser,$emailuser,$application_id,$first_expense_tranche_amount,$final_tranche_amount,$final_expense_amount,$interim_tranche_amount,$first_tranche_amount,$notify);
								}
							}
						}

						if($checkfinal_tranche_paidStatus == '' || empty($checkfinal_tranche_paidStatus))
						{
							if($final_tranche_paid != $checkfinal_tranche_paidStatus) 
							{							
								if($final_tranche_paid == 'yes')
								{
									$notify = "final_tranche_paid";
									$amnt   =  amountstatus($nameuser,$emailuser,$application_id,$first_expense_tranche_amount,$final_tranche_amount,$final_expense_amount,$interim_tranche_amount,$first_tranche_amount,$notify);
								}	
							}
						}

						if($checkfinal_expense_paidStatus == '' || empty($checkfinal_expense_paidStatus))
						{
							if($final_expense_paid != $checkfinal_expense_paidStatus) 
							{							
								if($final_expense_paid == 'yes')
								{
									$notify = "final_expense_paid";
									$amnt   =  amountstatus($nameuser,$emailuser,$application_id,$first_expense_tranche_amount,$final_tranche_amount,$final_expense_amount,$notify);
								}
							}
						}

						if($checkinterim_tranche_amount_paidStatus == '' || empty($checkinterim_tranche_amount_paidStatus))
						{
							if($interim_tranche_amount_paid != $checkinterim_tranche_amount_paidStatus) 
							{							
								if($interim_tranche_amount_paid == 'yes')
								{
									$notify = "interim_tranche_amount";
									$amnt   =  amountstatus($nameuser,$emailuser,$application_id,$first_expense_tranche_amount,$final_tranche_amount,$final_expense_amount,$interim_tranche_amount,$notify);
								}	
							}
						}

						if($checkfirst_tranche_amount_paidStatus == '' || empty($checkfirst_tranche_amount_paidStatus))
						{
							if($first_tranche_amount_paid != $checkfirst_tranche_amount_paidStatus) 
							{							
								if($first_tranche_amount_paid == 'yes')
								{
									$notify = "first_tranche_amt";
									$amnt   =  amountstatus($nameuser,$emailuser,$application_id,$first_expense_tranche_amount,$final_tranche_amount,$final_expense_amount,$interim_tranche_amount,$first_tranche_amount,$notify);
								}
							}
						}	




					/*	$sub='';
						$reg='';
						if($grantstatus=="approved"){

							$reg=approved($nameuser,$application_id);
							$sub='Thakur Foundation - Your application has been approved';


						}elseif($grantstatus=="deferred"){

							$reg=defferred($nameuser,$application_id);
							$sub='Thakur Foundation - Your application has been deferred';
						}elseif($grantstatus=="declined"){
							$reg=declined($nameuser,$application_id);
							$sub='Thakur Foundation - Your application has been declined';


						}
						$mail = new PHPMailer;


						//$mail->IsSMTP();                                      // Set mailer to use SMTP
						$mail->Host = 'smtp.gmail.com';                 // Specify main and backup server
						$mail->Port = 465;                                    // Set the SMTP port
						$mail->SMTPAuth = true;                               // Enable SMTP authentication
						$mail->Username = 'grants.administrator@thakur-foundation.org';                // SMTP username
						$mail->Password = 'QR-5=ZDA85^U';                  // SMTP password
						$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
						$mail->SMTPDebug=1;
						$mail->SetFrom = 'grants.administrator@thakur-foundation.org';
						$mail->AddReplyTo('grants.administrator@thakur-foundation.org', 'Thakur Foundation');
						$mail->FromName = 'Thakur Foundation';
						$mail->AddAddress($emailuser);  // Add a recipient
						//$mail->AddAddress('ellen@example.com');               // Name is optional

						$mail->IsHTML(true);                                  // Set email format to HTML

						$mail->Subject = $sub;


						$mail->Body    = $reg;

						$mail->Send();*/

					 		 echo"<script language='javascript'>
					 		 alert('Application saved successfully');

									</script>";

					 }


}else{
		 echo"<script language='javascript'>
					 		 alert('Application Id not exist');

									</script>";

}


}
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
		<?php  if (isset($_SESSION['loggedin'])==1) {?>
<div class="main_container farmer">
	<div class="form-cnt">
	<div class="form-sec">
		<form class="" id="adminform" action="#" method="post"  enctype="multipart/form-data" data-parsley-validate novalidate>

      <fieldset>
				<legend>Applicant information</legend>
        <ul class="formbx">
          <li>
            <p>Application ID </p>
            <input type="text" id="appl" name="appl_id" class="text-brd" placeholder="" autocomplete="off"/>
          </li> <!--  <a href="http://mockup.org.uk/thakur-foundation/thakurfoundation/grantinfo.php" target="_blank"><li class="text-right"><input type="button" value="View details" class="btn" /></li></a> --><br/>
          <li>
            <p>First Name </p>
            <input type="text" id="firstname"  class="text-brd" placeholder="" readonly />
          </li>
          <li>
            <p>Last Name </p>
            <input type="text" id="lastname"  class="text-brd" placeholder="" readonly />
          </li>
          <li class="dte">
            <div class="">
              <p>Receipt Date (YY/MM/DD) </p>
              <input type="text" id="datepicker" name="receipt_date" placeholder="" class="dtepick" autocomplete="off" readonly>
            </div>

            <div class="">
              <p>Review Date YY/MM/DD) </p>
              <input type="text" id="datepicker1" name="review_date" placeholder="" onfocusout="ReceiptReviewDate_validate()" class="dtepick" autocomplete="off" readonly>
            </div>
          </li>
          <li>
            <p>Mentors </p>
            <select name="mentors" id="mentors" class="text-brd" />
      						<!-- <option value="">Mentors</option> -->
      							<?php $infologgedin ="SELECT * FROM mentors";

      								$resultinfouser = $con->query($infologgedin);

      								if ($resultinfouser->num_rows > 0) {
      								    // output data of each row
      								    while($rows = $resultinfouser->fetch_assoc()) {
      											//print_r($row);
      								    	$mname = $rows["mentor_name"];
      								    	$mid = $rows["id"];
      								    	?>
      									<option value="<?php echo $mid?>"><?php echo $mname ?></option>
      								<?php }

      								}?>


      				</select>
          </li>
          <br/>
          <li>
            <p>Grant Status </p>
            <select name="grantstatus" id="grantstatus">
            	<option value="" >Select</option>
            	<?php $grantstatus ="SELECT * FROM grant_status where is_active ='1' ";

      								$grantStatusList = $con->query($grantstatus);

      								if ($grantStatusList->num_rows > 0) {

      									while($rows = $grantStatusList->fetch_assoc()) {?>
    				
    				<option value="<?php echo $rows['id'];?>"><?php echo $rows['name'];?></option>

    				<?php }

      								}?>


    				</select>
          </li>
            <li>
            <p>Project Start Date </p>
            <input type="text" name="project_start_release_date" onchange="ProjectStartDate_validate()" id="datepicker11"  class="text-brd" placeholder="" autocomplete="off" />

            </li>


        </ul>
			</fieldset>



			<fieldset>
				<legend>Grant Information</legend>
        <ul class="formbx">
          <li>
            <p>Approved Grant Amount</p>
            <input type="text" name="approve_grant_amount" id="approved_grant_amount" class="text-brd  commaseparated" placeholder="" onfocusout="ApprovedGrantAmountValidate();"/>
          </li>
          <li>
            <p>Approved Expense Amount</p>
            <input type="text"  name="approve_expense_amount" onfocusout="appexpense();" id="approved_expense_amount" class="text-brd commaseparated" placeholder="" />
          </li>
        </ul>
			</fieldset>
			<fieldset>
			<legend>First tranche</legend>
      <ul class="formbx">
        <li>
          <p>Tranche 1 - Release Date  (YY/MM/DD) </p>
          <input type="text" name="first_tranche_release_date" id="datepicker2"  onchange="FirstTrancheReleaseDate_validate()" class="text-brd" placeholder="" autocomplete="off"/><span class="focus-border" readonly></span>
          </li><br/>


		<li>
            <p>Grant Tranche 1  (INR) </p>
            <input type="text" name="first_tranche_amount" id="first_tranche_amount" class="text-brd commaseparated" onfocusout="firsttranche();" placeholder=""/><span class="focus-border"></span>
            </li>
            <li>
            	<p>Grant Tranche 1 - Paid  (Y/N) </p>
                <select  id="first_tranche_amount_paid" name="first_tranche_amount_paid" class="text-brd"/>

					<!-- <option></option> -->
					<option value="yes">Yes</option>
					<option value="no" selected>N0</option>
				</select>

              </li>

              <li>
                <p>Expense Tranche 1  (INR) </p><input type="text" name="first_expense_tranche_amount" id="first_expense_tranche_amount" onfocusout="firstexpense();" class="text-brd commaseparated" placeholder=""/><span class="focus-border"></span></li>


        <li>

				<p>Expense Tranche 1 – Paid  (Y/N) </p>
          <select   name="first_expense_tranche_paid"  id="first_expense_tranche_paid"class="text-brd">
					<!-- <option>First Expense Tranche Paid</option> -->
					<option value="yes">Yes</option>
					<option value="no" selected>No</option>
						</select>
				</li>

			</fieldset>

			<fieldset>
			<legend>Interim tranche</legend>
        <ul class="formbx">
      <li>
        <p>Projected Interim Review Date (YY/MM/DD) </p>
        <input type="text"  name="projectcted_interim_review_date" id="datepicker3" onchange="ProjectedInterimReviewDate_validate()"  class="text-brd" placeholder="" autocomplete="off" readonly />
      </li>

      <li>
        <p>Actual Interim Review Date (YY/MM/DD) </p>
        <input type="text" name="actual_interim_review_date" id="datepicker4" onchange="ActualInterimReviewDate_validate()" class="text-brd" placeholder="" autocomplete="off" readonly />
      </li>

     <li>
        <p>Grant Tranche 2 (INR) </p>
        <input type="text"  name="interim_tranche_amount" id="interim_tranche_amount" class="text-brd commaseparated" placeholder="" onfocusout="intrimtranche();"/>
      </li>

      <li>
        <p>Grant Tranche 2 – Paid (Y/N)</p>
        <select name="interim_tranche_amount_paid"  id="interim_tranche_amount_paid" class="text-brd">

  				<!-- <option></option> -->
  				<option value="yes">Yes</option>
  					<option value="no" selected>No</option>
  			</select>
      </li>


        <li>
          <p>Projected Publication Date (YY/MM/DD) </p>
          <input type="text"  name="projected_publication_date" onchange="ProjectedPublicationDate_validate()" id="datepicker5" placeholder="" autocomplete="off" readonly>
        </li>

      <li>
        <p>Actual Publication Date (YY/MM/DD) </p>
        <input type="text" id="datepicker6" name="actual_publication_date" onchange="ActualPublicationDate_validate()" placeholder="" autocomplete="off" readonly>
      </li>
    </ul>
			</fieldset>
			<fieldset>
			<legend>Final tranche</legend>
      <ul class="formbx">
      <li>
        <p>Grant Tranche 3 – Release Date (YY/MM/DD) </p>
        <input type="text" name="final_tranche_release_date" id="datepicker10" onchange="FinalTrancheReleaseDate_validate()" placeholder="" autocomplete="off" readonly >
      </li><br/>
      <li>
        <p>Grant Tranche 3  (INR) </p>
        <input type="text" name="final_tranche_amount" id="final_tranche_amount" class="text-brd commaseparated" placeholder=""  onfocusout="finaltranche();"/>
      </li>



			<!--<p><input type="text" id="datepicker7" name="final_tranche_release_date" placeholder="Final Tranche Release Date (DD/MM/YY)" ><span class="focus-border"></span> <sup>*</sup></p>-->
			<!--<p><input type="text"  class="text-brd" placeholder="Grant Status"/><span class="focus-border"></span> <sup>*</sup></p>-->
     <li>
        <p>Grant Tranche 3 – Paid (Y/N) </p>
        <select  name="final_tranche_paid" id="final_tranche_paid" class="text-brd" >
  				<!-- <option>Final tranche paid</option> -->
  				<option value="yes">Yes</option>
  				<option value="no" selected>No</option>
  			</select>
      </li>

        <li>
          <p>Expense Tranche 2 - Release Date (YY/MM/DD) </p>
          <input type="text" id="datepicker7" name="final_expense_release_date" placeholder="" autocomplete="off" >
        </li><br/>


       <li>
          <p>Expense Tranche 2 (INR) </p>
          <input type="text" name="final_expense_amount" id="final_expense_amount" class="text-brd commaseparated" placeholder="" onfocusout="finalexpense();"/>
        </li>
        <li>
          <p>Expense Tranche 2 – Paid (Y/N) </p>
          <select name="final_expense_paid"  id="final_expense_paid" class="text-brd">
    				<!-- <option>Final expense paid</option> -->
    				<option value="yes">Yes</option>
    				<option value="no" selected>No</option>
    			</select>
        </li>

			</ul>

		</fieldset>
		<fieldset>
		<legend>Project completion</legend>
      <ul class="formbx">
    <li class="">



        <p>Completion Date (YY/MM/DD) </p>
        <input type="text" name="completion_date" id="datepicker8" placeholder="" class="dtepick" autocomplete="off"
        onchange="PROJECTCOMPLETIONCompletionDate_validate()" readonly>
    </li>
    <li>

        <p>Publication  Date (YY/MM/DD) </p>
        <input type="text" name="publication_date" id="datepicker9" placeholder="" class="dtepick" autocomplete="off"
        onchange="PROJECTCOMPLETIONCompletionPublicationDate_validate()" readonly>

    </li>

    <!-- <li class="fileup">
        	<input type="file" name="impact[]" id="file-7" class="hde inputfile1"  data-multiple-caption="{count} files selected" multiple />
          <label for="upload">
            <span>Impact Upload</span><b></b>
          </label>
					<div id="filesdata"><div>


      </li> -->
      <li></li>
      <li></li>
      <li class="inpfield">
			<input type="submit" onclick="javascript:return validateform();" value="Save" name="saveforlater" class="btn " />
      <!-- <input type="submit" name="submit" value="submit" class="btn" /> -->
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
		var datepicker2 = new Pikaday({
			 field: document.getElementById('datepicker2'),
			 firstDay: 1,
				minDate: new Date(1986, 12, 31),
				 //format : "MM-DD-YYYY",
				 format : "YYYY-MM-DD",
				 defaultDate: null,
maxDate: new Date(2020, 12, 31),
				yearRange: [2000,2020]
		});
		var datepicker3 = new Pikaday({
			 field: document.getElementById('datepicker3'),
			 firstDay: 1,
				minDate: new Date(1986, 12, 31),
				 format : "YYYY-MM-DD",
maxDate: new Date(2020, 12, 31),
defaultDate: null,
				yearRange: [2000,2020]
		});
		var datepicker4 = new Pikaday({
			 field: document.getElementById('datepicker4'),
			 firstDay: 1,
				minDate: new Date(1986, 12, 31),
				 format : "YYYY-MM-DD",
maxDate: new Date(2020, 12, 31),
defaultDate: null,
				yearRange: [2000,2020]
		});
		var datepicker5 = new Pikaday({
			 field: document.getElementById('datepicker5'),
			 firstDay: 1,
				minDate: new Date(1986, 12, 31),
				format : "YYYY-MM-DD",
				maxDate: new Date(2020, 12, 31),
				defaultDate: null,
				yearRange: [2000,2020]
	 	});
		var datepicker6 = new Pikaday({
			 field: document.getElementById('datepicker6'),
			 firstDay: 1,
				minDate: new Date(1986, 12, 31),
				format : "YYYY-MM-DD",
				defaultDate: null,
				maxDate: new Date(2020, 12, 31),
				yearRange: [2000,2020]
	 	});
		var datepicker7 = new Pikaday({
			 field: document.getElementById('datepicker7'),
			 firstDay: 1,
				minDate: new Date(1986, 12, 31),
				format : "YYYY-MM-DD",
				defaultDate: null,
				maxDate: new Date(2020, 12, 31),
				yearRange: [2000,2020]
	 	});
		var datepicker8 = new Pikaday({
			 field: document.getElementById('datepicker8'),
			 firstDay: 1,
				minDate: new Date(1986, 12, 31),
				format : "YYYY-MM-DD",
				defaultDate: null,
				maxDate: new Date(2020, 12, 31),
				yearRange: [2000,2020]
	 	});
		var datepicker9 = new Pikaday({
			 field: document.getElementById('datepicker9'),
			 firstDay: 1,
				minDate: new Date(1986, 12, 31),
				format : "YYYY-MM-DD",
				defaultDate: null,
				maxDate: new Date(2020, 12, 31),
				yearRange: [2000,2020]

	 	});
	 	var datepicker10 = new Pikaday({
			 field: document.getElementById('datepicker10'),
			 firstDay: 1,
				minDate: new Date(1986, 12, 31),
				format : "YYYY-MM-DD",
				defaultDate: null,
				maxDate: new Date(2020, 12, 31),
				yearRange: [2000,2020]
	 	});
    var datepicker11 = new Pikaday({
     field: document.getElementById('datepicker11'),
     firstDay: 1,
				minDate: new Date(1986, 12, 31),
				format : "YYYY-MM-DD",
				defaultDate: null,
				maxDate: new Date(2020, 12, 31),
				yearRange: [2000,2020]
    });
	 // var picker3monthsRight = new Pikaday(
	 // {
		// 	 numberOfMonths: 3,
		// 	 mainCalendar: 'right',
		// 	 field: document.getElementById('datepicker-3months-right'),
		// 	 firstDay: 1,
		// 	 minDate: new Date(2000, 0, 1),
		// 	 maxDate: new Date(2020, 12, 31),
		// 	 yearRange: [2000, 2020]
	 //});

		</script>

</div>




<script type="text/javascript">

$('#adminform').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});


$(document).ready(function(){
$('#appl').autocomplete({
  minLength: 2,
  source:
  function(req, add){

   var search =  $('#appl').val();
   //alert(search);


   var mydata = {search:search};
   console.log(mydata);
		   $.ajax({
			url: "<?php echo $base_url?>fetch-data.php",
			dataType: 'json',
			type: 'POST',
			data: mydata,
			success:
			function(data){



     add( $.map( data.response, function( item ) {
       return {

		      label: item.label,
		      value: item.value

       }

     }));
			}
		   });

    },
	select: function(event, ui) {
   event.preventDefault();
   $('#appl').val(ui.item.label);
    var x 	= 	ui.item.value;

    $('#firstname').val('');
	$('#lastname').val('');
	$('#datepicker').val('');
	$('#datepicker1').val('');
	$('#approved_grant_amount').val('');
	$('#approved_expense_amount').val('');
	$('#datepicker2').val('');
	$('#first_tranche_amount').val('');
	$('#first_tranche_amount_paid').val('');
	$('#first_tranche_amount_paid').val('');
	$('#first_expense_tranche_amount').val('');
	$('#first_expense_tranche_paid').val('');
	$('#datepicker3').val('');
	$('#datepicker4').val('');
	$('#interim_tranche_amount').val('');
	$('#interim_tranche_amount_paid').val('');
	$('#datepicker5').val('');
	$('#datepicker6').val('');
	$('#datepicker10').val('');
	$('#final_tranche_amount').val('');
	$('#datepicker7').val('');
	$('#final_expense_amount').val('');
	$('#final_tranche_paid').val('');
	$('#final_expense_paid').val('');
	$('#grantstatus').val('');
	$('#mentors').val('');
	$('#datepicker8').val('');
	$('#datepicker9').val('');
	$('#datepicker11').val('');
   //console.log(x);
   $.ajax({
		type: "POST",
		url: "<?php echo $base_url;?>getapplinfo.php",
		data:{ id:x },
		success: function(data){
			//debugger;
			console.log(data);
			var obj = JSON.parse(data);
			console.log(obj);
			//console.log(obj["response"][0].application_id);

			$('#firstname').val(obj["imgresponse1"][0].name);
			$('#lastname').val(obj["imgresponse1"][0].lastname);
			$('#datepicker').val(obj["imgresponse1"][0].recdate);
			$('#datepicker1').val(obj["response"][0].review_date);
			$('#approved_grant_amount').val(obj["response"][0].approved_grant_amount);
			$('#approved_expense_amount').val(obj["response"][0].approved_expense_amount);
			$('#datepicker2').val(obj["response"][0].first_tranche_release_date);
			$('#first_tranche_amount').val(obj["response"][0].first_tranche_amount);
			$('#first_tranche_amount_paid').val(obj["response"][0].first_tranche_amount_paid);
			$('#first_tranche_amount_paid').val(obj["response"][0].first_tranche_amount_paid);
			$('#first_expense_tranche_amount').val(obj["response"][0].first_expense_tranche_amount);
			$('#first_expense_tranche_paid').val(obj["response"][0].first_expense_tranche_paid);
			$('#datepicker3').val(obj["response"][0].projected_interim_review_date);
			$('#datepicker4').val(obj["response"][0].actual_interim_review_date);
			$('#interim_tranche_amount').val(obj["response"][0].interim_tranche_amount);
			$('#interim_tranche_amount_paid').val(obj["response"][0].interim_tranche_amount_paid);
			$('#datepicker5').val(obj["response"][0].projected_publication_date);
			$('#datepicker6').val(obj["response"][0].actual_publication_date);
			$('#datepicker10').val(obj["response"][0].final_tranche_release_date);
			$('#final_tranche_amount').val(obj["response"][0].final_tranche_amount);
			$('#datepicker7').val(obj["response"][0].final_expense_release_date);
			$('#final_expense_amount').val(obj["response"][0].final_expense_amount);
			$('#final_tranche_paid').val(obj["response"][0].final_tranche_paid);
			$('#final_expense_paid').val(obj["response"][0].final_expense_paid);
			$('#grantstatus').val(obj["response"][0].grant_status);
			$('#mentors').val(obj["response"][0].mentor_id);
			$('#datepicker8').val(obj["response"][0].completion_date);
			$('#datepicker9').val(obj["response"][0].publication_date);
			$('#datepicker11').val(obj["response"][0].project_start_release_date);

				$.each(obj["imgresponse"], function( index, value ) {
				var imageid=obj["imgresponse"][index].imageid;
				var appid=obj["imgresponse"][index].appid;
				var text="imp_";

           var spans = '<table><tr id='+text+imageid+'><td><a href="upload/impact/'+obj["imgresponse"][index].impact+'">'+obj["imgresponse"][index].impact+'</a></td><td><button  onclick="deleteimpact('+imageid+',\''+appid+'\');"></button></td></tr></table>';
                  var a = $('<a></a>').attr("href",'upload/impact/'+obj["imgresponse"][index].impact).append(spans);
                 $('#filesdata').append(spans);
				  console.log( obj["imgresponse"][index].impact);
				});




		}
	});

	},
	focus: function(event, ui) {
   event.preventDefault();
   $('#appl').val(ui.item.label);
  } 

});



});


function deleteimpact(imageid,appid){

 var conf = confirm('Are you sure want to delete this file ?');
 if(conf){

var imageid=imageid;
var appid=appid;
//console.log(imageid);
//console.log(grantid);
  $.ajax({
            type: 'post',
            url: '<?php echo $base_url?>deleteimpact.php',
            dataType:'json',
            data: {imageid:imageid,appid:appid },
            success: function (res) {
            //console.log(res);
			alert(res.message);
            if(res.status=='1'){
				$("#imp_"+res.imageid).remove();
            }

            }
          });
return true;
}

}

</script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
<script src="http://mockup.org.uk/thakur-foundation/thakurfoundation/js/jquery.maskMoney.js"></script>
<script>

//$('.commaseparated').mask("#,##0", {reverse: true});
$(".commaseparated").maskMoney({allowZero:false, allowNegative:true, defaultZero:false});
</script>


<?php include('footer.php');?>
</body>
</html>
