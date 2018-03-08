<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>CACI - CAC At-Large Membership</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="John Hredzak">
<link type="text/css" rel="stylesheet" href="caci.css">

<?php
// *** Read At-Large Membership Chair data from file /data/contactdata.csv
// To update this info, edit the above file. For instruction, see /data/data-README.txt.
$contact_file = "./data/contactdata.csv";
$fp = @fopen($contact_file, "r");
if ($fp) {
   do $record = fgetcsv($fp, 1000, ",");
      while (($record[0] != "At-Large Membership") && !feof($fp));  // advance to At-Large Membership Chair record
   $AtLargeChair = $record[1];
   fclose($fp);
}
else {  // Could not open file
   $AtLargeChair = "<b><i>--- ERROR. Please try again later. ---</i></b>";
}

// Include user-defined PHP function library
include("./caci_library.php");
?>

<style type="text/css">
#mainImg1 {
  float: left;
  width: 92px;
  height: 93px;
  border: 5px ridge #d8f0ff;
  margin: 0 15px 5px 0;
  background: #e8f6ff;
  }
</style>

</head>
<body>

<?php
// Set page title.
$pageTitle = "CAC At-Large Membership";
// Set page ID for highlighted side menu item.
$thisPage = "atlarge";

// Include common code.
include("./inc_topcode.php");
?>

<!-- Main Content -->

<div id="mainContent">

  <div id="mainMinHeight">&nbsp;</div> <!-- Sets minimum page height and enables needed background fill for short content -->
  
  <img src="./images/booth.jpg" height="200" title="caci members" align="right" vspace="5px" hspace="10px">

  <p class="mainFirst"><b>Don't live near a <a href="localclubs.php">local CAC chapter</a>?</b> You still have
  the opportunity be a part of the nationwide CAC community and take part in its activities by becoming a <b>CAC At-Large
  Member</b>.</p>

  <p><b>Benefits of At-Large Membership:</b></p>

  <ul>
    <li>Enjoy <a href="convention.php">CACI National Conventions and CAC Regional Weekends</a>. Vacation with 
    fellow CAC members throughout the country.</li>
    <li>Attend <a href="offerings.php">activities of a local CAC</a> at member rates when you're in their area.</li>
    <li>Receive <i><a href="communique.php">The Communiqu&eacute;</a></i>, the CACI Newsletter, by mail.</li>
    <li>Receive a Membership Card that identifies you as a CAC member.</li>
    <li>Meet single Catholic college graduates from all over the USA.</li>
    <li>Receive direct mailings of National Convention information and registration forms.</li>
    <li>Receive direct mailings of all Regional Weekend information.</li>
    <li>Option to become an active part of the CACI Board.</li>
  </ul>

  <p><b>Who can join?</b> Anyone not living near a CAC chapter who meets <a href="memreq.php">CAC membership 
  requirements</a>.</p>

  <p><a href="atlgmemapp.pdf" target="_blank"><img id="mainImg1" src="./images/pencil.gif" alt="Apply"></a>
  <b>To join:</b> Click on the graphic to the
  left, print and fill out the application, and mail it as requested. Dues are $25 per year.</p>

  <p style="font-size: 10px;">(Can't view application? Download <a href= 
  "http://get.adobe.com/reader/" target="_blank">Adobe Reader</a>.)</p>

  <!-- To update the following info, edit file /data/contactdata.csv.
       For instructions, see file /data/data-README.txt. DO NOT MAKE EDITS HERE! -->
  <p><b>For more information:&nbsp;</b> Send a message to <?php
  echo $AtLargeChair . ' <a href="' . OpenMessenger('At-Large Membership'); 
  ?>"><b>here</b></a>.</p>

</div> <!-- /mainContent -->

<?php
// Include common code.
include("./inc_btmcode.php");
?>

</body>
</html>