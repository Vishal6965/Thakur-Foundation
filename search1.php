<?php
include('config.php');
//$selectedinterest = array();
ini_set('display_errors','1');
$selectedyear     =   $_POST['year'];
$selectedinterest   = $_POST['interest'];
$selectedquery  = $_POST['query'];
$condition ="";
$output = '';
$type= '';
$headers = array();
date_default_timezone_set('Asia/Kolkata'); 
  $queryname='';
if(!empty($selectedyear) && !empty($selectedinterest) && !empty($selectedquery))
{
  if($selectedinterest == 'all')
  {
      $queryname='ALL';
      $selectedinterest = "1,2,3,4";
  }

  if($selectedyear == 'all')
  {
    $distinctQuery = "select distinct(DATE_FORMAT(created_date,'%Y')) as year from grants_applicants";
    $rs_result_year = mysqli_query($con, $distinctQuery);

    if (!empty($rs_result_year) && $rs_result_year->num_rows > 0) {
          while($row[] = $rs_result_year->fetch_assoc()) 
           
            $finalArray = array_column($row, 'year');

            $selectedyear = implode(",",$finalArray);
            
        }
  }

    if($selectedquery == '1')
    {
        $queryname='Committed Grants Amount';
         $condition .="select   year(g.created_date) as SubmittedYear, g.application_id as GrantId,i.area_of_interest as Area,a.approved_grant_amount as Amount from grants_applicants g INNER JOIN admin a on g.application_id = a.application_id INNER JOIN area_of_interest i on i.id = g.interest where year(g.created_date) IN ($selectedyear) and g.interest IN($selectedinterest) and g.complete = '1'";
      $type = 'Grant';
    }
    elseif($selectedquery == '2')
    {
      $queryname='Committed Expense Amount';
      $condition .="select year(g.created_date) as SubmittedYear, g.application_id as GrantId,i.area_of_interest as Area,a.approved_expense_amount as Amount from grants_applicants g INNER JOIN admin a on g.application_id = a.application_id INNER JOIN area_of_interest i on i.id = g.interest where year(g.created_date) IN ($selectedyear) and g.interest IN($selectedinterest) and g.complete = '1'";
      $type = 'Expense';
    }
    elseif($selectedquery == '3')
    {
      $queryname='Dispensed Grant Amount';
      // $condition .="select  year(g.created_date) as SubmittedYear, g.application_id as GrantId,i.area_of_interest as Area,(REPLACE(a.first_tranche_amount,',','') + REPLACE(a.interim_tranche_amount,',','') + REPLACE(a.final_tranche_amount,',','')) as Amount from grants_applicants g INNER JOIN admin a on g.application_id = a.application_id INNER JOIN area_of_interest i on i.id = g.interest where year(g.created_date) IN ($selectedyear) and g.interest IN($selectedinterest) and g.complete = '1'";

      $condition .="select  year(g.created_date) as SubmittedYear, g.application_id as GrantId,i.area_of_interest as Area,(if(a.first_tranche_amount_paid='yes',REPLACE(a.first_tranche_amount,',',''), 0 )+if(a.interim_tranche_amount_paid = 'yes' ,REPLACE(a.interim_tranche_amount,',','') , 0 )+if(a.final_tranche_paid = 'yes' ,REPLACE(a.final_tranche_amount,',','') , 0 )) as Amount from grants_applicants g INNER JOIN admin a on g.application_id = a.application_id INNER JOIN area_of_interest i on i.id = g.interest where year(g.created_date) ='$selectedyear' and g.interest IN($selectedinterest) and g.complete = '1'";

      $type = 'Grant';
    }
    elseif($selectedquery == '4')
    {
      $queryname='Dispensed Expense Amount';
      // $condition .="select year(g.created_date) as SubmittedYear, g.application_id as GrantId,i.area_of_interest as Area,(REPLACE(a.first_expense_tranche_amount,',','') + REPLACE(a.final_expense_amount,',','')) as Amount  from grants_applicants g INNER JOIN admin a on g.application_id = a.application_id INNER JOIN area_of_interest i on i.id = g.interest where year(g.created_date) IN ($selectedyear) and g.interest IN($selectedinterest) and g.complete = '1'";

      $condition .="select year(g.created_date) as SubmittedYear, g.application_id as GrantId,i.area_of_interest as Area,(if(a.first_expense_tranche_paid='yes',REPLACE(a.first_expense_tranche_amount,',',''), 0 )+if(a.final_expense_paid = 'yes' ,REPLACE(a.final_expense_amount,',','') , 0 )) as Amount from grants_applicants g INNER JOIN admin a on g.application_id = a.application_id INNER JOIN area_of_interest i on i.id = g.interest where year(g.created_date) ='$selectedyear' and g.interest IN($selectedinterest) and g.complete = '1'";
      $type = 'Expense';
    }
    elseif($selectedquery == '5')
    {
      $queryname='Committed Total Amount ';
    $condition .="select  year(g.created_date) as SubmittedYear, g.application_id as GrantId,i.area_of_interest as Area,(REPLACE(a.approved_grant_amount,',','') + REPLACE(a.approved_expense_amount,',','')) as Amount from grants_applicants g INNER JOIN admin a on g.application_id = a.application_id INNER JOIN area_of_interest i on i.id = g.interest where year(g.created_date) IN ($selectedyear) and g.interest IN($selectedinterest) and g.complete = '1'";
    }
    elseif($selectedquery == '6')
    {
      $queryname='Dispensed Total Amount';

      $condition .="select  year(g.created_date) as SubmittedYear, g.application_id as GrantId,i.area_of_interest as Area,(if(a.first_tranche_amount_paid='yes',REPLACE(a.first_tranche_amount,',',''), 0 )+if(a.interim_tranche_amount_paid = 'yes' ,REPLACE(a.interim_tranche_amount,',','') , 0 )+if(a.final_tranche_paid = 'yes' ,REPLACE(a.final_tranche_amount,',','') , 0 )+if(a.first_expense_tranche_paid='yes',REPLACE(a.first_expense_tranche_amount,',',''), 0 )+if(a.final_expense_paid = 'yes' ,REPLACE(a.final_expense_amount,',','') , 0 )) as Amount from grants_applicants g INNER JOIN admin a on g.application_id = a.application_id INNER JOIN area_of_interest i on i.id = g.interest where year(g.created_date) ='$selectedyear' and g.interest IN($selectedinterest) and g.complete = '1'";

    // $condition .="select  year(g.created_date) as SubmittedYear, g.application_id as GrantId,i.area_of_interest as Area,(REPLACE(a.first_tranche_amount,',','') + REPLACE(a.interim_tranche_amount,',','') + REPLACE(a.final_tranche_amount,',','') + REPLACE(a.first_expense_tranche_amount,',','') + REPLACE(a.final_expense_amount,',','')) as Amount  from grants_applicants g INNER JOIN admin a on g.application_id = a.application_id INNER JOIN area_of_interest i on i.id = g.interest where year(g.created_date) IN ($selectedyear) and g.interest IN($selectedinterest) and g.complete = '1'";
    }
    else
    {
    // $condition .="select CONCAT(u.name,' ',u.lastname) as AdvisoryName, a.application_id as GrantId, a.assigned_date as AssignedDate,i.area_of_interest as Area,a.reviewed_date as ReviewedDate from assign_grant_mentors a INNER JOIN user_register u on a.mentor_id = u.id INNER JOIN grants_applicants g on g.application_id = a.application_id INNER JOIN area_of_interest i on i.id = g.interest where year(a.assigned_date) ='$selectedyear' and g.interest IN($selectedinterest) and g.complete = '1' and a.is_reviwed=1";
     
    $condition .="select  a.application_id as GrantId,a.fname as FirstName,a.lname as LastName, CONCAT(u.name,' ',u.lastname) as AdvisoryName, a.assigned_date as AssignedDate,date(a.reviewed_date) as ReviewedDate from assign_grant_mentors a INNER JOIN user_register u on a.mentor_id = u.id INNER JOIN grants_applicants g on g.application_id = a.application_id  where year(a.assigned_date) IN ($selectedyear) and g.complete = '1' ";
    }
    //print_r($condition);die;
    $results = mysqli_query($con, $condition);

    //print_r($results);die;
    if (!empty($results) && $results->num_rows > 0) 
    {
        $totalAmount = 0; 
        $flag = false;
        $filename = '';
        $finalAmount= 0;
      
        if($selectedquery == '7')
        {
          $fileName = "Application Reviewer.csv";
        }
        else 
        {
          $fileName = $queryname.".csv";
        }

        header('Content-Type: text/csv; charset=utf-8');  
        header('Content-Disposition: attachment; filename="'.$fileName.'" ');  

        if($selectedquery == '7')
        {
          echo "Thakur Family Foundation"."\r"."Application Reviewer Report \r\n";
        }
        else
        {
          echo "Thakur Family Foundation "."\r".$queryname." Report\r\n";
        }

        echo "Report Production Date: "."\t".date("F j - Y g:i A")." IST \r\n";
        echo "\r\n";

        $output = fopen("php://output", "w"); 

        if($selectedquery == '7')
        {
          fputcsv($output, array( 'Application ID','First Name','Last Name','Board Member', 'Assigned Date','Review Date')); 
        }
        else if($selectedquery == '5' || $selectedquery == '6')
        {      
          fputcsv($output, array('Year', 'Grant ID', 'Area','Amount')); 
        } 
        else
        {
          fputcsv($output, array('Year', 'Grant ID','Type', 'Area','Amount')); 
        }

        while($row = mysqli_fetch_assoc($results))  
        {   
        	//print_r($row);die;
          if($selectedquery == '1' || $selectedquery == '2' || $selectedquery == '3' || $selectedquery == '4')
          {
            $resultingArray = array();
            if(is_numeric(str_replace(',', '', $row['Amount'])))
            {       
              if(number_format(intval(str_replace(',', '', $row['Amount']))) > 0) {      
              $resultingArray = [$row['SubmittedYear'],$row['GrantId'],$type,$row['Area'],'INR '.number_format(intval(str_replace(',', '', $row['Amount'])))];      
              fputcsv($output, $resultingArray); 
              }
            }
            else{
             // $resultingArray = [$row['SubmittedYear'],$row['GrantId'],$row['Area'],'0'];
            } 
            

          }
          else if($selectedquery != '7')
          {
            $resultArray = array();
            if(number_format($row['Amount']) != '0')
            {
              $resultArray = [$row['SubmittedYear'],$row['GrantId'],$row['Area'],'INR '.number_format($row['Amount'])];
              fputcsv($output, $resultArray); 
            }
            
          }
          else
          {
            fputcsv($output, $row);
          }
           
            
              if($selectedquery != '7')
              {  
                
                //if(is_numeric($row['Amount']))
                //{
                  $amount = str_replace(',', '', $row['Amount']);                 
                    $totalAmount = $totalAmount + intval($amount) ;

                //}

                $finalAmount= $totalAmount; 
              }
        }

        if($selectedquery != '7')
        {
              echo "\r\n";
             // echo "\\t"." "."\\t"."Total"."\\t"." ". $finalAmount . "\r\n";
              $a = array();
              if($selectedquery == '1' || $selectedquery == '2' || $selectedquery == '3' || $selectedquery == '4')
              {
              $a = ['Total','','','','INR '.number_format($finalAmount)];
              }
              else
              {
                $a = ['Total','','','INR '.number_format($finalAmount)];
              }
                fputcsv($output, $a); 
             
              
        } 

        // echo $filename;
        // die();
    }
    else
    {

      if($selectedquery == '7')
        {
          $fileName = "Advisory Board - Application.csv";
        }
        else 
        {
          $fileName = $queryname.".csv";
        }

        header('Content-Type: text/csv; charset=utf-8');  
        header('Content-Disposition: attachment; filename="'.$fileName.'" ');  

        if($selectedquery == '7')
        {
          echo "Thakur Family Foundation"."\r"."Advisory Board- Application Report \r\n";
        }
        else
        {
          echo "Thakur Family Foundation "."\r".$queryname." Report\r\n";
        }

        echo "Report Production Date: "."\t".date("Y-m-d H:i")." IST\r\n";
        echo "\r\n";

        $output = fopen("php://output", "w"); 

        if($selectedquery == '7')
        {
          fputcsv($output, array( 'Application ID','First Name','Last Name','Board Member', 'Assigned Date','Review Date')); 
        }
        else
        {      
          fputcsv($output, array('Submitted Year', 'Application ID', 'Area','Amt in INR')); 
        } 
        
      // if($selectedquery != '7')
      // {
      //   $headers =  array("Submitted Year"=>"",  
      //                           "Application ID"=>"", "Area"=>"","Amt in INR"=>"");
      //   //fputcsv($output,array("Submitted Year"=>"",  
      //                           //"Application ID"=>"", "Area"=>"","Amt in INR"=>""));

      //  $resultingArray = ["","","",""];

                
      // }
      // else
      // {
      //   $headers =  array( "Application ID"=>"", "First Name"=>"", "Last Name"=>"","Advisory Name"=>"",  
      //                   "Assign Date"=>"", "Review Date"=>"",);
      //   //fputcsv($output,array( "Application ID"=>"", "First Name"=>"", "Last Name"=>"","Advisory Name"=>"",  
      //                  // "Assign Date"=>"", "Review Date"=>""));

      //   $resultingArray = ["","","","","",""];

      // }

      //  //fputcsv($output, $resultingArray); 

      // $flag = false;
      // foreach($headers as $rows)
      // {  
      //   if(!$flag)
      //   {
      //     echo implode("\t", array_keys($headers)) . "\r\n";
      //               $flag = true;

      //     }
      //   }
       
        //fputcsv($output,$headers);
    }

    fclose($output);  

    //die();
}


?>