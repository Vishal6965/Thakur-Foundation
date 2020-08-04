<?php 
include('config.php');
require('class.smtp.php');
require('class.phpmailer.php');
require ('PHPMailerAutoload.php');

//print_r($_POST);
$data=array();
if(!empty($_POST['cname']) && !empty($_POST['cphone']) && !empty($_POST['cemail']) || !empty($_POST['reason']) ){

						//echo "leena";
	$name=$_POST['cname'];
	$lname=$_POST['clname'];
	$email=$_POST['cemail'];
	$mobile=$_POST['cphone'];
	$reason=$_POST['reason'];
	$status=$_POST['status'];

						//$gender=$_POST['gender'];
	$sql = "INSERT INTO contact (firstname,lastname,phone,email,reason)
	VALUES ('".$name."', '".$lname."','".$mobile."','".$email."', '".$reason."')";
				//$con->query($sql) === TRUE;

	if ($con->query($sql) === TRUE) {



		$mail = new PHPMailer;
			$mail->CharSet='UTF-8';
			

						//$mail->IsSMTP();                                      // Set mailer to use SMTP
						$mail->Host = 'smtp.gmail.com';                 // Specify main and backup server
						$mail->Port = 465;                                    // Set the SMTP port
						$mail->SMTPAuth = true;                               // Enable SMTP authentication
						$mail->Username = 'grants.administrator@thakur-foundation.org';                // SMTP username
						$mail->Password = 'QR-5=ZDA85^U';                  // SMTP password
						$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
						$mail->SMTPDebug=1;
						$mail->SetFrom = 'grants.administrator@thakur-foundation.org';
						$mail->FromName = 'Thakur Foundation';
						//$mail->AddAddress('leena.g@logicserve.com');  // Add a recipient
						$mail->AddAddress('information@thakur-foundation.org');  // Add a recipient
						//$mail->AddAddress('ellen@example.com');               // Name is optional

						$mail->IsHTML(true);                                  // Set email format to HTML

						$mail->Subject = 'Contact from website';
						//$body = ''
						$a=$name;
						$e=$lname;
						$b=$email; 
						$c=$mobile;
						$d=$reason;
						$mail->Body    = "<table border='1'>
											<tr>
											<td>Firstname:</td>
											<td>".$a."</td>
											</tr>
											<tr>
											<td>Lastname:</td>
											<td>".$e."</td>
											</tr>
											<tr>
											<td>Mobile:</td>
											<td>".$c."</td>
											</tr>
											<tr>
											<td>Email:</td>
											<td>".$email."</td>
											</tr>
											<tr>
											<td>Reason:</td>
											<td>".$d."</td>
											</tr>
										</table>";
						

						if(!$mail->Send()) {
							$data['error']= 'Message could not be sent.';
							//echo 'Mailer Error: ' . $mail->ErrorInfo;

						}else{
							$data['message'] ="Thank you for contacting us.We will reach you soon.";
						 	$data['status'] =$status;

						}

						


					} else {
						$data['error']=  $con->error;
						$data['status'] =0;
					}
				}else{

					$data['error']="Please fill all fields";
				}

				echo json_encode($data);

				?>