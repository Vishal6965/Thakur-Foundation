<?php
session_start();
include('config.php');
//include('header.php');

if(isset($_SESSION['admin'])){
 $admin = $_SESSION['admin'];}
$limit 	= 5;
$totalLimit=0;
$data='';
//$page  = $_POST['page'];
if (isset($_POST["page"])) {  $page  =(int)$_POST["page"]; } else { $page=1; }
$start_from = ($page-1) * $limit;
 $sql = "SELECT * from user_register  where role='2' and deleted='0' LIMIT $start_from, $limit";

$result = mysqli_query($con, $sql);
$totalLimit = $page * $limit;
		$count = $totalLimit - $limit;
		if (!empty($result) && $result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				//print_r($row);die;
				$count=$count+1;
					$data .='<div class="tr" id="mentor_id_'.$row['id'].'">';
					// $data .='<div class="td srno name">'.$count.'</div>';
					$data .='<div class="td fname">'.$row['name'].'</div>';
					$data .='<div class="td lname">'.$row['lastname'].'</div>';
					$data .='<div class="td emailid">'.$row['email'].'</div>';					
					$data .='<div class="td edit"><a href="#"  onclick="editmentor('.$row['id'].')"  class="btn"><span><img src="images/edit-pencil.png"></span>Edit</a><a href="#" onclick="deletementor('.$row['id'].')" class="btn"><span><img src="images/delete.png"></span>Delete</a></div></div>';
			  $count++; }}
			  echo json_encode($data);die;
?>