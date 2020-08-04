<?php
include('config.php'); 
$where_condition=[];

if(isset($_POST['serach'])){
	//print_r($_POST);die;
// if(!empty($_POST['app_id'])){

// 	$app_id=$_POST['app_id'];
// 	$inserted .="g.application_id='". $app_id."' ";
// 	//$where_condition = array_merge($where_condition,$inserted);
// }
// if(!empty($_POST['grant_type'])){
// 	//print_r("hoo");
// 	$granttype=$_POST['grant_type'];
// 	$inserted .="g.interest='".$granttype."' ";
// 	//$where_condition = array_merge($where_condition,$inserted);
// }
// if(!empty($_POST['grant_status'])){

// 	$grantstatus=$_POST['grant_status'];
// 	$inserted .="ad.grant_status='".$grantstatus."' ";
// 	//$where_condition = array_merge($where_condition,$inserted);

// }
// if(!empty($_POST['start_date'])){

// 	$start_date=$_POST['start_date'];
// 	$inserted .="g.created_date >='".$start_date."' ";
// 	//$where_condition = array_merge($where_condition,$inserted);

// }
// if(!empty($_POST['end_date'])){

// 	$end_date=$_POST['end_date'];
// 	$inserted .="g.created_date <='".$end_date."'";
// 	//$where_condition = array_merge($where_condition,$inserted);

// }


if(!empty($_POST['app_id'])){

	$app_id=$_POST['app_id'];
	$inserted =["g.application_id='". $app_id."'"];
	$where_condition = array_merge($where_condition,$inserted);
}
if(!empty($_POST['grant_type'])){
	//print_r("hoo");
	$granttype=$_POST['grant_type'];
	$inserted =["g.interest='".$granttype."'"];
	$where_condition = array_merge($where_condition,$inserted);
}
if(!empty($_POST['grant_status'])){

	$grantstatus=$_POST['grant_status'];
	$inserted =["ad.grant_status='".$grantstatus."'"];
	$where_condition = array_merge($where_condition,$inserted);

}
if(!empty($_POST['start_date'])){

	$start_date=$_POST['start_date'];
	$inserted =["g.created_date >='".$start_date."'"];
	$where_condition = array_merge($where_condition,$inserted);

}
if(!empty($_POST['end_date'])){

	$end_date=$_POST['end_date'];
	$inserted =["g.created_date <='".$end_date."'"];
	$where_condition = array_merge($where_condition,$inserted);

}
$data = implode(" and ", $where_condition);
//print_r($data);die;
//echo $query="select * from grants_applicants g where $where_condition";
 echo $query="select g.application_id, u.name as Firstname,u.lastname as Lastname,a.area_of_interest as Grant_type,gs.name as Grant_status from grants_applicants g LEFT JOIN user_register u on g.user_id=u.id LEFT JOIN area_of_interest a on g.interest=a.id LEFT JOIN admin ad on g.application_id=ad.application_id LEFT JOIN grant_status gs on ad.grant_status=gs.id where $data ";
		$rs_result = mysqli_query($con, $query);
		if (!empty($rs_result) && $rs_result->num_rows > 0) {
		while($rows = $rs_result->fetch_assoc()) {
		print_r($rows);
		}}}
?>