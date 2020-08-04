<?php
session_start();
if(isset($_SESSION['user_id'])){
	 $user_id=$_SESSION['user_id'] ;
}else{

	$user_id="";
}
include('config.php');

$limit =5;
$totalLimit = 0;
$data = '';
$granttype = '';
if (isset($_POST["page"])) {  $page  =(int)$_POST["page"]; } else { $page=1; }
if (isset($_POST["sort"])) {  $sortby  =$_POST["sort"]; } else { $sortby='DESC'; }
//print_r($sortby);die;
$start_from = ($page-1) * $limit;
$sql = "SELECT  gs.id as grant_id,gs.name as statusname, a.grant_status, ga.*,ur.name as username,ur.lastname as lname,ur.mobile as primarynumber from grants_applicants ga LEFT JOIN user_register ur on ur.id=ga.user_id LEFT JOIN admin a on a.application_id=ga.application_id LEFT JOIN grant_status gs on gs.id=a.grant_status  where ga.user_id=$user_id  ORDER BY ga.created_date $sortby  LIMIT $start_from, $limit";
$result = mysqli_query($con, $sql);
//print_r($result );die;
		$totalLimit = $page * $limit;
		$count = $totalLimit - $limit;
		if (!empty($result) && $result->num_rows > 0) {
						$count=$count + 1;
						while($row = $result->fetch_assoc()) {
							// print_r($row );
							$area='';
						$data .= '<div class="tr">

								<div class="td dte">'.$count.'</div>
								<div class="td dte">'.date("Y-m-d",strtotime($row['created_date'])).'</div>
								<div class="td appid">'.$row['application_id'].'</div>';
								
							if(!empty($row['interest'])){
									$sql11 = "SELECT area_of_interest FROM `area_of_interest` Where id='".$row['interest']."' ";
								$rs_result2 = mysqli_query($con, $sql11);
								while($rows = $rs_result2->fetch_assoc()) {
									$area=$rows['area_of_interest'];

								}

							}
								
								


							$base_url='https://www.thakur-foundation.org/';
							$data .='<div class="td grntyp">'.$area.'</div>';
								
								if($row['incomplete']=='1'){
								$data .= '<div class="td grantsts"><center>NA</center></div>';
								}elseif(($row['complete']=='1') && !empty($row['statusname'])){
								$data .='<div class="td grants"><center>'.ucfirst($row['statusname']).'</center></div>';

								}else{
								$data .='<div class="td grants"><center>Submitted</center></div>';
								 }	

								if($row['incomplete']=='1'){ 
									$data .='<div class="td appdtl"><center><a href="'.$base_url.'grant.php" class="btn">Application details</a><center></div>';
								}else{
									$data .='<div class="td appdtl"><center><a href="'.$base_url.'application-details.php?token='.base64_encode($row['application_id']).'" class="btn">Application details</a><center></div>';
								 }

								if($row['grant_id']==9){
								$data .='<div class="td uplgrtdoc"><center><a href="#" class="btn up_grApp_open" data-id="'. $row['application_id'].'"><span><img src="images/upload-icon.png" alt=""></span>Upload docs</a></center></div>';
							 }else{
								$data .='<div class="td uplgrtdoc"><span><center>--</center></span></div>';
							}
							if($row['grant_id']==9){
								$data .='<div class="td upfnl"><center><a href="#" class="btn up_fnlOut_open" data-id="'.$row['application_id'].'"><span><img src="images/upload-icon.png" alt=""></span>Upload docs</a></center></div>';
							 }else{
								$data .='<div class="td upfnl"><center>--</center></div>';

							 } 
							$data .='</div>';
							$count++;} }else{
								echo "No records found";
							}

							$data .= '<input type="hidden" id="pageno" name="pageno" value="'.$page.'" />
							<input type="hidden" id="sortText" name="sortText" value="'.$sortby.'" />';		

							$data .= '<script>
												$(".up_grApp_open").click(function(){
													
													$(".dshpbg #portfoliofileList tr").remove();
													$(".dshpbg #uploadedFiles").text("Select Files");
													$(".dshpbg #portfolio-file").val("");
													var appid=$(this).attr("data-id");
													$("#appid").val(appid);
											});

												$(".up_fnlOut_open").click(function(){
												$(".dshpbg #outcomefileList tr").remove();
												$(".dshpbg #uploadedOutcomeFiles").text("Select Files");
												$(".dshpbg #outcome-file").val("");	
												var appid_outcome=$(this).attr("data-id");
												$("#appid_outcome").val(appid_outcome);
											});	
										</script>';	

echo json_encode($data);die;
?>