<?php

include "config.php";

if(isset($_POST['search'])){
 $search = $_POST['search'];
 //echo json_encode($search);exit;

 $query = "SELECT * FROM grants_applicants WHERE application_id like'%".$search."%' AND complete='1' ORDER BY id desc";
 $result = mysqli_query($con,$query);

 $data = array();
 while($row = mysqli_fetch_array($result) ){
   $data['response'][]= array("value"=>$row['application_id'],"label"=>$row['application_id']);
 }

 echo json_encode($data);
}

exit;