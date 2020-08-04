<?php 
session_start();
include('config.php');

require('class.smtp.php');
require('class.phpmailer.php');
require ('PHPMailerAutoload.php');
require ('registrationtemp.php');

function get_browser_name($user_agent)
{
    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
    elseif (strpos($user_agent, 'Edge')) return 'Edge';
    elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
    elseif (strpos($user_agent, 'Safari')) return 'Safari';
    elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
    elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
    
    return 'Other';
}

function getUserIpAddr()
{
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

//echo "leena";
if(!empty($_POST)){

	$dada=array();
	if(!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['mobile']) && !empty($_POST['password']) && !empty($_POST['cpassword'])){
				if($_POST['password']== $_POST['cpassword']){

						$firstname=$_POST['fname'];
						$lastname1=$_POST['lname'];
						//$words = explode(" ", $name);

						/*$firstname = $words[0];
						if(isset($words[1])){$lastname1 = $words[1];}else{$lastname1="";}
						//$lastname1 = $words[1];
						if(isset($words[2])){$lastname = $words[2];}*/
						
						$email=$_POST['email'];
						$mobile=$_POST['mobile'];
						$password=md5($_POST['password']);
						$cpassword=md5($_POST['cpassword']);
						//$gender=$_POST['gender'];
						

			$info ="SELECT email from user_register where email='".$_POST['email']."'";
			$resultinfo = $con->query($info);

			if ($resultinfo->num_rows > 0) {
				while($row = $resultinfo->fetch_assoc()) {
				     if($email==$row['email']){

					 $data['message'] ="We already have a valid registered account with this email address. ";


				}
			}


			}else{


				$sql = "INSERT INTO user_register (name,lastname,email,mobile,password,cpassword)
				VALUES ('".$firstname."','".$lastname1."', '".$email."','".$mobile."','".$password."','".$cpassword."')";

				if ($con->query($sql) === TRUE) {
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

						$mail->Subject = 'Thakur Foundation - Thank you for your interest in applying for a grant';
						//$body = ''
						$reg=registration($firstname,$email);
						$mail->Body    =$reg ;
						//$mail->AltBody    = $_POST['cname'].' '.$_POST['cemail'];
						//$mail->MsgHTML($body);


						//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

						$mail->Send();

								
				//$data['message'] ="Registered Successfully";
				$last_id = $con->insert_id;
				 $_SESSION['loggedin']=true;
				 $_SESSION['user_id'] = $last_id;
				$loginPlatform = get_browser_name($_SERVER['HTTP_USER_AGENT']);
				$loginIpAddress = getUserIpAddr();
				$sql = "INSERT INTO platform_details (user_id,name,platform,ip_address)
													VALUES ('".$last_id."','".$firstname."','".$loginPlatform."','".$loginIpAddress."')";

				$con->query($sql) === TRUE;
				 if(!empty($firstname)){

							$_SESSION['username']=$firstname;
							 $_SESSION['admin'] = 0;
							 $data['message']="Registered Successfully";
							 $data['userId']= $last_id;

						}else{

							$_SESSION['username']=false;
							


						}

								

		} else {
				     $data['message']=  $con->error;
				}
				}





		}else{

			 $data['message'] ='Dose not match the password';





		}
}else{

		 $data['message']="Please fill all fields";

}



}
echo json_encode($data);

?>