<?php

include "config.php";

$data = array();

if(isset($_POST['id'])){

  $search = $_POST['id'];

  $imgquery = "SELECT * from impact where application_id='". $search."' AND deleted='0' ";
  //print_r($imgquery);
  $resultimg = mysqli_query($con,$imgquery); 

  while($rows = mysqli_fetch_array($resultimg) ){ 

//print_r($rows);

     $data['imgresponse'][]= array("impact"=>$rows['impact'],'imageid'=>$rows['id'],'appid'=>$rows['application_id']);

  }

  $imgquery1 = "SELECT ga.created_date,ur.email,ur.name,ur.lastname,a.grant_status from user_register ur INNER JOIN grants_applicants ga on ga.user_id=ur.id LEFT JOIN admin a on a.application_id = ga.application_id where ga.application_id='".$search."' ";

  $resultimg1 = mysqli_query($con,$imgquery1);

  while($rows1 = mysqli_fetch_array($resultimg1) ){

//print_r($rows1);die;

     $data['imgresponse1'][]= array("name"=>$rows1['name'],"lastname"=>$rows1['lastname'],"recdate"=>date('Y-m-d',strtotime($rows1['created_date'])),"grant_status" => $rows1['grant_status']);

  }
 //$query = "SELECT a.*,m.mentor_name,m.id as mentor_id  FROM admin a LEFT JOIN  mentors m ON m.id= a.mentor_id WHERE a.application_id like'%".$search."%' AND a.saveforlater='1'";

  $query = "SELECT um.id as mentor_id,um.name as mentorname, ur.id as userid,ur.name,ur.lastname,ga.*, a.* FROM admin a  LEFT JOIN grants_applicants ga on ga.application_id=a.application_id LEFT JOIN user_register ur on ga.user_id=ur.id LEFT JOIN user_register um on a.mentor_id=um.id WHERE a.application_id like'%".$search."%' AND a.submit='1'";
  //echo $query;
  $result = mysqli_query($con,$query);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
  while($row = mysqli_fetch_array($result) ){
   //print_r($row);die;
   $data['response'][]= array("application_id"=>$row['application_id'],

   	"receipt_date"=>$row['receipt_date'],

    "project_impact_statement" => $row['project_impact_statement'],

      "review_date"=>$row['review_date'],

      "project_start_release_date"=>$row['project_start_date'],

      "approved_grant_amount"=>$row['approved_grant_amount'],

      "approved_expense_amount"=>$row['approved_expense_amount'],

      "first_tranche_release_date"=>$row['first_tranche_release_date'],

      "first_tranche_amount"=>$row['first_tranche_amount'],

      "first_tranche_amount_paid"=>$row['first_tranche_amount_paid'],

      "first_expense_tranche_amount"=>$row['first_expense_tranche_amount'],

      "first_expense_tranche_paid"=>$row['first_expense_tranche_paid'],

      "projected_interim_review_date"=>$row['projected_interim_review_date'],

      "actual_interim_review_date"=>$row['actual_interim_review_date'],

      "interim_tranche_amount"=>$row['interim_tranche_amount'],

      "interim_tranche_amount_paid"=>$row['interim_tranche_amount_paid'],

      "projected_publication_date"=>$row['projected_publication_date'],

      "actual_publication_date"=>$row['actual_publication_date'],

      "final_tranche_release_date"=>$row['final_tranche_release_date'],

      "final_tranche_amount"=>$row['final_tranche_amount'],

      "final_expense_release_date"=>$row['final_expense_release_date'],

      "final_expense_amount"=>$row['final_expense_amount'],

      "final_tranche_paid"=>$row['final_tranche_paid'],

      "final_expense_paid"=>$row['final_expense_paid'],

      "grant_status"=>$row['grant_status'],

      "mentor_id"=>$row['mentor_id'],

      "project_impact_statement"=>$row['project_impact_statement'],
      
      "completion_date"=>$row['completion_date'],

      "publication_date"=>$row['publication_date'],

      "mentors"=>$row['mentorname']

      //"fname"=>$row['name'],

   	//"lname"=>$row['lastname']

   	//"impact"=>$row['impact']


      );

}

echo json_encode($data);

}

?>