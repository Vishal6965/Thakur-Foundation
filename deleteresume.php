<?php 

include('config.php');

//echo 'imageid'.$_REQUEST['imageid'];

$userid=$_REQUEST['userid'];

$grantid=$_REQUEST['grantid'];

$data=array();

//echo 'grantid'.$_REQUEST['grantid'];

if(isset($userid) && isset($grantid)){





 $sql = "UPDATE `grants_applicants` SET `resume`=''  where  id='".$grantid."' AND user_id='".$userid."'";

              if($con->query($sql) === TRUE){



                $data['message']="Deleted Successfully";
                $data['status'] =1;
                $data['grantid']=$grantid;





              }else{



                   $data['message']="something went wrong";
                    $data['status'] =0;



              }





}

echo json_encode($data);

?>