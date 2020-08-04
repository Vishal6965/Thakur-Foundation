<?php 
include('config.php');
$data=array();
if(!empty($_POST['newPass']) && !empty($_POST['oldPass']) && !empty($_POST['confPass'])){
$pwdlengthp=trim($_POST['newPass']);
$pwdlength=strlen($_POST['newPass']);
$cpwdlengthc=trim($_POST['confPass']);
$cpwdlength=strlen($_POST['confPass']);
//$number    = preg_match('@[A-Za-z0-9]@',$_POST['newPass']);
	if($pwdlength >= 6 && $cpwdlength >=6){
 
	if(md5($_POST['newPass']) == md5($_POST['confPass']) ){

		$info ="SELECT password from user_register where password='".md5($_POST['oldPass'])."' ";
		$resultinfo = $con->query($info);

		$resultinfo->num_rows;
		if ($resultinfo->num_rows == 1) {
			$einfo ="UPDATE user_register SET password = '".md5($_POST['newPass'])."', cpassword = '".md5($_POST['confPass'])."' where id='".$_POST['user']."' ";
			if ($con->query($einfo) === TRUE) {

				$data['message']="Password update successfully.";
				$data['flag'] = 1;
			}

		}else{

			$data['message']="Please enter valid old password which has been sent on your mail";
			$data['flag'] = 0;
		}


	}else{

		$data['message']="New password and confirm password does not match";
			$data['flag'] = 0;
		
	}
}else{

		$data['message']="Passwords should be at least 6 characters long in alphanumeric ";
			$data['flag'] = 0;
			
		
	}
}
else
{
	$data['message']="Please fill all fields";
	$data['flag'] = 0;
}

echo json_encode($data);

?>