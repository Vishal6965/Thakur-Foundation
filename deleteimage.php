<?php 

include('config.php');

//echo 'imageid'.$_REQUEST['imageid'];

$imageid=$_REQUEST['imageid'];

$grantid=$_REQUEST['grantid'];

$data=array();

//echo 'grantid'.$_REQUEST['grantid'];

if(isset($imageid) && isset($grantid)){





 $sql = "UPDATE `portfolio` SET `deleted`='1'  where user_id='".$grantid."' AND id='".$imageid."'";

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