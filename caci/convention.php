<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>CACI - Travel - National Convention &amp; Regional Weekends</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="author" content="John Hredzak">
<link type="text/css" rel="stylesheet" href="caci.css">

<?php
// ********* INSTRUCTIONS FOR EDITING CONVENTION/WEEKENDS CONTENT ON THIS PAGE: ************
// Edit convention & weekend info in file /data/contactdata.csv.
// May use spreadsheet (e.g. MS Excel) or text editor.
// See file /data/data-README.txt for more info.
// Save weekend info in folder /convention/YYYY (YYYY=year of weekend).
// Leave out "http://www.caci.org" and start with "./convention/YYYY".
// DO NOT MAKE ANY UPCOMING WEEKEND OR CONVENTION INFO EDITS TO THIS FILE!
// ********* end INSTRUCTIONS ************

// Include user-defined PHP function library
include("./caci_library.php");
?>

<style type="text/css">
#mainInitPar {
  margin: -15px 0px 9px;
  font-style: italic;
  }
#mainTableCalndr {
  text-align: center;
  font-size: 13px;
  border: solid #999999;
  border-width: 1px 1px 0;
  background: #ccffcc;
  }
#mainTableCalndr td, #mainTableCalndr th {
  border: solid #999999;
  border-width: 0 0 1px 0;
  padding: 2px 8px;
  height: 24px;
  }
#mainTableCalndr th {
  color: #ffffff;
  background: #008000;
  padding: 3px;
  }
#mainTableCalndr button {
  width: 36px;
  padding: 0;
  font-family: Arial, Helvetica, sans-serif;
  font-size: 10px;
  font-weight: bold;
  }
#mainImgCalndr {
  float: right;
  margin: -30px 25px 0 10px;
  width: 100px;
  height: 78px;
  }
#mainCalndrInfo {
  font-size: 10px;
  margin: 6px 0 -12px 20px;
  }
#mainImgNC {
  float: left;
  margin-right: 4px;
/*  width: 120px;
  height: 98px;*/
  width: 150px;
  height: 112px;
  }
#mainImgPast {
  float: right;
  width: 150px;
  height: 109px;
  margin: 18px 100px 0 0;
  }
</style>

</head>
<body>

<?php
// Set page title.
$pageTitle = "&nbsp; Travel &bull; National Convention &amp; Regional Weekends";
// Set page ID for highlighted side menu item.
$thisPage = "convention";
// Include common code.
include("./inc_topcode.php");
?>

<!-- Main Content -->
<div id="mainContent">

  <div id="mainMinHeight">&nbsp;</div> <!-- Sets minimum page height and enables needed background fill for short content -->

  <img id="mainImgCalndr" src="./images/travel5680-100.png" alt="travel">

  <p id="mainInitPar" style="margin: -12px 0 15px 25px">Invitation to the CACI Annual Convention and Regional Weekends is extended exclusively to CAC
  members - one of many benefits of CAC membership.</p>

  <h3 id="calendar" class="mainFirst"> Calendar - Convention &amp; Weekends</h3>

  

  <table id="mainTableCalndr" cellspacing="0" align="center" summary="calendar">
    <tr>
      <th>Date</th>
      <th>Region(s)</th>
      <th>Location</th>
      <th>&nbsp;</th>
    </tr>
<?php
// *** Read & write convention/weekend data ***

// NOTE: To update info in the convention/weekends table, see above instructions.
// !! DO NOT MAKE EDITS HERE !!

// Read from file /data/convtndata.csv
$data_file = "./data/convtndata.csv";
$fp = @fopen($data_file, "r");
if ($fp) {
  $record = fgetcsv($fp, 1000, ",");
  $index = 0;
  
  // Write officer info
  while (!feof($fp))
  {
    echo "<tr>\n<td>" .  $record[0] . "</td>\n<td>";
    if ($record[1] == "National Convention")
       echo "<b>" . $record[1] . "</b></td>\n<td><b>";
    else
       echo $record[1] . "</td>\n<td><b>";
    echo $record[2] . "</b></td>\n<td>";
    if ($record[3] == "./conv_natl.php")  // National Convention page
       echo "<button onclick=\"document.location='conv_natl.php';\">INFO</button>";
    elseif ($record[3])  // Any trip having reference to further info
       echo "<button onclick=\"window.open('" . $record[3] . "');\">INFO</button>";
    else  // Any trip without web reference
       echo "&nbsp;";
    echo "</td>\n</tr>\n";
    $record = fgetcsv($fp, 1000, ",");
  }
  fclose($fp);
}
else {  // Could not open file
  echo "<tr><td><b><i>--- ERROR. Please try again later. ---</i></b></td></tr>";
}
?>
  </table>
  
  <div class="clearingRight">&nbsp;</div>

  <p id="mainCalndrInfo">For details, click on "INFO" button.&nbsp;
  (Info won't open? Download <a href="http://get.adobe.com/reader/" target="_blank">Adobe Reader</a>.)</p>
  
  <h3 id="conv">CACI National Convention</h3>

  <p>All CAC members in good standing are invited to the annual CACI National Convention, a weeklong gathering of
  hundreds of CAC members from around the country.</p>

  <p>Begin <b>each day</b> with <b>breakfast</b>. Then join a <b>sightseeing tour</b>, or participate in a <b>sporting
  event</b> such as tennis, volleyball, or golf. Later in the afternoon, attend a <b>celebration of the
  Mass</b>. Afterwards, enjoy a <b>cocktail hour</b> and <b>catered dinner</b>, followed by a <b>dance</b>.&nbsp;
  Close out the night with an <b>after-hours party</b>. Do all this while sharing the warmth of companionship and 
  good cheer with fellow Catholic singles who are CAC members.</p>

  <p><img id="mainImgNC" src="./images/GardenOfTheGods150.jpg" alt="Colorado">For many CACers, this Annual Vacation is the
  highlight of the year! Experience it for yourself.&nbsp;
  See the <a href="conv_natl.php">Annual National Convention Page</a> for details on attending the upcoming Convention.</p>

  <p>CACI also holds its election of officers and conducts its annual business meeting at the Convention.&nbsp;
  Seminars are also held to improve leaders' ability to run their clubs.</p>

  <p>To provide suggestions for future Conventions, or for other inquiries, contact <a 
  href="<?php echo OpenMessenger('CACI General'); ?>">CACI Central</a> or one of the <a 
  href="officers.php">CACI officers</a>.</p>

  <h3 id="wknd">CAC Regional Weekends</h3>

  <p>Regional Weekends provide additional vacation opportunities for CACers, beyond the National Convention.&nbsp;
  CAC chapters host, for their Region, a Weekend full of activities of interest to Catholic singles.&nbsp;
  All CAC members may attend any Regional Weekend.</p>

  <p>See <a href="#calendar">the calendar above</a> for dates and locations of upcoming Regional Weekends. For
  further information, contact <a href="<?php echo OpenMessenger('CACI General'); ?>">CACI Central</a> or 
  one of the Region VP's listed on the <a href="localclubs.php">Local Clubs Page</a>.</p>

  <h3>Past National Conventions</h3>

  <p>Recent National Conventions (click on link for details):</p>

  <img id="mainImgPast" src="./images/MtRushmore150.jpg" alt="Mt. Rushmore">

  <ul class="singleSpace">
<!-- ** Add link for last convention info here. ** -->
<!--    <li><a href="conv201N.php" target="_blank">201N - City, State</a></li> -->    
    <li><a href="conv2015.php" target="_blank">2015 - Providence, Rhode Island</a></li>
    <li><a href="conv2014.php" target="_blank">2014 - Gatlinburg, Tennessee</a></li>
    <li><a href="conv2013.php" target="_blank">2013 - Portland, Oregon</a></li>    
    <li><a href="conv2012.php" target="_blank">2012 - Charleston, South Carolina</a></li>
    <li><a href="conv2011.php" target="_blank">2011 - Rapid City, South Dakota</a></li>
    <li><a href="conv2010.php" target="_blank">2010 - Colorado Springs, Colorado</a></li>
    <li><a href="conv2009.php" target="_blank">2009 - Lake George, New York</a></li>
    <li><a href="conv2008.php" target="_blank">2008 - Anchorage, Alaska</a></li>
    <li><a href="conv2007.php" target="_blank">2007 - San Diego, California</a></li>
    <li><a href="conv2006.php" target="_blank">2006 - Calgary, Alberta</a></li>
    <li><a href="conv2005.php" target="_blank">2005 - Portland, Maine</a></li>
    <li><a href="conv2004.php" target="_blank">2004 - San Antonio, Texas</a></li>
    <li><a href="conv2003.php" target="_blank">2003 - Lake Tahoe, Nevada</a></li>
    <li>2002 - Jekyll Island, Georgia</li>
    <li>2001 - Albuquerque, New Mexico</li>
    <li><a href="conv2000.html" target="_blank">2000 - Halifax, Nova Scotia</a></li>
  </ul>

  <p>Prior Conventions have been held at Hawaii, Cape Cod, San Diego, Vancouver, Seattle, Montreal, Williamsburg,
  Florida, the Bahamas, and other locations.</p>

</div> <!-- /mainContent -->

<?php
// Include common code.
include("./inc_btmcode.php");
?>

</body>
</html>