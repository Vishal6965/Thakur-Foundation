<?PHP
$sender = ' admin@thakur-foundation.org';
$recipient = 'leena.g@logicserve.com';

$subject = "php mail test";
$message = "'<table border='1'>											<tr>											<td><center><b>Name:</b></center></td>											<td>leena</td>											</tr>											<tr>											<td><center><b>Phone:</b></center></td>											<td>1234567890</td>											</tr>											<tr>											<td><center><b>Email:</b></center></td>											<td>leena.g@gmail.com</td>											</tr>											<tr>											<td><center><b>Reason:</b></center></td>											<td>testing</td>											</tr>											</table>'";
$headers = 'From:' . $sender;

if (mail($recipient, $subject, $message, $headers))
{
    echo "Message accepted";
}
else
{
    echo "Error: Message not accepted";
}
?>