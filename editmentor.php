<?php
session_start();
include('config.php');
//print_r($_POST);
$mentorid=$_POST['mentorid'];
if(!empty($mentorid)){
$sqlquery = "SELECT * from user_register where id='".$mentorid."' and role='2' ";

					$result = mysqli_query($con, $sqlquery);

					if (!empty($result) && $result->num_rows > 0) {

							while($row = $result->fetch_assoc()){

								$data['response'][]=array('id'=>$row['id'],'fname'=>$row['name'],'lname'=>$row['lastname'],'email'=>$row['email'],'password'=>$row['password'],'cpassword'=>$row['cpassword'],'role'=>$row['role']);
						}

					}
					echo json_encode($data);
}

?>