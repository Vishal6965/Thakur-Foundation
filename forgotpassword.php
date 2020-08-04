<?php
include('config.php'); 
 
require('class.smtp.php');
require('class.phpmailer.php');
require ('PHPMailerAutoload.php');
require('registrationtemp.php');
if($_POST['femail']){

		$email=$_POST['femail'];
		$info ="SELECT name,id,email from user_register where email='".$email."' ";
		$resultinfo = $con->query($info);
	
         $resultinfo->num_rows;
			if ($resultinfo->num_rows == 1) {
				
				$newpassword=substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0 ,8);
				$data['newpassword']=$newpassword;
				$einfo ="UPDATE user_register SET password = '".md5($newpassword)."', cpassword = '".md5($newpassword)."' where email='".$email."' ";
					//$eresultinfo = $con->query($einfo);
						while($row = $resultinfo->fetch_assoc()) {

					 		$name=$row['name'];
					 		$id=$row['id'];
					 		$newuserid=base64_encode($id);
					 	}


						if ($con->query($einfo) === TRUE) {

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

						$mail->Subject = 'Password Reset';
						//$body = ''
						$resetBody = resetpasswordmail($name,$newpassword,$newuserid);
						$mail->Body    = $resetBody;
						// "Dear ".$name.",<br/>
						// We have reset your password, since you clicked on 'Forgot Password' and requested for a new password.<br/>


						// Your new password is  <b>$newpassword</b>. Please <a href='https://thakur-foundation.org'>login</a> with this password and change the password by clicking on
						// <a href='https://thakur-foundation.org/reset-password.php?token=".$newuserid." '>change your password</a> link
						// <br/><br/><br/> Regards,<br/>Team Thakur Foundation" ;
						//$mail->AltBody    = $_POST['cname'].' '.$_POST['cemail'];
						//$mail->MsgHTML($body);


						//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

						$mail->Send();
						$data['status'] =1;
							}
						}else{
								$data['status'] =0;

			}
}
echo json_encode($data);


?>