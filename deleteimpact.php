<?php 

include('config.php');

//echo 'imageid'.$_REQUEST['imageid'];

$imageid=$_REQUEST['imageid'];

$appid=$_REQUEST['appid'];

$data=array();

//echo 'grantid'.$_REQUEST['grantid'];

if(isset($imageid) && isset($appid)){

$sql = "UPDATE `impact` SET `deleted`='1'  where id='".$imageid."' AND application_id='".$appid."'";

              if($con->query($sql) === TRUE){
              	
				 $data['message']="Deleted Successfully";
				 $data['status']=1;

                $data['imageid']=$imageid;
				}else{
				$data['message']="something went wrong";
				 $data['status']=0;

				}

}

echo json_encode($data);

?>