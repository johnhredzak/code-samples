<?php
// Send message from website to designated Capasso Renovations recipient

//// Assemble message ////
// To string
$to = "capasso.renovations@gmail.com, jmh2pgh@verizon.net";  // normal value
//$to = "jmh2pgh@verizon.net";  // test value
// Subject string
$subject = "[CapassoRenovations.com] Message from Website Visitor";
// Message string
$name = $_REQUEST['inpName'];
$phone = $_REQUEST['inpPhone'];
$email = $_REQUEST['inpEmail'];
$message = "Message sent from CapassoRenovations.com by website visitor:\n
From: $name
Phone: $phone
E-mail: $email
\nMessage:
";
$message .= $_REQUEST['taMessage'];
// From string (in header)
$headers = "From: $name<$email>";

//// Catch potentially malicious attempts ////
// Check that referrer to this script is within the site
if(!(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) && stristr($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST'])))
   exit("You must enable referrer logging in your web browser to use the contact form.<br />
   Please contact us via e-mail.<br /><br />
   <a href=\"index.php\">Capasso Renovations Home Page</a>");
// Check for newline characters in headers components
if (preg_match("/[\r\n]/", $name) || preg_match("/[\r\n]/", $email))
   exit("This operation is not permitted.");

//// Send mail ////
if (mail($to, $subject, $message, $headers))
   // Mail send success - redirect to designated page
   header("Location: msg_sent.php");
else
   // Mail send failure - display fail message
   header("Location: msg_failure.php");
?>
