<?php
session_start();
include('config.php');
$finalArray = [];  
$sql = "SELECT CONCAT(ur.name,' ',ur.lastname) as username,(DATE_FORMAT(g.created_date,'%Y')) as year,ac.country_name as region,a.area_of_interest as grant_area,ad.project_impact_statement as impact_area,g.application_id as application_id  from grants_applicants g INNER JOIN user_register ur on ur.id=g.user_id INNER JOIN apps_countries ac on ac.country_code = g.nationality INNER JOIN area_of_interest a on g.interest=a.id INNER JOIN admin ad on g.application_id=ad.application_id INNER JOIN grant_status gs on ad.grant_status=gs.id where g.complete='1' AND ad.project_impact_statement != '' ORDER BY g.created_date DESC";
$rs_result = mysqli_query($con, $sql);
while($row = $rs_result->fetch_assoc()) {

	$finalArray[] = $row;
	
}
	$dataArray['data'] = $finalArray;
	
	echo json_encode($dataArray);die;	

?>