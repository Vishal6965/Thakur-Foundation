<?php
session_start();
include('config.php');
//include('header.php');

if(isset($_SESSION['admin'])){
 $admin = $_SESSION['admin'];}
$limit 	= 10;
$where_condition=[];
$totalLimit=0;
$data1='';

if(!empty($_POST['app_id'])){

	$app_id=$_POST['app_id'];
	$inserted =["g.application_id='". $app_id."'"];
	$where_condition = array_merge($where_condition,$inserted);
}
if(!empty($_POST['grant_type'])){
	//print_r("hoo");
	$granttype=$_POST['grant_type'];

	if($granttype == 'all')
	{
		$getTypeId = "SELECT id from area_of_interest";
		$result = mysqli_query($con, $getTypeId);
		while($getId[]=$result->fetch_assoc())
		
			$finalArray = array_column($getId, 'id');
			$finalArray = implode(",",$finalArray);
		
		$inserted =["g.interest IN (".$finalArray.")"];
		
	}
	else
	{
		$inserted =["g.interest='".$granttype."'"];
	}
	$where_condition = array_merge($where_condition,$inserted);
}
if(!empty($_POST['grant_status'])){
	$grantstatus=$_POST['grant_status'];
	if($grantstatus == 'all')
	{
		$getStatusId = "SELECT id from grant_status";
		$result = mysqli_query($con, $getStatusId);
		while($getId[]=$result->fetch_assoc())
		
		$finalArray = array_column($getId, 'id');
		$finalArray = implode(",",$finalArray);
		
		$inserted =["ad.grant_status IN (".$finalArray.")"];
		
	}
	else
	{		
		$inserted =["ad.grant_status='".$grantstatus."'"];
	}
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
$data1 = implode(" and ", $where_condition);

if (isset($_POST["page"])) {  $page  =(int)$_POST["page"]; } else { $page=1; }

	$start_from = ($page-1) * $limit;
	if(!empty($data1))
	{
		$sql = "SELECT g.id as id,g.application_id as application_id ,a.area_of_interest as grant_type,gs.name as grant_status,g.created_date as created_date,ur.name as username,ur.lastname as lname from grants_applicants g INNER JOIN user_register ur on ur.id=g.user_id INNER JOIN area_of_interest a on g.interest=a.id INNER JOIN admin ad on g.application_id=ad.application_id INNER JOIN grant_status gs on ad.grant_status=gs.id where g.complete='1' and $data1 ORDER BY g.id DESC LIMIT $start_from, $limit";
	}
	else
	{
		$sql = "SELECT g.id as id,g.application_id as application_id ,a.area_of_interest as grant_type,gs.name as grant_status,g.created_date as created_date,ur.name as username,ur.lastname as lname from grants_applicants g INNER JOIN user_register ur on ur.id=g.user_id INNER JOIN area_of_interest a on g.interest=a.id INNER JOIN admin ad on g.application_id=ad.application_id INNER JOIN grant_status gs on ad.grant_status=gs.id where g.complete='1' ORDER BY g.id DESC LIMIT $start_from, $limit";
	}

$result = mysqli_query($con, $sql);
//print_r($result);die;
$totalLimit = $page * $limit;
		$count = $totalLimit - $limit;
		if (!empty($result) && $result->num_rows > 0) {
			$data = '';
			while($row = $result->fetch_assoc()) {
				
				$count=$count+1;
				
				$token=base64_encode($row["application_id"]);
					$data .='<div class="tr">';
					$data .='<div class="td dte">'. date("Y-m-d",strtotime($row["created_date"])).'</div>';
					$data .='<div class="td appid"><a href="https://www.thakur-foundation.org/grantapplicantdetails.php?token='.$token.' " target="_blank">'.$row["application_id"].'</a></div>';
					$data .='<div class="td fname">'.$row["username"].'</div>';
					$data .='<div class="td lname">'.$row["lname"].'</div>';	

					$data .='<div class="td grntyp">'.$row["grant_type"].'</div>';
					$data .='<div class="td grantsts">'.$row["grant_status"].'</div>';	

					$data .='<div class="td edit"><a class="btn" target="_blank" href="https://www.thakur-foundation.org/form.php?appl_id='.base64_encode($row["application_id"]).'"><span><img src="images/edit-pencil.png"></span>Edit</a></div>';
					$data .='<div class="td email"><div class="td upfnl"><a href="#" class="btn up_fnlOut_open" data-fname="'.$row['username'].'" data-lname="'.$row['lname'].'" data-grandtype="'.$row['grant_type'].'" data-id="'.$row["application_id"].'"><span><img src="images/email.png"></span>Assign Advisor</a></div></div>';
					$data .='</div>';

					$data .= "<script>
$('.up_fnlOut_open').click(function(){
		
	var appid 	  =	$(this).attr('data-id');
	var fname 	  =	$(this).attr('data-fname');
	var lname 	  =	$(this).attr('data-lname');
	var grandtype = $(this).attr('data-grandtype');

	console.log(fname);
	$('.appid').val(appid);
	$('.fname').val(fname);
	$('.lname').val(lname);
	$('.grandtype').val(grandtype);
})
</script>";
				
			  $count++; }}
			  echo json_encode($data);die;
?>
