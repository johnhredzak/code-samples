<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>CACI - Officers</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="John Hredzak">
<link type="text/css" rel="stylesheet" href="caci.css">

<?php
// ********* INSTRUCTIONS FOR EDITING OFFICERS INFO ON THIS PAGE: ************
// !! DO NOT MAKE ANY CHANGES TO THIS FILE !!
// Edit all values in file /data/contactdata.csv. May use spreadsheet (e.g. MS Excel) or text editor.
// See file /data/data-README.txt for more info.
// After editing data file, send a test message (to any recipient) to verify that the messaging system
//   is still operational.
// ********* end INSTRUCTIONS ************

// *** Read officer data from file /data/contactdata.csv ***

$contact_file = "./data/contactdata.csv";
$fp = @fopen($contact_file, "r");
if ($fp) {
  do $record = fgetcsv($fp, 1000, ",");
     while (($record[0] != "## OFFICERS ##") && !feof($fp));  // advance past non-relevant records
  $record = fgetcsv($fp, 1000, ",");  // advance one more
  $yearStr = $record[0];  // read year of office
  $record = fgetcsv($fp, 1000, ",");  // advance one more
  while ((substr($record[0],0,1) != "#") && !feof($fp))  // get officer person, club, and contact data
  {
     $officersTable[$record[0]] = array ($record[1], $record[2]);
     $record = fgetcsv($fp, 1000, ",");
  }
  fclose($fp);
  }
else { // Could not open file
  $fileErrorMsg = "<br><br><b><i>--- Data ERROR ---<br>
  Please try again later. If problem persists, please <a href=\"./contact.php\">contact us</a>.</i></b><br>";
}

// *** END Read officer data ***

// Include user-defined PHP function library
include("./caci_library.php");
?>

<style type="text/css">
#mainLeft {
  float: left;
  width: 414px;
  margin: 10px 0 0 10px;
  text-align: center;
  }
#mainRight {
  float: right;
  width: 180px;
  margin: 10px 10px 0 0;
  text-align: center;
  }
#mainTable {
  width: 390px;
  margin-bottom: 20px;
  border: solid #999999;
  border-width: 1px 1px 0;
  background: #ffffcc;
  text-align: center;
  font-size: 13px;
  }
#mainTable td, #mainTable th {
  border: solid #999999;
  border-width: 0 0 1px 0;
  }
#mainTable th {
  padding: 3px 0;
  color: #ffffff;
  background: #996600;
  }
#mainTable .smallText {
  font-size: 10px;
  font-weight: normal;
  }
#mainTable button {
  width: 60px;
  padding: 0;
  font-family: Arial, Helvetica, sans-serif;
  font-size: 10px;
  font-weight: bold;
  }
#mainImg1 {
  width: 150px;
  height: 88px;
  margin: 20px 0 20px;
  }
</style>

</head>
<body>

<?php
// Set page title.
$pageTitle = "CACI Officers for " . $yearStr;
// Set page ID for highlighted side menu item.
$thisPage = "officers";
// Include common code.
include("./inc_topcode.php");
?>

<!-- Main Content -->
<div id="mainContent">

<div id="mainMinHeight">&nbsp;</div> <!-- Sets minimum page height and enables needed background fill for short content -->

<?php  ?>

<div id="mainLeft">

  <table id="mainTable" cellspacing="0" align="center">
    <tr>
      <th>Office</th>
      <th>Name</th>
      <th>&nbsp;</th>
    </tr>
<?php
// *** Generate main content of table from data file
// NOTE: To update info in this table, see above instructions.
// !! DO NOT MAKE EDITS HERE !!
if (isset($fileErrorMsg))
  echo $fileErrorMsg;
else {
  foreach ($officersTable as $office => $officerData)
  {
    echo "<tr>\n";
    echo "<td>$office</td>\n";
    echo "<td>$officerData[0]<br><span class=\"smallText\">($officerData[1])</span></td>\n";
    echo "<td><button onClick=\"" . OpenMessenger($office) . "\">CONTACT</button></td>\n";
    echo "</tr>\n";
  }
}
?>
  </table>

  <p style="font-size: 11px; margin-top: 0;">To contact an officer, click on their respective "CONTACT" button.</p>

</div> <!-- /mainLeft -->

<div id="mainRight">

  <img id="mainImg1" src="./images/meeting3239.gif" alt="board">

  <p style="margin-top: 0;">The term of office is one year beginning October 1.</p>

</div> <!-- /mainRight -->

</div> <!-- /mainContent -->

<?php
// Include common code.
include("./inc_btmcode.php");
?>

</body>
</html>