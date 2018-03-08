<?php
// sendmsg.php - Receive data posted by AngularJS; check for errors;
//   process mail with PHPMailer; return success/failure message.

// Initialize
$recipientDataFile = './data/contact.csv';
$prohibitFile = './data/badmsgstrings.txt';
$formMailAddress = 'formmail@caci.org';
$recipientAlias = '';
$recipientName = '';
$recipientAddress = '';
$returnData = array();
date_default_timezone_set('America/New_York');

// Error check: missing required fields, invalid email (contingency in case of insufficient validation at client)
if (
    empty($_POST['name']) ||
    empty($_POST['email']) ||
    empty($_POST['subject']) ||
    empty($_POST['message']) ||
    !isset($_POST['name']) ||
    !isset($_POST['email']) ||
    !isset($_POST['subject']) ||
    !isset($_POST['message']) ||
    !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
    ) {
   $returnData['success'] = false;
   $returnData['message'] = 'Error. Please fill in all required fields and/or provide valid email.';
   exit(json_encode($returnData));
}

// Error check: missing recipient field
if (empty($_POST['recipient']) || !isset($_POST['recipient'])) {
   $returnData['success'] = false;
   $returnData['message'] = 'Error: Missing recipient. Please try again, or later if problem persists.';
   exit(json_encode($returnData));
};

// Error check: content violation, i.e. disallowed strings in message
$fp = fopen($prohibitFile, 'r');
if ($fp) {
   while (!feof($fp)) {
      $prohibitLine = fgets($fp);
      if (substr_count($_POST['message'], rtrim($prohibitLine)) > 0) {
         fclose($fp);
         $returnData['success'] = false;
         $returnData['message'] = 'Sorry, your message cannot be sent due to content violation.';
         exit(json_encode($returnData));
      }
   }
   fclose($fp);
};

// Get recipient email address - open data file
$fp = fopen($recipientDataFile, 'r');

// Error check: can't open file
if (!$fp) {
   $returnData['success'] = false;
   $returnData['message'] = 'Error: Can\'t open file for recipient address. Please try again, or later if problem persists.';
   exit(json_encode($returnData));
}

// Sequential search through file for address
$recipientAlias = $_POST['recipient'];
do $record = fgetcsv($fp, 1000, ',');
   while (($record[1] != $recipientAlias) && !feof($fp));  // advance to relevant record
// (If EOF was reached, recipient will be last one on list - should be the CACI general/catch-all address.)
// Set recipient email address
$recipientName = 'CACI ' . $record[1];  // Recipient name will be position title
$recipientAddress = $record[4];
fclose($fp);

// PHPMailer - Mail Processing:
//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
// The PHPMailer script (at hosting account www root)
require '../PHPMailer/PHPMailer.php';
// Create an instance of PHPMailer
$mail = new PHPMailer();
// Populate fields
$mail->setFrom($formMailAddress, $_POST['name']);
$mail->addReplyTo($_POST['email'], $_POST['name']);
$mail->addAddress($recipientAddress, $recipientName);
$mail->addBCC($formMailAddress);
$mail->Subject = '[CACI Website] ' . $_POST['subject'];
$mail->Body = $_POST['message'];
// Initiate sending mail
if(!$mail->send()) {
  // Error in sending mail
  $returnData['success'] = false;
  $returnData['message'] = 'Your message could not be sent. Mailer error: ' . $mail->ErrorInfo;
}
else {
  // Mail successfully sent
  $returnData['success'] = true;
  $returnData['message'] = 'Your message has been sent! Thank you for contacting CAC.';
//   $returnData['message'] = 'Your message has been sent! Please look for a confirmation message at the email address you provided. Thank you for contacting CAC.';
}
// end PHPMailer

/*
// DEBUG - Return fields. Note: Comment out PHPMailer code for debug
$returnData['success'] = true;
$returnData['message'] = 'DEBUG MODE - Message processed OK.';
$returnData['from'] = $_POST['name'] . ' | ' . $formMailAddress ;  // DEBUG
$returnData['replyTo'] = $_POST['name'] . ' | ' . $_POST['email'];  // DEBUG
$returnData['to'] =  $recipientName . ' | ' . $recipientAddress;  // DEBUG
$returnData['bcc'] = $formMailAddress;  // DEBUG
$returnData['subject'] = '[CACI Website] ' . $_POST['subject'];  // DEBUG
$returnData['body'] = $_POST['message'];  // DEBUG
*/

// Send data back to client as JSON
echo json_encode($returnData);
?>