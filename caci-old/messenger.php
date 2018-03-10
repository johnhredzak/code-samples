<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>CACI Messenger</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="John Hredzak">
<link type="text/css" rel="stylesheet" href="caci_mes.css">

<script type="text/javascript">
// Encode action attribute to avoid potential abuse
entAct = './mes'+'seng'+'er.p'+'hp';
subAct = './sen'+'dscr'+'ipt.p'+'hp';
</script>

<style type="text/css">

#errorMsg {
  margin: -6px 0 6px;
  color: #ff0000;
  font-family: Arial, Helvetica, Sans-Serif;
  font-size: 14px;
  font-weight: bold;
  }

.finalInstrs {
  margin: 12px auto 3px;
  font-size: 12px;
  font-weight: bold;
  font-style: italic;
  }

/********* ENTRY TABLE *********/
.dataEntryTbl {
  margin: 0 auto;  /* no top/bottom margin + horiz. centered */
  border: 0;
  text-align: center;
  width: 510px;
  }
.dataEntryTbl td {
  padding: 4px 2px;
  }
.dataEntryTbl td.leftCol {
  width: 90px;
  text-align: right;
  font-family: Verdana, Geneva, Helvetica, Sans-Serif;
  font-size: 11px;
  font-weight: bold;
  }
.dataEntryTbl td.rightCol {
  width: 400px;
  text-align: left;
  font-family: Arial, Helvetica, Sans-Serif;
  font-size: 12px;
  }
#addresseeCell {
  font-size: 14px;
  }
#cbEmailNone {
  margin-left: 10px;
  }
div.showMessageText {
  height: 200px;
  overflow: auto;
  text-align: left;
  background: #eeeeee;
  }

/********* FORM CONTROLS *********/
#entryForm input, #entryForm textarea {
  font-family: Arial, Helvetica, Sans-Serif;
  font-size: 12px;
  font-weight: normal;
  }
#inpName, #inpEmail, #inpEmailAgain {
  width: 250px;
  }
#inpSubject, #taMessage {
  width: 98%;
  }
#taMessage {
  height: 168px;
  }
#btnEnterLeft {
  margin-left: 90px;
  margin-right: 15px;
  }
#btnSubmitLeft {
  margin-left: 40px;
  margin-right: 15px;
  }
</style>

</head>
<body>

<!-- BEGIN Main Content -->

<?php
$prohibitFile = "./data/badmsgstrings.txt";
$messengerTop = "<div id=\"topbar\">Messenger - Catholic Alumni Clubs International</div>
<div id=\"heading\">Compose your message to CAC here:</div>";
$inpName = '';
$inpEmail = '';
$cbEmailNone = '';
$cbEmailNoneChecked = '';
$inpEmailAgain = '';
$inpSubject = '';
$taMessage = '';

if (!isset($_POST['posted']))
{
  // Initial entry to this page from another
  $recipient = $_GET['recip'];
  echo $messengerTop;
  echo "<br>\n";
}

else
{
  // Data was just submitted by user

  // Assign just-submitted form field values to variables
  $recipient = $_POST['recipient'];
  $inpName = $_POST['inpName'];
  $inpEmail = $_POST['inpEmail'];
  if (isset($_POST['cbEmailNone'])) $cbEmailNone = $_POST['cbEmailNone'];
  if ($cbEmailNone == "noEmail")
    $cbEmailNoneChecked = " checked";
  else
    $cbEmailNoneChecked = "";
  $inpEmailAgain = $_POST['inpEmailAgain'];
  $inpSubject = $_POST['inpSubject'];
  $taMessage = $_POST['taMessage'];

  // Change double-quote to two single-quotes, for inpName inpSubject and taMessage fields
  // to enable embedding text within input control values
  $inpName = preg_replace('/"/', "''", $inpName);
  $inpSubject = preg_replace('/"/', "''", $inpSubject);
  $taMessage = preg_replace('/"/', "''", $taMessage);

  try
  {
    // Validate form field data submitted; throw exception if validation fails
    foreach ($_POST as $field => $value)
    {
      $len = strlen($value);
      switch ($field)
      {
        case "inpName":
          if ($len == 0)
            throw new Exception("Enter your Name.");
          else if ($len > 50)
            throw new Exception("Name too long. Re-enter with 50 characters or less.");
          break;

        case "inpEmail":
//          $emailRegexp = "^[^@ ]+@[^@ ]+\.\w{2,6}$";
          $emailRegexp = "/^[^@ ]+@[^@ ]+\.[^@ \.]+$/";
          if ($len == 0 && !$_POST['cbEmailNone'])
            throw new Exception("Enter your E-mail Address or check the \"No e-mail address\" box.");
          else if ($len > 0 && !preg_match($emailRegexp, $value) || $len > 60)
            throw new Exception("E-mail Address invalid. Re-enter.");
          break;

        case "inpEmailAgain":
          if ($value != $_POST['inpEmail'])
            throw new Exception("E-mail Address entries do not match. Re-enter in both boxes.");
          break;

        case "inpSubject":
          if ($len == 0)
            throw new Exception("Enter a Subject.");
          else if ($len > 100)
            throw new Exception("Subject too long. Re-enter with 100 characters or less.");
          break;

        case "taMessage":
          if ($len == 0)
            throw new Exception("Enter a Message.");
          else if ($len > 600)
            throw new Exception("Please reduce the size of your message to no more than 600 characters. Note: messages of questionable nature will be held for approval or denial before passing to recipient.");
          break;

        default:
          break;
      }
    }
  }
  catch (Exception $e)
  {
    // Exception handling for bad input - display error message
    echo $messengerTop;
    echo "<div id=\"errorMsg\">";
    echo $e -> getMessage();
    echo "<br></div>";
  }
}  // END: if...else (!isset($_POST['posted']))

if (!isset($_POST['posted']) || isset($e))
// Initial display of this page? Or subsequent display resulting from error in user-subitted data?

{
// Render form to user
?>
<form id="entryForm" name="entryForm" action="" method="post" enctype="text/html" onSubmit="javascript:this.action=entAct;">
  <input type="hidden" name="recipient" value="<?php echo $recipient; ?>">
  <input type="hidden" name="posted" value="true">
  <table class="dataEntryTbl" cellspacing="0" summary="message entry">
    <tr>
      <td class="leftCol">To:</td>
      <td class="rightCol" id="addresseeCell"><?php echo $recipient; ?></td>
    </tr>
    <tr>
      <td class="leftCol">Your Name:</td>
      <td class="rightCol"><input name="inpName" id="inpName" type="text" value="<?php echo stripslashes($inpName); ?>"></td>
    </tr>
    <tr>
      <td class="leftCol">E-mail Addr:</td>
      <td class="rightCol">
        <input name="inpEmail" id="inpEmail" type="text" value="<?php echo $inpEmail; ?>">
        <input name="cbEmailNone" id="cbEmailNone" type="checkbox" value="noEmail"<?php echo $cbEmailNoneChecked; ?>>No e-mail address
      </td>
    </tr>
    <tr>
      <td class="leftCol">Re-enter<br>E-mail Addr:</td>
      <td class="rightCol"><input name="inpEmailAgain" id="inpEmailAgain" type="text" value="<?php echo $inpEmailAgain; ?>"></td>
    </tr>
    <tr>
      <td class="leftCol">Subject:</td>
      <td class="rightCol"><input name="inpSubject" id="inpSubject" type="text" value="<?php echo stripslashes($inpSubject); ?>"></td>
    </tr>
    <tr valign="top">
      <td class="leftCol">Message:</td>
      <td class="rightCol"><textarea name="taMessage" id="taMessage" rows="11" cols="40"><?php echo stripslashes($taMessage); ?></textarea></td>
    </tr>
    <tr>
      <td class="leftCol">&nbsp;</td>
      <td class="rightCol">
      <button id="btnEnterLeft" type="submit">Continue</button>
      <button id="btnCancelRt" type="button" onClick="javascript:window.close();">Cancel</button>
      </td>
    </tr>
  </table>
</form>
<?php
}

else
{
// Valid data was submitted - echo back to user, and send the data to e-mail script for delivery

// First, check for content violation in message and exit if so
$file = fopen($prohibitFile, "r");
if ($file)
{
  while (!feof($file))
  {
    $prohibitLine = fgets($file);
    if (substr_count($taMessage, rtrim($prohibitLine)) > 0)
    {
       fclose($prohibitFile);
       exit("<h2>Sorry, your message cannot be sent due to content violation.<h2>");
    }
  }
  fclose($file);
}

  // Display to user what they submitted
?>
  <div id="topbar">Messenger - Catholic Alumni Clubs International</div>
  <div id="heading">Here is what you entered:<br>&nbsp;</div>
  <table class="dataEntryTbl" cellspacing="0" summary="message to be sent">
    <tr>
      <td class="leftCol">To:</td>
      <td class="rightCol" id="addresseeCell"><?php echo $recipient; ?></td>
    </tr>
    <tr>
      <td class="leftCol">Your Name:</td>
      <td class="rightCol"><?php echo stripslashes($inpName); ?></td>
    </tr>
    <tr>
      <td class="leftCol">Your e-mail:</td>
      <td class="rightCol"><?php echo $inpEmail; ?></td>
    </tr>
    <tr>
      <td class="leftCol">Subject:</td>
      <td class="rightCol"><?php echo stripslashes($inpSubject); ?></td>
    </tr>
    <tr valign="top">
      <td class="leftCol">Message:</td>
      <td class="rightCol"><div class="showMessageText"><?php echo str_replace("\n", "<br>", stripslashes($taMessage)); ?></div></td>
    </tr>
  </table>
  <p class="finalInstrs">If OK, click Send. To make changes, click Go Back.</p>
<?php

// inpName field - Remove "," and  ";" (problems when sending e-mail with those characters in name).
$nameRegexp = "/[,;]/";
$inpName = preg_replace($nameRegexp, "", $inpName);

// taMessage field - Strip any whitespace at beginning and end of message
// (a newline character is added within the <form> for output readability).
$taMessage = trim($taMessage);

// Send valid user-entered data to e-mail script, upon user click on Send button
?>
<form id="submitForm" name="submitForm" method="post" enctype="text/html" onSubmit="javascript:this.action=subAct;">
  <input type="hidden" name="recipient" value="<?php echo $recipient; ?>">
  <input type="hidden" name="inpName" type="text" value="<?php echo stripslashes($inpName); ?>">
  <input type="hidden" name="inpEmail" type="text" value="<?php echo $inpEmail; ?>">
  <input type="hidden" name="inpSubject" type="text" value="<?php echo stripslashes($inpSubject); ?>">
  <input type="hidden" name="taMessage" type="text" value="<?php echo "\n" . stripslashes($taMessage); ?>">
  <input type="hidden" name="cbEmailNone" type="text" value="<?php echo $cbEmailNone; ?>">
  <button id="btnSubmitLeft" type="submit">Send</button>
  <button id="btnBackRt" type="button" onClick="javascript:window.history.back();">Go Back</button>
</form>
<?php
}  // END: if...else (!is_object($e) && isset($_POST['posted']))
?>

<!-- END Main Content -->

</body>
</html>