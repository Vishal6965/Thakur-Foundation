<?php 
/*echo $_REQUEST['mentorid'];*/
include('config.php');
if(!empty($_REQUEST['mentorid'])){

$sql = "UPDATE `user_register` SET `deleted`='1' where id='".$_REQUEST['mentorid']."' "; 

              if($con->query($sql) === TRUE){



                $data['message']="Deleted Successfully";
                $data['status'] =1;
                $data['mentorid']=$_REQUEST['mentorid'];

  			}else{
				  $data['message']="Something went wrong";
                  $data['status'] =0;
				}
}
echo json_encode($data);

?>