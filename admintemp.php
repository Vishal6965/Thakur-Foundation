<?php


function postgrantstatus($username,$emailuser,$applicationid,$grantstatus,$amt,$tamt,$declineMidWayAmount,$closedApprovedAmount,$closedExpenseAmount)
{
  $body = "";
  $sub  = "";
  $web_url="https://www.thakur-foundation.org/";
  include('config.php');
  $sqlquery = "SELECT * from grant_status where id='".$grantstatus."' ";

  $result = mysqli_query($con, $sqlquery);

  if (!empty($result) && $result->num_rows > 0) {
    while($rows = $result->fetch_assoc()){

      $grantpoststatus=strtolower($rows['name']);

    }

  }

  if($grantstatus == '10'){
        //closed
    $a=0;
    $ta=0;
    if($amt != 0 )
    {
      $a=$amt;
    }
    if($tamt != 0 )
    {
      $ta=$tamt;
    }
    $sub  = 'Thakur Foundation - Your application has been closed';
    $body = '<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
    <tr>
    <td scope="col">
    <table style="margin:auto; mso-line-height-rule: exactly;background: #fff;" width="600" class="wrapper" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
    <th scope="col" height="20" valign="top">
    <img src="https://www.thakur-foundation.org/newsletter-images/top-bar.jpg" alt="" />
    </th>
    </tr>
    <tr>
    <td style="background: #231f20;padding: 20px 0 20px 20px" bgcolor="#231f20"><img src="https://www.thakur-foundation.org/newsletter-images/logo.png" alt="" /></td>
    </tr>
    <tr>
    <td align="center" valign="top">
    <table width="550" cellpadding="0" cellspacing="0">
    <tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>
    <tr>
    <td height="30" style="line-height: 22px;font-size: 14px;color: #000">Dear '.$username.',</td></tr>
    <tr><td height="15" style="line-height: 15px;font-size: 0"></td></tr>
    <tr>
    <td style="line-height: 24px;font-size: 14px;color: #000">
    Thank you for completing your investigative reporting grant with the support of the Thakur Foundation. <br>Your work has made a meaningful contribution to the field of Public Health in India. This message confirms that your grant is effectively closed in the Foundation\'s records. We have made the following payments to you for this grant:
    </td></tr>
    <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>


    <tr><td height="20" style="line-height: 22px;font-size: 14px;color: #000"> <span style="color: #db5c55; text-decoration: none; text-align: left">Total Grant Amount Paid: INR '.number_format($closedApprovedAmount).'</span><br>
    <span style="color: #db5c55; text-decoration: none;"> Total Expense Reimbursement: INR '.number_format($closedExpenseAmount).'</span>
    </td></tr>

	<tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>


    <tr><td height="20" style="line-height:20px;font-size: 14px">Should you have any questions, you can write to <br> <a style="color: #db5c55; text-decoration: none;">grants.administrator@thakur-foundation.org</a>.</td></tr>

	<tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

    <tr><td height="20" style="line-height: 20px;font-size: 14px;color: #000">We hope you apply once again to a future grant with the Foundation. Our grant award cycles are annual.</td></tr>

    <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>
    <tr><td height="20" style="line-height: 22px;font-size: 14px;color: #000">
    Grant Application ID: <a style="color: #db5c55; text-decoration: none;" href="'.$web_url.'application-details.php?token='.base64_encode($applicationid).' "><span style="color: #db5c55; text-decoration: none;"> '.$applicationid.'</span></a><br>
    <a href="'.$web_url.'application-details.php?token='.base64_encode($applicationid).' "" style="color: #db5c55; text-decoration: none;"></a>
    </td></tr>

    <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

    <tr><td style="line-height: 22px;font-size: 14px;color: #000">Sincerely, <br>Thakur Foundation</td></tr>
    <tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>

    </table>
    </td>
    </tr>';

  } elseif($grantstatus == '9'){
//approved
   $sub='Thakur Foundation - Your application has been approved';
   $body='<table border="0" cellpadding="0" cellspacing="0" width="100%">
   <tbody>
   <tr>
   <td scope="col">
   <table style="margin:auto; mso-line-height-rule: exactly;background: #fff;" width="600" class="wrapper" cellpadding="0" cellspacing="0">
   <tbody>
   <tr>
   <th scope="col" height="20" valign="top">
   <img src="https://www.thakur-foundation.org/newsletter-images/top-bar.jpg" alt="" />
   </th>
   </tr>
   <tr>
   <td style="background: #231f20;padding: 20px 0 20px 20px" bgcolor="#231f20"><img src="https://www.thakur-foundation.org/newsletter-images/logo.png" alt="" /></td>
   </tr>
   <tr>
   <td align="center" valign="top">
   <table width="550" cellpadding="0" cellspacing="0">
   <tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>
   <tr>
   <td height="30" style="line-height: 22px;font-size: 14px;color: #000">Dear '.$username.',</td></tr>
   <tr><td height="15" style="line-height: 15px;font-size: 0"></td></tr>
   <tr>
   <td style="line-height: 24px;font-size: 14px;color: #000">

Thank you for applying for a grant with the Thakur Foundation. Congratulations, your application has been '.$grantpoststatus.' for funding. We receive a large number of applications for our grants and our review has determined that your application stands out among all the applications we have received this cycle. We are impressed by your background, experience and clarity of purpose that you have articulated in your application
</td></tr>
   <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>
   <tr><td height="20" style="line-height: 22px;font-size: 14px;color: #000"> We welcome you to the small group of recipients whose work the Foundation has chosen to support this year.<br><br>
   Grant Application ID: <a style="color: #db5c55; text-decoration: none;" href="'.$web_url.'application-details.php?token='.base64_encode($applicationid).' "><span style="color: #db5c55; text-decoration: none;"> '.$applicationid.'</span></a><br>
   </td></tr>

   <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

   <tr><td height="20" style="line-height: 20px;font-size: 14px;color: #000"We will be in touch shortly to inform you of the next steps in this process.<br> Should you have any questions, you can write <br> <a href="mailto:grants.administrator@thakur-foundation.org" style="color: #db5c55; text-decoration: none;">grants.administrator@thakur-foundation.org.</a></td></tr>

   <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>
   <tr><td height="20" style="line-height: 20px;font-size: 14px;color: #000">Congratulations once again and we look forward to working with you.</td></tr>
   <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

   <tr><td style="line-height: 22px;font-size: 14px;color: #000">Sincerely, <br>Thakur Foundation</td></tr>
   <tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>

   </table>
   </td>
   </tr>';
 } elseif($grantstatus == '8'){
        //lapsed
  $sub   = 'Thakur Foundation - Your application has been lapsed';
  $body  = '<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
  <tr>
  <td scope="col">
  <table style="margin:auto; mso-line-height-rule: exactly;background: #fff;" width="600" class="wrapper" cellpadding="0" cellspacing="0">
  <tbody>
  <tr>
  <th scope="col" height="20" valign="top">
  <img src="https://www.thakur-foundation.org/newsletter-images/top-bar.jpg" alt="" />
  </th>
  </tr>
  <tr>
  <td style="background: #231f20;padding: 20px 0 20px 20px" bgcolor="#231f20"><img src="https://www.thakur-foundation.org/newsletter-images/logo.png" alt="" /></td>
  </tr>
  <tr>
  <td align="center" valign="top">
  <table width="550" cellpadding="0" cellspacing="0">
  <tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>
  <tr>
  <td height="30" style="line-height: 22px;font-size: 14px;color: #000">Dear  '.$username.',</td></tr>
  <tr><td height="15" style="line-height: 15px;font-size: 0"></td></tr>
  <tr>
  <td style="line-height: 24px;font-size: 14px;color: #000">
  Thank you for applying for a grant to the Thakur Foundation.<br>
  Your application is incomplete. We had asked for additional information in order for us to complete the review process from you. Since you have not provided the information we requested by the deadline, unfortunately, your grant application has lapsed for this cycle. We are disappointed with this outcome.  <br>
  We invite you to apply again for a new grant during the next cycle. Our grant cycles are annual, and we look forward to receiving your application.
  </td></tr>
  <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

  <tr><td height="20" style="line-height: 20px;font-size: 14px;color: #000">Should you have any questions, you can write to <br> <a href="mailto:grants.administrator@thakur-foundation.org" style="color: #db5c55; text-decoration: none;">grants.administrator@thakur-foundation.org.</a></td></tr>

  <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

  <tr><td height="20" style="line-height: 22px;font-size: 14px;color: #000"> We thank you for your interest in our work and for your application.<br>
  Grant Application ID: <a style="color: #db5c55; text-decoration: none;" href="'.$web_url.'application-details.php?token='.base64_encode($applicationid).' "><span style="color: #db5c55; text-decoration: none;"> '.$applicationid.'</span></a><br>
  </td></tr>

  <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

  <tr><td style="line-height: 22px;font-size: 14px;color: #000">Sincerely, <br>Thakur Foundation</td></tr>
  <tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>

  </table>
  </td>
  </tr>';
}   elseif($grantstatus == '7'){
//declined-mid-way
  $sub = 'Thakur Foundation - Your application has been declined mid-way';
  $body ='<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
  <tr>
  <td scope="col">
  <table style="margin:auto; mso-line-height-rule: exactly;background: #fff;" width="600" class="wrapper" cellpadding="0" cellspacing="0">
  <tbody>
  <tr>
  <th scope="col" height="20" valign="top">
  <img src="https://www.thakur-foundation.org/newsletter-images/top-bar.jpg" />
  </th>
  </tr>
  <tr>
  <td style="background: #231f20;padding: 20px 0 20px 20px" bgcolor="#231f20"><img src="https://www.thakur-foundation.org/newsletter-images/logo.png" /></td>
  </tr>
  <tr>
  <td align="center" valign="top">
  <table width="550" cellpadding="0" cellspacing="0">
  <tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>
  <tr>
  <td height="30" style="line-height: 22px;font-size: 14px;color: #000">Dear '.$username.',</td></tr>
  <tr><td height="15" style="line-height: 15px;font-size: 0"></td></tr>
  <tr>
  <td style="line-height: 24px;font-size: 14px;color: #000">
  We are writing to inform you that the Foundation has decided to withdraw support for your grant.
  We are disappointed that you have not made adequate progress as per the timelines agreed with you when the grant was awarded. Despite multiple follow-ups, we do not see a sense of urgency in your responses to the concerns that we have with your work and its progress. Therefore, the Foundation has decided to stop any future funding of your grant. <br>
  </td></tr>
  <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

  <tr><td height="20" style="line-height:24px;font-size: 14px;color: #000">We have made the following payments to you as of today: <span style="color: #db5c55; text-decoration: none;"> INR '.number_format($declineMidWayAmount).'</span></td></tr>
  <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

  <tr>
  <td height="20" style="line-height: 20px;font-size: 14px;color: #000">Should you have any questions, you can write to<br> <a href="mailto:grants.administrator@thakur-foundation.org" style="color: #db5c55; text-decoration: none;">grants.administrator@thakur-foundation.org</a></td></tr>

  <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

  <tr><td height="20" style="line-height: 22px;font-size: 14px;color: #000">
  Grant Application ID: <a style="color: #db5c55; text-decoration: none;" href="'.$web_url.'application-details.php?token='.base64_encode($applicationid).' "><span style="color: #db5c55; text-decoration: none;"> '.$applicationid.'</span></a><br>
  </td></tr>

  <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

  <tr><td style="line-height: 22px;font-size: 14px;color: #000">Sincerely, <br>Thakur Foundation</td></tr>
  <tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>

  </table>
  </td>
  </tr>';
}  elseif($grantstatus == '6'){
//declined
  $sub    = 'Thakur Foundation - Your application has been declined';
  $body = '<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
  <tr>
  <td scope="col">
  <table style="margin:auto; mso-line-height-rule: exactly;background: #fff;" width="600" class="wrapper" cellpadding="0" cellspacing="0">
  <tbody>
  <tr>
  <th scope="col" height="20" valign="top">
  <img src="https://thakur-foundation.org/newsletter-images/top-bar.jpg" />
  </th>
  </tr>
  <tr>
  <td style="background: #231f20;padding: 20px 0 20px 20px" bgcolor="#231f20"><img src="https://www.thakur-foundation.org/newsletter-images/logo.png" /></td>
  </tr>
  <tr>
  <td align="center" valign="top">
  <table width="550" cellpadding="0" cellspacing="0">
  <tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>
  <tr>
  <td height="30" style="line-height: 22px;font-size: 14px;color: #000">Dear '.$username.',</td></tr>
  <tr><td height="15" style="line-height: 15px;font-size: 0"></td></tr>
  <tr>
  <td style="line-height: 24px;font-size: 14px;color: #000">
  Thank you for applying for a grant to the Thakur Foundation. We have reviewed your application.
  Although we are impressed by the quality of your application, given the limited number of grants available, we have declined to fund your application for this cycle. You are invited to apply for a new grant during the next cycle and we look forward to receiving your new application. <br>
  </td></tr>

  <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

  <tr><td height="20" style="line-height: 20px;font-size: 14px;color: #000">Should you have any questions, you can write to<br> <a href="mailto:grants.administrator@thakur-foundation.org" style="color: #db5c55; text-decoration: none;">grants.administrator@thakur-foundation.org</a></td></tr>

  <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

  <tr><td height="20" style="line-height: 22px;font-size: 14px;color: #000">We thank you for your interest in our work and for your application. <br>
  Grant Application ID: <a style="color: #db5c55; text-decoration: none;" href="'.$web_url.'application-details.php?token='.base64_encode($applicationid).' "><span style="color: #db5c55; text-decoration: none;"> '.$applicationid.'</span></a><br>
  </td></tr>
  <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

  <tr><td style="line-height: 22px;font-size: 14px;color: #000">Sincerely, <br>Thakur Foundation</td></tr>
  <tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>

  </table>
  </td>
  </tr>';
}  elseif($grantstatus == '5'){
        //defferred
  $sub  = 'Thakur Foundation - Your application has been deferred';
  $body = '<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
  <tr>
  <td scope="col">
  <table style="margin:auto; mso-line-height-rule: exactly;background: #fff;" width="600" class="wrapper" cellpadding="0" cellspacing="0">
  <tbody>
  <tr>
  <th scope="col" height="20" valign="top">
  <img src="https://thakur-foundation.org/newsletter-images/top-bar.jpg" />
  </th>
  </tr>
  <tr>
  <td style="background: #231f20;padding: 20px 0 20px 20px" bgcolor="#231f20"><img src="https://thakur-foundation.org/newsletter-images/logo.png" /></td>
  </tr>
  <tr>
  <td align="center" valign="top">
  <table width="550" cellpadding="0" cellspacing="0">
  <tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>
  <tr>
  <td height="30" style="line-height: 22px;font-size: 14px;color: #000">Dear '.$username.',</td></tr>
  <tr><td height="15" style="line-height: 15px;font-size: 0"></td></tr>
  <tr>
  <td style="line-height: 24px;font-size: 14px;color: #000">
  Thank you for applying for a grant to the Thakur Foundation. We have reviewed your application. Although we are impressed by the quality of your application, given the limited number of grants available, we have deferred your application to the next cycle of our grants.  <br>

  </td></tr>
  <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>
  <tr><td height="20" style="line-height: 24px;font-size: 14px;color:#000;"> Please be assured that your application will be considered during the next cycle of the grants process. We will save the information you have provided us and include it in our next cycle. Our grants cycle is annual.</td></tr>


  <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

  <tr><td height="20" style="line-height: 24px;font-size: 14px;color:#000">
  Should you have any questions, you can write to<br> <a href="mailto:grants.administrator@thakur-foundation.org" style="color: #db5c55; text-decoration: none;">grants.administrator@thakur-foundation.org</a></td></tr>

  <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

  <tr><td height="20" style="line-height: 22px;font-size: 14px;color: #000"> We thank you for your interest in our work and for your application.<br><br>
  Grant Application ID: <a style="color: #db5c55; text-decoration: none;" href="'.$web_url.'application-details.php?token='.base64_encode($applicationid).' "><span style="color: #db5c55; text-decoration: none;"> '.$applicationid.'</span></a><br>
  </td></tr>




  <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

  <tr><td style="line-height: 22px;font-size: 14px;color: #000">Sincerely, <br>Thakur Foundation</td></tr>
  <tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>

  </table>
  </td>
  </tr>';
}   elseif($grantstatus == '4'){
        //selected
  $sub  = 'Thakur Foundation - Your application has been selected';
  $body = '<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
    <tr>
      <td scope="col">
        <table style="margin:auto; mso-line-height-rule: exactly;background: #fff;" width="600" class="wrapper" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <th scope="col" height="20" valign="top">
                <img src="https://thakur-foundation.org/newsletter-images/top-bar.jpg" />
              </th>
            </tr>
            <tr>
              <td style="background: #231f20;padding: 20px 0 20px 20px" bgcolor="#231f20"><img src="https://thakur-foundation.org/newsletter-images/logo.png" /></td>
            </tr>
            <tr>
              <td align="center" valign="top">
                <table width="550" cellpadding="0" cellspacing="0">
                  <tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>
                  <tr>
                    <td height="30" style="line-height: 22px;font-size: 14px;color: #000">Dear '.$username.',</td></tr>
                  <tr><td height="15" style="line-height: 15px;font-size: 0"></td></tr>
                  <tr>
                    <td style="line-height: 24px;font-size: 14px;color: #000">
                  Thank you for applying for a grant to the Thakur Foundation. We have reviewed your application and have short-listed it as a potential awardee. We have determined that we need the following information in order to complete our review process within seven (7) business days: <br>
                   Grant Application ID: <a style="color: #db5c55; text-decoration: none;" href="'.$web_url.'application-details.php?token='.base64_encode($applicationid).' "><span style="color: #db5c55; text-decoration: none;"> '.$applicationid.'</span></a>

                      <br>

                  </td></tr>
                  <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>
                        <tr><td height="20" style="line-height: 22px;font-size: 14px;color: #000">1. Executed and Notarized Services Agreement.<br>
2. Bank transfer instructions for making payments to your financial institution.<br>
<br>
A template of the Services Agreement document and the Bank Transfer instructions are available for <a href="https://thakur-foundation.org/contract/TFF-Investigative-Grants-in-Public-Health-AGREEMENT-FOR-SERVICES.pdf" style="color: #db5c55; text-decoration: none;">download here.</a></td></tr>

                        <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>
                        <tr><td height="20" style="line-height: 22px;font-size: 14px;color: #000">Please complete this document, get the Services Agreement notarized and upload a scanned color copy to <a href="https://thakur-foundation.org/" style="color: #db5c55; text-decoration: none;"> My Account </a> on our website.</td></tr>

                        <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>
                        <tr><td height="20" style="line-height: 22px;font-size: 14px;color: #000">Please send the original notarized and executed copy of the Services Agreement, preferably by courier to the following address:<br><br>Thakur Family Foundation, Inc,<br>
                        Attn: Dinesh S Thakur<br>
                        SW4, World Spa West,<br>
                        Sectors 31 & 40<br>
                        Gurugram, Haryana 120 001</td></tr>

                        <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

                  <tr><td style="line-height: 22px;font-size: 14px;color: #000">Sincerely, <br>Thakur Foundation</td></tr>
                  <tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>

                </table>
              </td>
            </tr>';
}



$template='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Your application has been approved</title>
<meta name="viewport" content="width=device-width">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="x-apple-disable-message-reformatting">
<link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
<!--[if mso]>
<style>
* {font-family:Arial, sans-serif !important;}
</style>
<![endif]-->
<style type="text/css">
/* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
*{padding:0;margin:0}
html,
body {
 margin: 0 auto !important;
 padding: 0 !important;
 height: 100% !important;
 width: 100% !important;
 font-family:Raleway, Arial, Tahoma, Segoe;
 font-size: 14px;
 font-weight: 600;
 background: #e4e0e1;
}

/* What it does: Stops email clients resizing small text. */
        * {
-ms-text-size-adjust: 100%;
-webkit-text-size-adjust: 100%;
}
/* iOS BLUE LINKS */
a[x-apple-data-detectors] {
  color: inherit !important;
  text-decoration: none !important;
  font-size: inherit !important;
  font-family: inherit !important;
  font-weight: inherit !important;
  line-height: inherit !important;
}
table,
td {
  mso-table-lspace: 0pt !important;
  mso-table-rspace: 0pt !important;
}

/* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
table {
  border-spacing: 0 !important;
  border-collapse: collapse !important;
  table-layout: fixed !important;
  margin: 0 auto !important;
}

</style>
</head>

<body style="padding:0;margin:0;">
'.$body.'
<tr>
<td align="center" valign="top" style="background:#f1f1f1;">
<table width="550" cellpadding="0" cellspacing="0">
<tr><td height="15" style="line-height: 15px;font-size: 0"></td></tr>
<tr><td style="line-height:13px;font-size:11px;color: #231f20">
This e-mail communication and any attachments may be privileged and confidential to Thakur Family Foundation, Inc and are intended only for the use of the recipients named above. If you are not the intended recipient, please do not review, disclose, disseminate, distribute or copy this e-mail and its attachments. If you have received this email in error, please delete this message along with all its attachments and notify us immediately at <a href="mailto:support@thakur-foundation.org" style="color: #db5c55; text-decoration: none;">support@thakur-foundation.org</a>. <br> Thank you.<br><br>

Thakur Family Foundation, Inc<br>
100 1st Ave North, Ste 3603
St Petersburg, FL 33701<br>
+1.727.471.7453<br>
<a href="https://thakur-foundation.org/" style="color: #db5c55; text-decoration: none;">www.thakur-foundation.org</a>

</td></tr>
<tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

</table>
</td>
</tr>
<tr>
<td height="40" style="background: #f1f1f1;font-size: 12px;color: #000;" valign="middle" align="center">Copyright &copy; 2019 - All Right Reserved</td>
</tr>
</tbody>
</table>

</td>
</tr>
</tbody>
</table>

</body>
</html>
';



$mail = new PHPMailer;


            //$mail->IsSMTP();                                      // Set mailer to use SMTP
             $mail->Host = 'smtp.gmail.com';                 // Specify main and backup server
             $mail->Port = 465;                                    // Set the SMTP port
             $mail->SMTPAuth = true;                               // Enable SMTP authentication
             $mail->Username = 'grants.administrator@thakur-foundation.org';                // SMTP username
             $mail->Password = 'QR-5=ZDA85^U';                  // SMTP password
             $mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
             $mail->SMTPDebug=1;
             $mail->SetFrom = 'grants.administrator@thakur-foundation.org';
             $mail->AddReplyTo('grants.administrator@thakur-foundation.org', 'Thakur Foundation');
             $mail->FromName = 'Thakur Foundation';
            $mail->AddAddress($emailuser);  // Add a recipient
             $mail->AddAddress('grants.administrator@thakur-foundation.org');               // Name is optional

             $mail->IsHTML(true);                                  // Set email format to HTML

             $mail->Subject = $sub;


             $mail->Body    = $template;

             $mail->Send();

             return true;
           }


           ?>
