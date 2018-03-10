<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>CACI - Local Catholic Alumni Clubs</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="John Hredzak">
<link type="text/css" rel="stylesheet" href="caci.css">

<?php
// ********* INSTRUCTIONS FOR EDITING CHAPTER AND PERSON CONTENT ON THIS PAGE: ************
// !! DO NOT MAKE ANY CHANGES TO THIS FILE !!
// Edit all values in file /data/contactdata.csv. May use spreadsheet (e.g. MS Excel) or text editor.
// See file /data/data-README.txt for more info.
// For website addresses, leave out "http://".
// After editing data file, send a test message (to any recipient) to verify that the messaging system
//   is still operational.
// ********* end INSTRUCTIONS ************

// *** Read person and chapter data from file /data/contactdata.csv ***

$data_file = "./data/contactdata.csv";
$fp = @fopen($data_file, "r");
if ($fp) {

  // Get Club Dev Chair
  rewind($fp);
  do $record = fgetcsv($fp, 1000, ",");
     while (($record[0] != "Club Development") && !feof($fp));  // advance to relevant record
  $ClubDevChair = $record[1];
  
  // Get Region VP data
  rewind($fp);
  do $record = fgetcsv($fp, 1000, ",");
     while (($record[0] != "## REGION VP ##") && !feof($fp));  // advance past non-relevant records
  $record = fgetcsv($fp, 1000, ",");  // advance one more
  while ((substr($record[0],0,1) != "+") && !feof($fp))  // get relevant records
  {
     $RegionVPTable[$record[0]] = array ($record[1], $record[2]);
     $record = fgetcsv($fp, 1000, ",");
  }
  
  // Get local chapter data
  rewind($fp);
  do $record = fgetcsv($fp, 1000, ",");
     while (($record[0] != "## CHAPTERS ##") && !feof($fp));  // advance past non-relevant records
  $record = fgetcsv($fp, 1000, ",");  // advance one more
  while ((substr($record[0],0,1) != "+") && !feof($fp))  // get relevant records
  {
     if ($record[2] == 'Eastern')
        $EastChap[$record[0]] = $record[4];
     elseif ($record[2] == 'Midwest')
        $MidwChap[$record[0]] = $record[4];
     elseif ($record[2] == 'Western')
        $WestChap[$record[0]] = $record[4];
     $record = fgetcsv($fp, 1000, ",");
  }

  fclose($fp);
}
else {
  // Could not open file
  $fileErrorMsg = "<br><br><b><i>--- Data ERROR ---<br>
  Please try again later. If problem persists, please <a href=\"./contact.php\">contact us</a>.</i></b><br>";
}
// *** END Read person and chapter data ***

// *** begin FUNCTIONS ***

// ** FUNCTION WriteRegionVPEntry
// Write row with VP info, in Region table
function WriteRegionVPEntry($regionVPTitle)
{
  global $RegionVPTable;
  echo "<tr class=\"regionVP\">\n";
  echo "<td colspan=\"2\">Region VP:<br>";
  echo $RegionVPTable[$regionVPTitle][0] . ' (' . $RegionVPTable[$regionVPTitle][1] . ")</td>\n";
  echo "<td><button onClick=\"" . OpenMessenger($regionVPTitle) . "\">CONTACT</button></td>\n";
  echo "</tr>\n";
}

// ** FUNCTION WriteChapEntries
// Write rows with Chapter info, in Region table
function WriteChapEntries($RegChap)
{
  foreach ($RegChap as $chapName => $chapWebAddr)
  {
    echo "<tr>\n";
    echo "<td>$chapName</td>\n";
    if ($chapWebAddr == "")
      echo "<td>&nbsp;</td>\n";
    else
      echo "<td><button onClick=\"window.open('http://$chapWebAddr');\">WEBSITE</button></td>\n";
    echo "<td><button onClick=\"" .  OpenMessenger($chapName) . "\">CONTACT</button></td>\n";
    echo "</tr>\n";
  }
}
// *** end FUNCTIONS ***

// Include user-defined PHP function library
include("./caci_library.php");
?>

<style type="text/css">
#mainImg1 {
  float: right;
  width: 150px;
  height: 79px;
  margin: -0px 3px 0 4px;
  }
#clubRegLeft {
  float: left;
  width: 270px;
  margin-top: 20px;
  margin-left: 22px;
  }
#clubRegRight {
  float: right;
  width: 270px;
  margin-top: 20px;
  margin-right: 22px;
  }
table.regionList {
  width: 100%;
  margin-bottom: 20px;
  border: 1px solid #999999;
  text-align: left;
  font-size: 12px;
  font-weight: bold;
  }
table.regionList td {
  border: solid #999999;
  border-width: 1px 0 0;
  padding: 2px;
  }
table.regionList th {
  text-align: center;
  font-family: "Century Gothic", Arial, Helvetica, sans-serif;
  font-size: 15px;
  color: #ffffff;
  background: #666666;
  }
table.regionList col.name {
  width: 160px;
  }
table.regionList col.button {
  width: 54px;
  }
table.regionList tr.regionVP {
  background: #e2e2e2;
  font-size: 1.0em;
  font-weight: normal;
  }
table.regionList td.newChapText {
  width: 100%;
  background: #e2e2e2;
  font-weight: normal;
  }
table.regionList button {
  width: 54px;
  height: 17px;
  padding: 0;
  font-family: Arial, Helvetica, sans-serif;
  font-size: 9px;
  font-weight: bold;
  }
#WestRegion {
  background: #D3E5FF;
  }
#WestRegion th {
  background: #0033cc;
  }
#MidwRegion {
  margin-bottom: 5px;
  background: #ccffcc;
  }
#MidwRegion th {
  background: #008000;
  }
#EastRegion {
  background: #F8F8B4;
  }
#EastRegion th {
  background: #804800;
  }
#NewChap {
  background: #FFDADA;
  }
#NewChap th {
  background: #cc0000;
  }
</style>

</head>
<body>

<?php
// Set page title.
$pageTitle = "Local Catholic Alumni Clubs";
// Set page ID for highlighted side menu item.
$thisPage = "localclubs";
// Include common code.
include("./inc_topcode.php");
?>

<!-- Main Content -->
<div id="mainContent">

<div id="mainMinHeight">&nbsp;</div> <!-- Sets minimum page height and enables needed background fill for short content -->

<img id="mainImg1" src="./images/usa3959.gif" alt="USA/CACI">

<p class="mainFirst">Each <a href="about.php">Catholic Alumni Club</a> (CAC) is listed below by Region.</p>

<p><b>Check out the CAC nearest you!</b> Get information on that Club by clicking on its WEBSITE button to
go to its website. Or send them a message via the CONTACT button. You may also contact a Region Vice
President below.</p>

<p><b>Don't have a CAC near you?</b> An <a href="atlarge.php">At-Large Membership</a> is available.</p>

<!-- To update the following info, see above instructions. DO NOT MAKE EDITS HERE! -->
<p><b>Want to start a CAC in your area?</b> Contact CACI Club Development Chairman, <?php echo $ClubDevChair; ?>, 
<a href="<?php echo OpenMessenger('Club Development'); ?>"><b>here</b></a>.
He'll work closely with you to get a CAC in your area up and running.</p>

<!-- ** Write club and VP info with data in file /data/contactdata.csv, obtained above ** -->

<!-- !!! NOTE: To update info in this table, see above instructions !!!
     !!! DO NOT MAKE EDITS HERE !!! -->

<?php if (isset($fileErrorMsg)) echo $fileErrorMsg; ?>

<div id="clubRegLeft">

  <table id="EastRegion" class="regionList" cellspacing="0">
    <colgroup><col class="name"><col class="button"><col class="button"></colgroup>
    <tr><th colspan="3">Eastern Region</th></tr>
    <!-- Auto-generate rows -->
    <?php
      @WriteRegionVPEntry("Eastern Region VP");
      @WriteChapEntries($EastChap);
    ?>
    <!-- END Auto-generate rows -->
  </table>

  <table id="WestRegion" class="regionList" cellspacing="0">
    <colgroup><col class="name"><col class="button"><col class="button"></colgroup>
    <tr><th colspan="3">Western Region</th></tr>
    <!-- Auto-generate rows -->
    <?php
      @WriteRegionVPEntry("Western Region VP");
      @WriteChapEntries($WestChap);
    ?>
    <!-- END Auto-generate rows -->
  </table>

</div> <!-- /clubRegLeft -->

<div id="clubRegRight">

  <table id="MidwRegion" class="regionList" cellspacing="0">
    <colgroup><col class="name"><col class="button"><col class="button"></colgroup>
    <tr><th colspan="3">Midwestern Region</th></tr>
    <!-- Auto-generate rows -->
    <?php
      @WriteRegionVPEntry("Midwest Region VP");
      @WriteChapEntries($MidwChap);
    ?>
    <!-- END Auto-generate rows -->
  </table>

</div> <!-- /clubRegRight -->

<div class="clearing">&nbsp;</div>

</div> <!-- /mainContent -->

<?php
// Include common code.
include("./inc_btmcode.php");
?>

</body>
</html>