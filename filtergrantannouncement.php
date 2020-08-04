<?php
session_start();
include('config.php');
$whereCondition = '';
$finalArray= [];

if(isset($_POST['year']) && $_POST['year'] !='null' && isset($_POST['grant_type']) && $_POST['grant_type'] !='null')
{
	$whereCondition = "year ='".$_POST['year']."' AND "."grant_area='".$_POST['grant_type']."'";
}
else
{
	if(isset($_POST['year']) && $_POST['year'] !='null')
	{
		$whereCondition = "year ='".$_POST['year']."'";
	}
	if(isset($_POST['grant_type']) && $_POST['grant_type'] !='null')
	{
		$whereCondition = "grant_area='".$_POST['grant_type']."'";
	}
}
//print_r($whereCondition);die;
$sql = 'Select file_path,link from banner_uploads where '. $whereCondition.' order by created_date DESC limit 0,2';
$rs_result = mysqli_query($con, $sql);
// print_r($sql);
while($row = $rs_result->fetch_assoc()) {

	$finalArray[] = $row['file_path']."|".$row['link'];
	
}
	$dataArray['imgresponse'] = $finalArray;
	
	echo json_encode($dataArray);die;	

?>