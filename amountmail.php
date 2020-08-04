<?php
include('config.php');
function amountstatus($username,$emailuser,$applicationid,$first_expense_tranche_amount,$final_tranche_amount,$final_expense_amount,$interim_tranche_amount, $first_tranche_amt,$notify)
{
  $web_url="https://www.thakur-foundation.org/";
  $body='';

    if($notify == 'first_expense_tranche_paid'){

    $body='<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
    <tr>
      <td scope="col">
        <table style="margin:auto; mso-line-height-rule: exactly;background: #fff;" width="600" class="wrapper" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <th scope="col" height="20" valign="top">
                <img src="https://thakur-foundation.org/newsletter-images/top-bar.jpg" alt="" />
              </th>
            </tr>
            <tr>
              <td style="background: #231f20;padding: 20px 0 20px 20px" bgcolor="#231f20"><img src="https://thakur-foundation.org/newsletter-images/logo.png" alt="" /></td>
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
                  This is to notify that a payment of <span style="color: #db5c55; text-decoration: none;">INR '.$first_expense_tranche_amount.' </span>towards  <span style="color: #db5c55; text-decoration: none;">First  tranche</span> of the approved expense reimbursement has been sent to the financial institution you have indicated on your grant application. Please allow 2 business days for the payment to be credited to your account.<br>

                  </td></tr>

                        <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>
                        <tr><td height="20" style="line-height: 24px;font-size: 14px;color:#000">
Should you have any questions, you can write to <br><a href="mailto:grants.administrator@thakur-foundation.org" style="color: #db5c55; text-decoration: none;">grants.administrator@thakur-foundation.org</a></td></tr>

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

    } elseif($notify == 'final_tranche_paid'){

    $body='<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
    <tr>
      <td scope="col">
        <table style="margin:auto; mso-line-height-rule: exactly;background: #fff;" width="600" class="wrapper" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <th scope="col" height="20" valign="top">
                <img src="https://thakur-foundation.org/newsletter-images/top-bar.jpg" alt="" />
              </th>
            </tr>
            <tr>
              <td style="background: #231f20;padding: 20px 0 20px 20px" bgcolor="#231f20"><img src="https://thakur-foundation.org/newsletter-images/logo.png" alt="" /></td>
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
                  This is to notify that a payment of <span style="color: #db5c55; text-decoration: none;">INR '.$final_tranche_amount.' </span> towards  <span style="color: #db5c55; text-decoration: none;">Final  tranche </span> of the approved grant has been sent to the financial institution you have indicated on your grant application. Please allow 2 business days for the payment to be credited to your account.<br>

                  </td></tr>

                        <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>
                        <tr><td height="20" style="line-height: 24px;font-size: 14px;color:#000">
Should you have any questions, you can write to <br>
<a href="mailto:grants.administrator@thakur-foundation.org" style="color: #db5c55; text-decoration: none;">grants.administrator@thakur-foundation.org</a></td></tr>

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
}   elseif($notify == 'final_expense_paid'){

  $body='<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
    <tr>
      <td scope="col">
        <table style="margin:auto; mso-line-height-rule: exactly;background: #fff;" width="600" class="wrapper" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <th scope="col" height="20" valign="top">
                <img src="https://thakur-foundation.org/newsletter-images/top-bar.jpg" alt="" />
              </th>
            </tr>
            <tr>
              <td style="background: #231f20;padding: 20px 0 20px 20px" bgcolor="#231f20"><img src="https://thakur-foundation.org/newsletter-images/logo.png" alt="" /></td>
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
                  This is to notify that a payment of <span style="color: #db5c55; text-decoration: none;">INR '.$final_expense_amount.' </span> towards  <span style="color: #db5c55; text-decoration: none;">Final  tranche</span> of the approved expense reimbursement has been sent to the financial institution you have indicated on your grant application. Please allow 2 business days for the payment to be credited to your account. <br>

                  </td></tr>

                        <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>
                        <tr><td height="20" style="line-height: 24px;font-size: 14px;color:#000">
Should you have any questions, you can write to <br/> <a href="mailto:grants.administrator@thakur-foundation.org" style="color: #db5c55; text-decoration: none;">grants.administrator@thakur-foundation.org</a></td></tr>

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
} elseif($notify == 'interim_tranche_amount'){

  $body='<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
    <tr>
      <td scope="col">
        <table style="margin:auto; mso-line-height-rule: exactly;background: #fff;" width="600" class="wrapper" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <th scope="col" height="20" valign="top">
                <img src="https://thakur-foundation.org/newsletter-images/top-bar.jpg" alt="" />
              </th>
            </tr>
            <tr>
              <td style="background: #231f20;padding: 20px 0 20px 20px" bgcolor="#231f20"><img src="https://thakur-foundation.org/newsletter-images/logo.png" alt="" /></td>
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
                  This is to notify that a payment of <span style="color: #db5c55; text-decoration: none;">INR '.$interim_tranche_amount.' </span> towards  <span style="color: #db5c55; text-decoration: none;">Interim  tranche</span> of the approved grant has been sent to the financial institution you have indicated on your grant application. Please allow 2 business days for the payment to be credited to your account.  <br>

                  </td></tr>

                        <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>
                        <tr><td height="20" style="line-height: 24px;font-size: 14px;color:#000">
Should you have any questions, you can write to <br><a href="mailto:grants.administrator@thakur-foundation.org" style="color: #db5c55; text-decoration: none;">grants.administrator@thakur-foundation.org</a></td></tr>

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
} elseif($notify == 'first_tranche_amt'){

    $body='<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
    <tr>
      <td scope="col">
        <table style="margin:auto; mso-line-height-rule: exactly;background: #fff;" width="600" class="wrapper" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <th scope="col" height="20" valign="top">
                <img src="https://thakur-foundation.org/newsletter-images/top-bar.jpg" alt="" />
              </th>
            </tr>
            <tr>
              <td style="background: #231f20;padding: 20px 0 20px 20px" bgcolor="#231f20"><img src="https://thakur-foundation.org/newsletter-images/logo.png" alt="" /></td>
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
                  This is to notify that a payment of <span style="color: #db5c55; text-decoration: none;">INR '.$first_tranche_amt.' </span> towards  <span style="color: #db5c55; text-decoration: none;">First  tranche</span> of the approved grant has been sent to the financial institution you have indicated on your grant application. Please allow 2 business days for the payment to be credited to your account. <br>

                  </td></tr>

                        <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>
                        <tr><td height="20" style="line-height: 24px;font-size: 14px;color:#000">
Should you have any questions, you can write to <br><a href="mailto:grants.administrator@thakur-foundation.org" style="color: #db5c55; text-decoration: none;">grants.administrator@thakur-foundation.org</a></td></tr>

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
}


$template='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>First Expense Tranche Notification of Payment</title>
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
*{padding:0;margin:0}
/* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
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
 <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">

        </div>
        <!-- Visually Hidden Preheader Text : END -->

            '.$body.'
              <tr>
              <td align="center" valign="top">
                <table width="550" cellpadding="0" cellspacing="0">
                  <tr><td height="15" style="line-height: 15px;font-size: 0"></td></tr>
                  <tr><td style="line-height:10px;font-size:8px;color: #231f20">
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
              <td height="40" style="background: #414040;font-size: 12px;color: #9f9f9f;" valign="middle" align="center">Copyright &copy; 2019 - All Right Reserved</td>
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
//echo $template; die;
          $sub='Thakur Foundation - Notification of Payment';

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
             //$mail->AddAddress('ellen@example.com');               // Name is optional

             $mail->IsHTML(true);                                  // Set email format to HTML

            $mail->Subject = $sub;


            $mail->Body    = $template;

            $mail->Send();
            return $template;

}

?>
