<?php 
include('config.php');
require('class.smtp.php');
require('class.phpmailer.php');
require ('PHPMailerAutoload.php');
require ('subscribedtemp.php');

//print_r($_POST);
$data=array();
	if(!empty($_POST['semail']) ){
				
				$email=$_POST['semail'];
				$sql = "INSERT INTO subscribedmail (mail_id)
				VALUES ('".$email."')";
				//$con->query($sql) === TRUE;
				
				if ($con->query($sql) === TRUE) {
								
						$mail = new PHPMailer;
						$mail->CharSet='UTF-8';
						$mail->Encoding='base64';

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

						$mail->Subject = 'Thakur Foundation - Thank you for registering your interest.';
						//$body = ''
						$reg=subcribedtemp($email);
						$mail->Body    =$reg ;
						//$mail->AltBody    = $_POST['cname'].' '.$_POST['cemail'];
						//$mail->MsgHTML($body);

						//print_r($mail->Body);die;
						//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

						$mail->Send();
						$data['status'] =1;

		} else {
				     $data['message']=  $con->error;
				     $data['status'] =0;
				}
	}else{

		 $data['message']="Please fill email fields";
}

echo json_encode($data);

?>


