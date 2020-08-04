
<?php
//print_r($_POST);die;
session_start();
include('config.php');


if(isset($_GET['appl_id'])){
include('getautocomplete.php');
$application_id= $_GET['appl_id'];
temp($application_id);
}else{

if(isset($_POST['appl_id'])){
$application_id= $_POST['appl_id'];

}
}

//if(isset($_POST['appl_id']))  $application_id= $_POST['appl_id'];else $application_id="";
if(isset($_POST['receipt_date'])) $new_date= $_POST['receipt_date'];else $new_date="";

 $receipt_date = $new_date;

if(isset($_POST['review_date'])) $review_date1= $_POST['review_date'];else $review_date1="";

 $review_date = $review_date1;
if(isset($_POST['project_start_release_date'])) $project_start_release_date1= $_POST['project_start_release_date'];else $project_start_release_date1="";



  $project_start_release_date=$project_start_release_date1;
/*if(isset($_POST['decision'])) $decision= $_POST['decision'];else $decision="";*/
if(isset($_POST['approve_grant_amount'])) $approve_grant_amount= $_POST['approve_grant_amount'];else $approve_grant_amount="";
if(isset($_POST['approve_expense_amount']))  $approve_expense_amount= $_POST['approve_expense_amount'];else $approve_expense_amount="";
if(isset($_POST['first_tranche_release_date'])) $first_tranche_release_date1= $_POST['first_tranche_release_date'];else $first_tranche_release_date1="";

 echo $first_tranche_release_date =$first_tranche_release_date1;

if(isset($_POST['first_tranche_amount'])) $first_tranche_amount= $_POST['first_tranche_amount'];else $first_tranche_amount="";
if(isset($_POST['first_expense_tranche_amount'])) $first_expense_tranche_amount= $_POST['first_expense_tranche_amount'];else $first_expense_tranche_amount="";
if(isset($_POST['first_tranche_amount_paid'])) $first_tranche_amount_paid= $_POST['first_tranche_amount_paid'];else $first_tranche_amount_paid="";
if(isset($_POST['first_expense_tranche_paid'])) $first_expense_tranche_paid= $_POST['first_expense_tranche_paid'];else $first_expense_tranche_paid="";
if(isset($_POST['projectcted_interim_review_date'])) $projected_interim_review_date1= $_POST['projectcted_interim_review_date'];else $projected_interim_review_date1="";

$projected_interim_review_date = $projected_interim_review_date1;

if(isset($_POST['actual_interim_review_date'])) $actual_interim_review_date1= $_POST['actual_interim_review_date'];else $actual_interim_review_date1="";

$actual_interim_review_date = $actual_interim_review_date1;

if(isset($_POST['interim_tranche_amount'])) $interim_tranche_amount= $_POST['interim_tranche_amount'];else $interim_tranche_amount="";
if(isset($_POST['interim_tranche_amount_paid'])) $interim_tranche_amount_paid= $_POST['interim_tranche_amount_paid'];else $interim_tranche_amount_paid="";
if(isset($_POST['projected_publication_date'])) $projected_publication_date1= $_POST['projected_publication_date'];else $projected_publication_date1="";

$projected_publication_date = $projected_publication_date1;

if(isset($_POST['actual_publication_date'])) $actual_publication_date1= $_POST['actual_publication_date'];else $actual_publication_date1="";
 $actual_publication_date = $actual_publication_date1;


if(isset($_POST['final_tranche_release_date'])) $final_tranche_release_date1= $_POST['final_tranche_release_date'];else $final_tranche_release_date1="";
$final_tranche_release_date = $actual_publication_date1;
if(isset($_POST['final_tranche_paid'])) $final_tranche_paid= $_POST['final_tranche_paid'];else $final_tranche_paid="";
if(isset($_POST['final_expense_paid'])) $final_expense_paid= $_POST['final_expense_paid'];else $final_expense_paid="";
if(isset($_POST['grantstatus'])) $grantstatus= $_POST['grantstatus'];else $grantstatus="";
if(isset($_POST['mentors']))   $mentors=  $_POST['mentors'] ;else $mentors="";
if(isset($_POST['completion_date'])) $completion_date1= $_POST['completion_date'];else $completion_date1="";

$completion_date = $completion_date1;
if(isset($_POST['publication_date'])) $publication_date1= $_POST['publication_date'];else $publication_date1="";
$publication_date = $publication_date1;



if(isset($_POST['final_expense_release_date'])) $final_expense_release_date1= $_POST['final_expense_release_date'];else $final_expense_release_date1="";
$final_expense_release_date = $final_expense_release_date1;

if(isset($_POST['final_expense_amount'])) $final_expense_amount= $_POST['final_expense_amount'];else $final_expense_amount="";
if(isset($_POST['final_tranche_amount'])) $final_tranche_amount= $_POST['final_tranche_amount'];else $final_tranche_amount="";
$data=array();
$seluser = "SELECT * FROM admin where application_id='".$application_id."' ";
//$seluser = "SELECT * FROM grants_applicants  where id= '4' ";
$result = $con->query($seluser);
 $result->num_rows;

if (!empty($result) && $result->num_rows > 0) {

							

							  $sqlinsert = "UPDATE `admin` SET  `receipt_date`='$receipt_date',
							  `review_date` = '$review_date',
							  `project_start_date` = '$project_start_release_date',

							  `approved_grant_amount` = '$approve_grant_amount' ,
							  `approved_expense_amount`='$approve_expense_amount',
							  `first_tranche_release_date` = '$first_tranche_release_date' ,
							  `first_tranche_amount` = '$first_tranche_amount' ,
							  `first_expense_tranche_amount` = '$first_expense_tranche_amount' ,
							  `first_tranche_amount_paid`='$first_tranche_amount_paid' ,
							  `first_expense_tranche_paid`='$first_expense_tranche_paid' ,

								`projected_interim_review_date` = '$projected_interim_review_date' ,
								`actual_interim_review_date` = '$actual_interim_review_date' ,
								`interim_tranche_amount` = '$interim_tranche_amount' ,
								`interim_tranche_amount_paid` = '$interim_tranche_amount_paid' ,
								 `projected_publication_date` = '$projected_publication_date',
								 `actual_publication_date` = '$actual_publication_date',
								 `final_tranche_release_date` = '$final_tranche_release_date',
								 `final_tranche_amount` = '$final_tranche_amount',
								 `final_expense_release_date` = '$final_expense_release_date',
								 `final_expense_amount` = '$final_expense_amount',
								 `final_tranche_paid` = '$final_tranche_paid',
								 `final_expense_paid` = '$final_expense_paid',
								 `grant_status` = '$grantstatus',
								 `mentor_id` = '$mentors',
								 `completion_date` = '$completion_date',
								 `publication_date` = '$publication_date',
								 `saveforlater` = '1'
							  where  application_id='".$application_id."' ";

							 
			if(isset($_FILES['impact']) && !empty($_FILES['impact'])){
					//print_r($_FILES);die;
						$targetDir = "upload/impact/";
						    $allowTypes = array('pdf','mp4','mp3','flv');

						    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
						    if(!empty(array_filter($_FILES['impact']['name']))){
						        foreach($_FILES['impact']['name'] as $key=>$val){
						            // File upload path
						            $fileName = basename($_FILES['impact']['name'][$key]);
						            $targetFilePath = $targetDir . $fileName;
						            $totalFileSize = array_sum($_FILES['impact']['size']);
						            $maxFileSize = 25 * 1024 * 1024 ;
						            // Check whether file type is valid
						            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

						            if(in_array($fileType, $allowTypes)){

											if ($totalFileSize < $maxFileSize) {
									    $data['message']= 'Your files exceed the limit of 100MB capacity';

						                // Upload file to server
						                move_uploaded_file($_FILES["impact"]["tmp_name"][$key], $targetFilePath);
						                      $port ="INSERT INTO impact (application_id,impact)
																		VALUES ('".$_POST['appl_id']."','".$fileName."')";

																				$con->query($port) === TRUE;




						               } else{

						               	$data['message']= "Please select  Total impact size upto 25MB";
						               }
						            }else{
						                 $data['message']= "Please select impact only pdf,mp4,mp3 type.";
						            }
						        }

						}


					}

if ($con->query($sqlinsert) === TRUE || $con->query($port) === TRUE) {
	
 $data["message"]="Application saved Successfully.";



}






}else{
$flag=0;
$seluser1 = "SELECT application_id FROM grants_applicants where complete='1' ";
//$seluser = "SELECT * FROM grants_applicants  where id= '4' ";
$result1 = $con->query($seluser1);
$storeArray = Array();
if (!empty($result1) && $result1->num_rows > 0) {
 while($rows = $result1->fetch_array()) {
 	$storeArray[] =  $rows['application_id'];

}}

//print_r($storeArray);
if (in_array($application_id, $storeArray)) {

 $sqlinsert = "INSERT INTO admin (application_id,
 receipt_date,
 review_date,
	project_start_date,
 approved_grant_amount,
 approved_expense_amount,
 first_tranche_release_date,
 first_tranche_amount,
 first_expense_tranche_amount,
 first_tranche_amount_paid,
 first_expense_tranche_paid,
 projected_interim_review_date,
 actual_interim_review_date,
 interim_tranche_amount,
 interim_tranche_amount_paid,
 projected_publication_date,
 actual_publication_date,
 final_tranche_release_date,
 final_tranche_amount,
 final_expense_release_date,
 final_expense_amount,
 final_tranche_paid,
 final_expense_paid,
 grant_status,
 mentor_id,
 completion_date,
 publication_date,
 saveforlater)
VALUES ('".$application_id."',
'".$receipt_date."',
'".$review_date."',
'".$project_start_release_date."',

'".$approve_grant_amount."',
'".$approve_expense_amount."',
'".$first_tranche_release_date."',
'".$first_tranche_amount."',
'".$first_expense_tranche_amount."',
'".$first_tranche_amount_paid."',
'".$first_expense_tranche_paid ."',
'".$projected_interim_review_date ."',
'".$actual_interim_review_date."',
'".$interim_tranche_amount."',
'". $interim_tranche_amount_paid ."',
'".$projected_publication_date."',
'".$actual_publication_date."',
'".$final_tranche_release_date."',
'".$final_tranche_amount."',
'".$final_expense_release_date."',
'".$final_expense_amount."',
'".$final_tranche_paid."',
'".$final_expense_paid."',
'".$grantstatus."',
'".$mentors."',
'".$completion_date."',
'".$publication_date."','1')";
$con->query($sqlinsert);
$flag=1;

if(isset($_FILES['impact']) && !empty($_FILES['impact'])){

						$targetDir = "upload/impact/";
						    $allowTypes = array('pdf','mp4','mp3','flv');
						    $impactflag=0;
						    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
						    if(!empty(array_filter($_FILES['impact']['name']))){
						        foreach($_FILES['impact']['name'] as $key=>$val){
						            // File upload path
						            $fileName = basename($_FILES['impact']['name'][$key]);
						            $targetFilePath = $targetDir . $fileName;
						            $totalFileSize = array_sum($_FILES['impact']['size']);
						            $maxFileSize = 25 * 1024 * 1024 ;
						            // Check whether file type is valid
						            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

						            if(in_array($fileType, $allowTypes)){

											if ($totalFileSize < $maxFileSize) {
									    $output= 'Your files exceed the limit of 100MB capacity';

						                // Upload file to server
						                move_uploaded_file($_FILES["impact"]["tmp_name"][$key], $targetFilePath);
						                      $port ="INSERT INTO impact (application_id,impact)
																		VALUES ('".$_POST['appl_id']."','".$fileName."')";

													$con->query($port);
													 $impactflag=1;




						               } else{

						               	$data['message']= "Please select  Total impact size upto 25MB";
						               }
						            }else{
						                $data['message']= "Please select impact only pdf,mp4,mp3 type.";
						            }
						        }

						}
					}

if ($flag==1 ||  $impactflag == 1) {

 $data['message']="Application saved Successfully.";


}
}
}
echo json_encode($data);