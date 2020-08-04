<?php
include('config.php');

$target_dir = "upload/docs/"; // Upload directory


$request = 1;
if(isset($_POST['request'])){ 
  $request = $_POST['request'];
}
$userId = $_POST['user_id'];
$applicationId = $_POST['application_id'];


// Upload file
if($request == 1){ 
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  $msg = ""; 
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES['file']['name'])) {
  	$fileName = $_FILES['file']['name'];
  	$filePath = $target_dir.$_FILES['file']['name'];
	$currentDate = date("Y-m-d H:i:s");
  	$sqlinsert = "INSERT INTO grant_doc_applications (user_id,application_id,file_name,file_path,file_size,file_type,created)
												VALUES ('".$userId."','".$applicationId."','".$fileName."','".$filePath."','50kb','jpg','".$currentDate."')";
												
												if ($con->query($sqlinsert)) {
												}

  	//print_r(filesize($target_dir.$_FILES['file']['name']));die;
    $msg = "Successfully uploaded"; 
  }else{    
    $msg = "Error while uploading"; 
  } 
  echo $msg;
  exit;
}

// Remove file
if($request == 2){ 
  $filename = $target_dir.$_POST['name'];  
  unlink($filename); 
  exit;
}

?>