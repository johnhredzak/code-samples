<?php
// ** Fixed Values **
$dataFile = "./data/contactdata.csv";
$loggingAddress = "formmail@caci.org";
$doNotReplyAddress = "DO_NOT_REPLY@caci.org";
$donePage = 'mesngr_outcome.php';
date_default_timezone_set("America/New_York");

// *** Prepare message initiated from website for designated recipient ***

// Get recipient club or person's title
$recip_alias = $_POST['recipient'];

// To: Look up recipient's e-mail address in data file, corresponding to alias
$fp = @fopen($dataFile, "r");
if (!$fp) {
   // Error opening file - Exit to result page and provide error message to user
   $mailErrorMsg = "Unable to open data file.";
   header("Location: $donePage?result=$mailErrorMsg");
}
do $record = fgetcsv($fp, 1000, ",");
   while (($record[0] != $recip_alias) && !feof($fp));  // advance to relevant record
$recip_address = $record[3];
fclose($fp);

// Bcc: for logging
$bcc = $loggingAddress;

// From: & Reply-to: (sender) name/e-mail
// Envelope's From: field will contain e-mail address within domain (avoid spam flag)
$sender_name = $_POST['inpName'];
$cbEmailNone = $_POST['cbEmailNone'];
if ($cbEmailNone == 'noEmail')  // Sender has no address?
{
   $sender_email = "NO ADDRESS - DO NOT REPLY";
   $reply_to = "CANNOT REPLY";
}
else  // Address was specified
{
   $sender_email = $_POST['inpEmail'];
   $reply_to = "$sender_name <$sender_email>";
}
$from = "$sender_name <$loggingAddress>";

// Subject: to recipient
$sender_subject = $_POST['inpSubject'];
$recip_subject = '[CACI] ' . $sender_subject;

// Message: to recipient
$sender_message = $_POST['taMessage'];
$recip_message = "The following has been submitted through the CACI website,
" . date('D, M j, Y, g:i A T') . ":
------------------------------------------------------------
To: CAC(I) $recip_alias
From: $sender_name
Subject: $sender_subject
E-mail: $sender_email
--- Message: ---$sender_message
------------------------------------------------------------";

// Headers containing 1) sender, 2) bcc for logging
$recip_headers = "From: $from\r\nReply-To: $reply_to\r\nBcc: $bcc";

// *** END Prepare message initiated from website for designated recipient ***

// *** Catch potentially malicious attempts ***
// Check that referrer to this script is within the site
if(!(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) && stristr($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST'])))
   exit("<br>You must enable referrer logging in your web browser to use the contact form.<br>
   Please adjust this browser setting or use another computing device.<br>");
// Check for newline characters in headers components
if (preg_match("/[\r\n]/", $sender_name) || preg_match("/[\r\n]/", $sender_email))
   exit("This operation is not permitted.");

// *** (RELEASE) Send mail and provide success/fail message ***
// Try sending e-mail
try { $mail_success = @mail($recip_address, $recip_subject, $recip_message, $recip_headers); }
catch (Exception $e) { $mailErrorMsg = $e -> getMessage(); }
if (!is_object($e) && $mail_success) {  // Mail successfully sent?
   // Send confirmation e-mail message to sender (site visitor) unless they did not provide an e-mail address
   if ($cbEmailNone != 'noEmail') {
      // Confirmation To, Subject, Message, and header (From + Reply-to) strings
      $conf_to = "$sender_name<$sender_email>";
      $conf_subject = 'Confirmation of your message via CACI website';
      $conf_message_prefix = "Thank you for contacting Catholic Alumni Clubs via our website.
If applicable, we will respond to your message shortly.
(Please do not reply to this message - it will go nowhere.)\r\n\r\nContent:\r\n";
      $conf_message = $conf_message_prefix . $recip_message;
      $conf_headers = "From: CACI Auto-reply<$loggingAddress>\r\nReply-to: $doNotReplyAddress";
      // Send confirmation e-mail
      @mail($conf_to, $conf_subject, $conf_message, $conf_headers);
   }
   // Provide success message to user
   header("Location: $donePage?result=success");
}
elseif (!is_object($e)) {
   // Send Failure - provide fail message to user
   header("Location: $donePage?result=fail");
}
else {
   // Error - Provide error message to user
   header("Location: $donePage?result=$mailErrorMsg");
}
// *** END (RELEASE) Send mail ***


/* 
// *** (DEBUG 1) Show sent info in messenger window ***
echo "\n<html>";
echo "\n<body>";
echo "\n<pre>
To: $recip_address
Subject: $recip_subject
(Headers:)\n$recip_headers
\n--- Message to recipient ---\n$recip_message";
echo "\n</pre>";
echo "\n</body>";
echo "\n</html>";

// *** (DEBUG 2) Local test - Send mail using PEAR ***
require_once "Mail.php";
$body = $recip_message;
$host = "outgoing.verizon.net";
$port = "25";
$username = "XXXXXX";
$password = "****";
$recip_headers = array (
   'From' => $from,
   'To' => $recip_address,
   'Subject' => $recip_subject,
   'Bcc' => $bcc);
$smtp = Mail::factory('smtp', array (
   'host' => $host,
   'port' => $port,
   'auth' => true,
   'username' => $username,
   'password' => $password));
$mail = $smtp->send($recip_address, $recip_headers, $body);
if (PEAR::isError($mail)) {
   $mailErrorMsg = $mail->getMessage();
   header("Location: $donePage?result=$mailErrorMsg");
}
else {
   header("Location: $donePage?result=success");
}
// *** end DEBUG ***
*/
?>
