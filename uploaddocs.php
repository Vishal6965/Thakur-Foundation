<?php
session_start();
include('config.php');
require('class.smtp.php');
require('class.phpmailer.php');
require ('PHPMailerAutoload.php');
if(isset($_SESSION['user_id'])){
	 $user_id=$_SESSION['user_id'] ;
	 $username = $_SESSION['username'];
	 $email = $_SESSION['email'];

}else{

	$user_id="";
}
//echo $_POST['appid'];die;
$data=array(); 
$filenameArray = [];
//print_r($_FILES);die;

if($_POST['grant_doc']==0){
	$totalFile = $_POST['filecount'];
    $isPortfolio = $_POST['is_portfolio'];
//if(!empty($_FILES["portfolio-file"]["tmp_name"]))
if($isPortfolio > 0 &&  $_FILES['portfolio-file'] != '' )
{
		for($i = 0; $i < $totalFile; $i++)
        {
        	$_FILES['portfolio-file'] = $_FILES['file-'.$i];
        	if($_FILES["portfolio-file"]["name"][$i] != '')
            {
						$targetDir = "upload/grant_applicants/";
						    $allowTypes = array('jpg','pdf','mp4','mp3','flv');
							//$i=0;
							$flagdoc=0;
					    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
						    //if(!empty(array_filter($_FILES['portfolio-file']['name']))){
					       // foreach($_FILES['portfolio-file']['name'] as $key=>$val){
					            // File upload path
					    $max_file_size = 26214400; // 25mb
               			
               			$ext = strtolower(pathinfo($_FILES['portfolio-file']['name'], PATHINFO_EXTENSION));
		                if($_FILES['portfolio-file']['size'] < $max_file_size )
		                {
		                	if (in_array($ext, $allowTypes))
                    		{
			                	$fileName = time().'_'.$_FILES["portfolio-file"]["name"];
			                	$file_path = "upload/grant_applicants/";
	                        
		                        $file_path = $file_path.basename($fileName);
		                        
		                        if( move_uploaded_file($_FILES['portfolio-file']['tmp_name'], $file_path)){

							           //   $i =$i+1;
							           //  $time = time() + $i;
							           //  $fileName = $time.basename($_FILES['portfolio-file']['name'][$key]);
							           //  //$fileName = time().basename($_FILES['portfolio']['name'][$key]);
							           //  $targetFilePath = $targetDir . $fileName;
						            // $totalFileSize = array_sum($_FILES['portfolio-file']['size']);
						            // $maxFileSize = 25 * 1024 * 1024 ;
						            // // Check whether file type is valid
						            // $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
						            $filenameArray[] = $fileName;
						              
							                //if(move_uploaded_file($_FILES["portfolio-file"]["tmp_name"][$key], $targetFilePath)){
						                $port = "INSERT INTO grant_applicants_docs (user_id,application_id,doc)
																		VALUES ('".$user_id."','".$_POST['appid']."','".$fileName."')";

																				$con->query($port) === TRUE;
																				$flagdoc=1;
																			}
							}
							else
							{
								$data['message'] = 'Document is not in proper format';
								echo json_encode($data);die;
							}


					}
					else
					{
						$data['message']="Size of the Portfolio Document is large";
						echo json_encode($data);die;
					}
				//}
				//}
			}
		}
		$documents = '';
		foreach ($filenameArray as $value) {
			$documents .= '<br><span style="color: #db5c55; text-decoration: none;"><a style="color: #db5c55; text-decoration: none;" target="_blank" href="https://www.thakur-foundation.org/upload/grant_applicants/'.$value.'">'.$value.'</a></span>';
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
		$mail->AddAddress($email);  // Add a recipient
		//$mail->AddAddress('ellen@example.com');               // Name is optional

		$mail->IsHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Thakur Foundation - Grant Documents Upload';
		$mail->Body    ='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title> Applicant Grant Documents Upload</title>
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
   *{padding: 0;margin: 0}
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
	 
    /* ANDROID CENTER FIX */

</style>
</head>

<body style="padding:0;margin:0;">
 <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
            (Optional) This text will appear in the inbox preview, but not the email body.
        </div>
        <!-- Visually Hidden Preheader Text : END -->


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
            			  <td height="30" style="line-height: 22px;font-size: 14px;color: #000">Dear '.$username.',</td></tr>
            			<tr><td height="15" style="line-height: 15px;font-size: 0"></td></tr>
            			<tr>
            			  <td style="line-height: 24px;font-size: 14px;color: #000 !important;">
            			This is a notification that the following documents were uploaded by you in support of the approved grant application to the Foundation.<br>
                        '.$documents.'
            			 
            			</td></tr>
                        
                        <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>
                        <tr><td height="20" style="line-height: 24px;font-size: 14px;color:#000">Thank you for promptly providing us these documents to enable us to proceed with processing your grant payment. We will review these documents and let you know if any further information/action is needed from you. </td></tr>
                        <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>
                        <tr><td height="20" style="line-height: 24px;font-size: 14px;color:#000"> 
Should you have any questions, you can write to <br><a href="mailto:grants.administrator@thakur-foundation.org" style="color: #db5c55; text-decoration: none;">grants.administrator@thakur-foundation.org</a></td></tr>
                        
            			<tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>
                        
                        <tr><td height="20" style="line-height: 22px;font-size: 14px;color: #000 !important"> 
Grant Application ID: <a style="color: #db5c55; text-decoration: none;" href="https://thakur-foundation.org/application-details.php?token='.base64_encode($_POST['appid']).' "><span style="color: #db5c55; text-decoration: none;"> '.$_POST['appid'].'</span></a><br>
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
					 	<a href="https://www.thakur-foundation.org/" style="color: #db5c55; text-decoration: none;">www.thakur-foundation.org</a>
            		
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
</html>
';
$mail->Send();

$adminMail = 'grants.administrator@thakur-foundation.org';
$adminmail = new PHPMailer;
$adminmail->Host = 'smtp.gmail.com';                 // Specify main and backup server
		$adminmail->Port = 465;                                    // Set the SMTP port
		$adminmail->SMTPAuth = true;                               // Enable SMTP authentication
		$adminmail->Username = 'grants.administrator@thakur-foundation.org';                // SMTP username
		$adminmail->Password = 'QR-5=ZDA85^U';                  // SMTP password
		$adminmail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
		$adminmail->SMTPDebug=1;
		$adminmail->SetFrom = 'grants.administrator@thakur-foundation.org';
		$adminmail->AddReplyTo('grants.administrator@thakur-foundation.org', 'Thakur Foundation');
		$adminmail->FromName = 'Thakur Foundation';
		$adminmail->AddAddress($adminMail);  // Add a recipient
		//$mail->AddAddress('ellen@example.com');               // Name is optional

		$adminmail->IsHTML(true);                                  // Set email format to HTML

		$adminmail->Subject = 'Thakur Foundation - Grant Documents Upload';
		$adminmail->Body    = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Administrator Grant Documents Upload</title>
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
        *{padding: 0;margin: 0}
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
	 
    /* ANDROID CENTER FIX */

</style>
</head>

<body style="padding:0;margin:0;">
 <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
            (Optional) This text will appear in the inbox preview, but not the email body.
        </div>
        <!-- Visually Hidden Preheader Text : END -->


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
            			  <td height="30" style="line-height: 22px;font-size: 14px;color: #000">Dear Grants Administrator,</td></tr>
            			<tr><td height="15" style="line-height: 15px;font-size: 0"></td></tr>
            			<tr>
            			  <td style="line-height: 24px;font-size: 14px;color: #000">
            			The following documents were uploaded in support of the<br> Grant Application ID: <a style="color: #db5c55; text-decoration: none;" href="https://thakur-foundation.org/application-details.php?token='.base64_encode($_POST['appid']).' "><span style="color: #db5c55; text-decoration: none;"> '.$_POST['appid'].'</span></a><br>  
                        '.$documents.'
            			</td></tr>
                        
                        <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>
                        <tr><td height="20" style="line-height: 24px;font-size: 14px;color:#000">Thank you for promptly providing us these documents to enable us to proceed with processing your grant payment. We will review these documents and let you know if any further information/action is needed from you. </td></tr>
                        <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>
                        <tr><td height="20" style="line-height: 24px;font-size: 14px;color:#000"> 
Should you have any questions, you can write to <br><a href="mailto:grants.administrator@thakur-foundation.org" style="color: #db5c55; text-decoration: none;">grants.administrator@thakur-foundation.org</a></td></tr>
                        
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
					 	<a href="https://www.thakur-foundation.org/" style="color: #db5c55; text-decoration: none;">www.thakur-foundation.org</a>
            		
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
</html>
';
$adminmail->Send();

	}else{

	$data['message']="Select file";
	}
}else{

	$totalFile = $_POST['filecount'];
    $isOutcome = $_POST['is_outcome'];

	// if(!empty($_FILES["outcome_file"]["tmp_name"])){

    if($isOutcome > 0 &&  $_FILES['outcome_file'] != '' ){
    	for($i = 0; $i < $totalFile; $i++)
        {

    		$_FILES['outcome_file'] = $_FILES['file-'.$i];
        	if($_FILES["outcome_file"]["name"][$i] != '')
            {
            	$targetDir = "upload/grant_applicants_outcome/";
			    $allowTypes = array('jpg','pdf','mp4','mp3','flv');
							
				$flagdoc=0;
			    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
						    //if(!empty(array_filter($_FILES['portfolio-file']['name']))){
					       // foreach($_FILES['portfolio-file']['name'] as $key=>$val){
					            // File upload path
			    $max_file_size = 26214400; // 25mb
               	$ext = strtolower(pathinfo($_FILES['outcome_file']['name'], PATHINFO_EXTENSION));
               	

		                if($_FILES['outcome_file']['size'] < $max_file_size )
		                {
		                	if (in_array($ext, $allowTypes))
                    		{
			                	$fileName = time().'_'.$_FILES["outcome_file"]["name"];
			                	$file_path = "upload/grant_applicants_outcome/";
	                        
		                        $file_path = $file_path.basename($fileName);
		                        
		                        if( move_uploaded_file($_FILES['outcome_file']['tmp_name'], $file_path)){
		                        	$port1 = "INSERT INTO grant_applicants_outcome (user_id,application_id,outcome_doc)
	 																VALUES ('".$user_id."','".$_POST['appid']."','".$fileName."')";

																			$con->query($port1) === TRUE;
																			$flagdoc=1;
																			}
							}
							else
							{
								$data['message'] = 'Project Impact Document is not in proper format';
								echo json_encode($data);die;
							}


						}
						else
						{
							$data['message']="Size of the Project Impact Document is large";
							echo json_encode($data);die;
						}
			}
		}





	// 					$targetDir = "upload/grant_applicants_outcome/";
	// 					    $allowTypes = array('jpg','pdf','mp4','mp3','flv');
	// 						$i=0;
	// 						$flagdoc=0;
	// 				    	$statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
	// 					    if(!empty(array_filter($_FILES['outcome_file']['name']))){
	// 				        foreach($_FILES['outcome_file']['name'] as $key=>$val){
	// 				            // File upload path
	// 					             $i =$i+1;
	// 					            $time = time() + $i;
	// 					            $fileName = $time.basename($_FILES['outcome_file']['name'][$key]);
	// 					            //$fileName = time().basename($_FILES['portfolio']['name'][$key]);
	// 					            $targetFilePath = $targetDir . $fileName;
	// 				            $totalFileSize = array_sum($_FILES['outcome_file']['size']);
	// 				            $maxFileSize = 25 * 1024 * 1024 ;
	// 				            // Check whether file type is valid
	// 				            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
	// 				            if(move_uploaded_file($_FILES["outcome_file"]["tmp_name"][$key], $targetFilePath)){
	// 				                      $port1 = "INSERT INTO grant_applicants_outcome (user_id,application_id,outcome_doc)
	// 																VALUES ('".$user_id."','".$_POST['appid']."','".$fileName."')";

	// 																		$con->query($port1) === TRUE;
	// 																		$flagdoc=1;

	// 		}
	// 	}
	// }
}else{

	$data['message']="Select file";
}


}
if($flagdoc==1){

$data['message']="Documents uploaded successfully";

}else{

$data['message']="Uploading error";

}
echo json_encode($data);
?>