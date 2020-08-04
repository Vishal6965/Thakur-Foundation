<?php 
include('config.php');
require('class.smtp.php');
require('class.phpmailer.php');
require ('PHPMailerAutoload.php');
$data=array();
//print_r($_POST);die;
if(!empty($_POST))
{
	$appid  = $_POST['aapid'];
	$userid = $_POST['user_id'];
	$advisoryid = $_POST['advisory_id'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$grandtype = $_POST['grandtype'];
	$arr=array();
	$finalArray = array();
	//print_r($advisoryid);die;
	$implodestring = implode(',',$advisoryid );
	$info ="SELECT  name,email from user_register where id IN($implodestring) ";
	$resultinfo = $con->query($info);
	$web_url = "https://www.thakur-foundation.org/";
	if ($resultinfo->num_rows > 0) {
		while($row  = $resultinfo->fetch_assoc()) {
					  //$arr[]= $row['email'];
			$advisoryname[]= $row['name'];
					  //$arr['name']= $row['name'];

			$arr[] = ['name' =>$row['name'],'email' => $row['email'] ];

		}}
 //print_r($finalArray);die;
 //print_r($arr['name']);
			//$customemail=implode(',',$email);
		$flag=0;	
		$date=date('Y-m-d');
		for ($i = 0; $i < count($advisoryid); $i++) {
			$aid=$_POST['advisory_id'][$i];

			$sql = "INSERT INTO assign_grant_mentors (application_id,fname,lname,mentor_id,assigned_date,assign_by,is_reviwed,reviewed_date)
			VALUES ('".$appid."','".$fname."','".$lname."','".$aid."', '".$date."','".$userid."','0',NULL)";

			$con->query($sql) === TRUE;
			$flag=1;
		}

		if($flag==1){
			foreach($arr as $newmail){  

				$mail = new PHPMailer;   

						//print_r($newmail) ;die;                             // Set mailer to use SMTP
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
						
						$mail->AddAddress($newmail['email']);

						$mail->IsHTML(true); 

						$mail->Subject = 'Review application '.$appid.' for applicant '.$fname.' '.$lname.'';
						
						$mail->Body    ='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
						<html>
						<head>
						<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
						<title>Your application has been approved</title>
						<meta name="viewport" content="width=device-width">
						<meta http-equiv="X-UA-Compatible" content="IE=edge">
						<meta name="x-apple-disable-message-reformatting">
						<link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
						<!--[if mso]>
						<style>
						* {font-family:Arial, sans-serif !important;}
						</style>
						<![endif]-->
						<style type="text/css">
						/* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
						html,
						body {
							margin: 0 auto !important;
							padding: 0 !important;
							height: 100% !important;
							width: 100% !important;
							font-family:Raleway, Arial, Tahoma, Segoe;
							font-size: 14px;
							font-weight: 600;
							background: #e4e0e1;
						}

						/* What it does: Stops email clients resizing small text. */
        * {
						-ms-text-size-adjust: 100%;
						-webkit-text-size-adjust: 100%;
					}
					/* iOS BLUE LINKS */
					a[x-apple-data-detectors] {
						color: inherit !important;
						text-decoration: none !important;
						font-size: inherit !important;
						font-family: inherit !important;
						font-weight: inherit !important;
						line-height: inherit !important;
					}
					table,
					td {
						mso-table-lspace: 0pt !important;
						mso-table-rspace: 0pt !important;
					}

					/* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
					table {
						border-spacing: 0 !important;
						border-collapse: collapse !important;
						table-layout: fixed !important;
						margin: 0 auto !important;
					}
					/* MOBILE STYLES */
					@media screen and (max-width: 600px) {

						/* ALLOWS FOR FLUID TABLES */
						.wrapper {
							width: 100% !important;
							max-width: 100% !important;

						}

						/* ADJUSTS LAYOUT OF LOGO IMAGE */
						.logo img {
							margin: 0 auto !important;
						}

						.img-max {
							max-width: 100% !important;
							width: 100% !important;
							height: auto !important;
						}



					}
					@media only screen and (min-device-width: 375px) and (max-device-width: 413px) { /* iPhone 6 and 6+ */
						.wrapper {
							min-width: 375px !important;
						}
					}
					/* ANDROID CENTER FIX */

					</style>
					</head>

					<body style="padding:0;margin:0;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tbody>
					<tr>
					<td scope="col">
					<table style="margin:auto; mso-line-height-rule: exactly;background: #fff;" width="600" class="wrapper" cellpadding="0" cellspacing="0">
					<tbody>           
					<tr>
					<th scope="col" height="20" valign="top">
					<img src="https://thakur-foundation.org/newsletter-images/top-bar.jpg" alt="" />
					</th>
					</tr>
					<tr>
					<td style="background: #231f20;padding: 20px 0 20px 20px" bgcolor="#231f20"><img src="https://thakur-foundation.org/newsletter-images/logo.png" alt="" /></td>
					</tr>
					<tr>
					<td align="center" valign="top">
					<table width="550" cellpadding="0" cellspacing="0">
					<tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>
					<tr>
					<td height="30" style="line-height: 22px;font-size: 14px;color: #000">Dear '.$newmail['name'].',</td></tr>
					<tr><td height="15" style="line-height: 15px;font-size: 0"></td></tr>
					<tr>
					<td style="line-height: 24px;font-size: 14px;color: #000">
					We have received applications for this round of grants in <b>'.$grandtype.'</b>.<br>
					Request you to please review this application <a href="'.$web_url.'grantapplicantdetails.php?token='.base64_encode($appid).'" style="color: #db5c55; text-decoration: none;">'.$appid.'</a>.<br>
					</td></tr>				   

					<tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

					<tr><td style="line-height: 22px;font-size: 14px;color: #000">Sincerely, <br>Thakur Foundation</td></tr>
					<tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>

					</table>
					</td>
					</tr>
					<tr>
					<td align="center" valign="top" style="background:#f1f1f1;">
					<table width="550" cellpadding="0" cellspacing="0">
					<tr><td height="15" style="line-height: 15px;font-size: 0"></td></tr>
					<tr><td style="line-height:13px;font-size:11px;color: #231f20">
					This e-mail communication and any attachments may be privileged and confidential to Thakur Family Foundation, Inc and are intended only for the use of the recipients named above. If you are not the intended recipient, please do not review, disclose, disseminate, distribute or copy this e-mail and its attachments. If you have received this email in error, please delete this message along with all its attachments and notify us immediately at <a href="mailto:support@thakur-foundation.org" style="color: #db5c55; text-decoration: none;">support@thakur-foundation.org</a>. <br> Thank you.<br><br>

					Thakur Family Foundation, Inc<br>
					100 1st Ave North, Ste 3603
					St Petersburg, FL 33701<br>
					+1.727.471.7453<br>
					<a href="https://thakur-foundation.org/" style="color: #db5c55; text-decoration: none;">www.thakur-foundation.org</a>

					</td></tr>
					<tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

					</table>
					</td>
					</tr>
					<tr>
					<td height="40" style="background: #f1f1f1;font-size: 12px;color: #000;" valign="middle" align="center">Copyright &copy; 2019 - All Right Reserved</td>
					</tr>
					</tbody>
					</table>

					</td>
					</tr>
					</tbody>
					</table>

					</body>
					</html>';

					$mail->Send();
				}
				$data['msg']="Application has been assigned for reviewing";

			}

		}
		echo json_encode($data);
		?>


