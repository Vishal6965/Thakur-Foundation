<?php
require_once 'classes/thakurfoundation_config.php';
date_default_timezone_set('Asia/Kolkata');
$currentDate = date("Y-m-d");
$application_id=base64_decode($_GET['application_id']);
$project_impact = $_GET['project_impact'];
include('config.php');
$rs_result = '';
if(!empty($application_id))
{
$sql = "SELECT * from  grant_applicants_outcome where application_id='". $application_id."' ";
$rs_result = mysqli_query($con, $sql);
}
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
        <section id="project-header" class="header-parallax">
            <div class="main_container" >
                <div class="tbl">
                    <div class="serbx">
                        <h1>Work to build a society that is more... <br>
                        <span class="textbt">aware, participative, inclusive, just.</span> </h1>
                    </div>
                </div>
            </div>
	</section>

	<section class="ourser">
		<div class="container">
			<div class="title"><?php echo $project_impact;?></div>
			<ul class="project-file">
                <?php 
                    if(!empty($rs_result))
                    {
                        while($row = $rs_result->fetch_assoc()) 
                        {
                ?>
				<li>
					<span><?php echo $row['outcome_doc'];?></span>
					<a href="https://www.thakur-foundation.org/upload/grant_applicants_outcome/<?php echo $row['outcome_doc'];?>" target="_blank" class="dwn-btn" download>Download <img src="images/dwn-icon.png" alt="Download"></a>
				</li>
                <?php 
                        }
                    }
                    else
                    { ?>
                            No files found

                 <?php   } ?>

            
				<!-- <li>
					<span>File 02</span>
					<a href="#" class="dwn-btn">Download <img src="images/dwn-icon.png" alt="Download"></a>
				</li>
				<li>
					<span>File 03</span>
					<a href="#" class="dwn-btn">Download <img src="images/dwn-icon.png" alt="Download"></a>
				</li>
				<li>
					<span>File 04</span>
					<a href="#" class="dwn-btn">Download <img src="images/dwn-icon.png" alt="Download"></a>
				</li>
				<li>
					<span>File 05</span>
					<a href="#" class="dwn-btn">Download <img src="images/dwn-icon.png" alt="Download"></a>
				</li> -->
			</ul>
		</div>
    </section>

<div id="saveforlateryou" class="popup">
<div class="close saveforlater_close "><span class="rt-close cls_btn"></span></div>
    <div class="table">
      <p>
       Your application is incomplete. The information you have provided has been saved. Please complete your application through the link available in the "My Account" section of our website and submit it for review. Thank you.
      </p>
    </div>
</div>
<div id="submitgrant" class="popup">
<div class="close submitgrant_close "><span class="rt-close cls_btn"></span></div>
    <div class="table">
      <p>
         Thank you for completing your application for a grant with the Thakur Foundation. We will correspond with you at the email address you have provided once we review your application. In the meantime, you can check the status of your application via the "My Account" link on our website.
      </p>
    </div>
</div>



<?php include ('footer.php'); ?>
