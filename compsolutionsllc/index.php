<?php

// Set page-specific <head> values
$page_title = "Comp Solutions, LLC - Solving Your Computer Problems";
$meta_description = "";
$meta_keywords = "";

// Identify group this page belongs to
$this_page_group = "index";

// Add any local page styles

$page_style_spec = '

/* *** PAGE *** */
#page {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 12px;
  color: #000000;
}
#center {
  width: 100%;
  margin: 0 0 -12px 0; 
  padding: 12px 12px 0 12px;      
}
#main {
  width:100%;
}
#right, #sidebar {
  display: none;
  width: 0;
  padding: 0;
  margin: 0;        
}

/* *** INTRO *** */
#intro {
  width: 854px;
  color: #ffffff;
  background: #505050 url(images/homebg-pcboard.jpg) repeat-y scroll right center;
}
div.introText {
  width: 420px;
  height: 120px;
  padding: 3px 0 5px 18px;
  color: #f6f6ff;
  background: #505050;
  font: normal 17px Arial, Helvetica, sans-serif;
}
div.introText p {
  text-align: center;
  line-height: 1.5em;
}
div.introText em {
  color:#FFEFCC;
  font-style: italic;
  font-weight: normal;
}

/* *** SERVICES *** */
#servicesWrapper {
  position: relative;
  width: 100%;
}
div.services {
  position:relative;
  float: left;
  width: 184px;
  height: 260px;
  margin: 12px 12px 12px 0;
  border: 1px solid #ccc;
  padding: 6px 9px;
  color: #000000;  
  background: #ebebeb;
  text-align: justify;
  font-size: 12px;
  cursor: default;
}
.lastSvc {
  margin-right: 0;
}
div.services h3 {
  margin: 12px 15px 17px 0;
  color: #324DA4;
  text-align: left;
  font-size: 15px;    
}
div.services p {
  margin: 12px 0;
}
img.svcsSymbol {
  float: right;
  margin: -13px -17px 0 0;
  text-align: right;
}

/* *** QUALITIES *** */
#qualitiesWrapper {
  clear: both;
  position: relative;
  top: 0;
  left: 0;
  width: 846px;
  height: 225px;
  border: 1px solid #ccc;
  padding-right: 5px;
  color: #000000;
  background: #fff4d8; /*#FFEFCC*/
}
div.qualities {
  float: left;
  width: 287px;
  margin-left: -9px;
  padding: 0;
  font-size: 12px;
}
div.qualities h3 {
  margin: 9px 10px 0 25px;
  color: #6d4c00;
  text-align: left;
  font-size: 13px;
}
#qualitiesWrapper div.qualities ul li {
  margin: 8px 0;
}
.qualSeparator {
  float: left;
  margin-top: 12px;
  border-right: 1px solid #ccc;
  width: 1px;
  height: 85%;
}
ul.qualStretch li {
  line-height: 1.4em;
  padding-bottom: 4px;
}

/* *** SUMMARY *** */
.summary {
  clear: both;
  padding: 15px 0 5px;
  width: 850px;
  color: #242E60;
  background-color: #ffffff;
  text-align: center;
  font-family: Arial, Helvetica, sans-serif;
  font-size: 13px;
  font-weight: bold;
  font-style: italic;
}

/* *** BOX CORNERS *** */
.corner6 {
  position: absolute;
  height: 6px;
  width: 6px;
}
.cLeft {left: -1px;}
.cRight {right: -1px;}
.cTop {top: -1px;}
.cBottom {bottom: -1px;}
';

// Include common code above main content
// (Required - do not modify)
include("master_topcode.php");
?>

<!-- Main Content -->

<?php
// Set a string to write tags for box corners
$write_corners_img_tags = 
'    <img src="images/corner6-tl.png" alt="" class="corner6 cLeft cTop" />
    <img src="images/corner6-tr.png" alt="" class="corner6 cRight cTop" />
    <img src="images/corner6-br.png" alt="" class="corner6 cRight cBottom" />
    <img src="images/corner6-bl.png" alt="" class="corner6 cLeft cBottom" />
'
?>
<div id="intro">
  <div class="introText">
    <p style="text-align:center">Comp Solutions, LLC provides<br />
    <em>quality</em>, <em>prompt</em> and <em>affordable</em><br />
    computer services<br />
    to Pittsburgh area small businesses.
    </p>
  </div>
</div>

<script type="text/javascript" language="JavaScript">
var hoverBgColor = '#ffe7aa';
var normalBgColor;

function serviceHover(obj)
{
  normalBgColor = obj.style.backgroundColor;
  obj.style.backgroundColor = hoverBgColor;
}
function serviceNoHover(obj)
{
  obj.style.backgroundColor = normalBgColor;
}
function serviceClick(url)
{
  location.href = url;
}
</script>

<div id="servicesWrapper">

  <div class="services" onmouseover="serviceHover(this);" onmouseout="serviceNoHover(this);" 
  onclick="serviceClick('security.php')">
<?php echo $write_corners_img_tags; ?>
    <h3>Computer Security
    <img src="images/sym-lock.png" alt="lock" class="svcsSymbol" width="30" height="45" /></h3>
    <p><em>Concerned about your company's computer and network security?</em></p>
    <p>We select and configure the optimal hardware and software to assure adequate protection.</p>
    <p>Increase productivity and achieve work-life balance by providing employees with secure remote access.</p>
  </div>
  
  <div class="services" onmouseover="serviceHover(this);" onmouseout="serviceNoHover(this);" 
  onclick="serviceClick('networks.php')">
<?php echo $write_corners_img_tags; ?>
    <h3>Networks
    <img src="images/sym-network.png" alt="network" class="svcsSymbol" width="55" height="45" /></h3>
  <p><em>Looking to establish or improve your computer network?</em></p>
  <p>Share your computing resources &ndash; and lower costs &ndash; through a secure wired and/or 
  wireless network.</p>
  <p><em>Does your business need a server?</em></p>
  <p>We ask the right questions to help you make that important decision.</p>
  </div>
  
  <div class="services" onmouseover="serviceHover(this);" onmouseout="serviceNoHover(this);" 
  onclick="serviceClick('support.php')">
<?php echo $write_corners_img_tags; ?>
    <h3>Technical Support
    <img src="images/sym-computer.png" alt="computer" class="svcsSymbol" width="48" height="45" /></h3>
    <p><em>Is your company plagued by excessive computer downtime or slow performance?</em></p>
    <p><em>Looking for a less expensive alternative to new equipment purchases?</em></p>
    <p>We solve your computer problems &ndash; quickly and affordably &ndash; through computer 
    troubleshooting, tune-up and repair.</p>
  </div>
  
  <div class="services" onmouseover="serviceHover(this);" onmouseout="serviceNoHover(this);" 
  onclick="serviceClick('data_services.php')">
<?php echo $write_corners_img_tags; ?>
    <h3>Data Services
    <img src="images/sym-dvd.png" alt="disk" class="svcsSymbol" width="45" height="45" /></h3>
    <p><em>Looking to assure integrity of your valuable data, with utmost certainty and minimal 
    effort?</em></p>
    <p>We implement proactive measures &ndash; data backup, data migration, disk cloning and data recovery
    &ndash; to prevent system failure and loss of critical data.</p>
  </div>

</div>  <!-- /servicesWrapper -->

<div id="qualitiesWrapper">
<?php echo $write_corners_img_tags; ?>

  <div class="qualities">
    <h3>Quality:</h3>
    <ul class="qualStretch">
      <li>Quality service to our clients is assured by our experienced, dedicated professionals.</li>  
      <li>We are not affiliated with any hardware or software companies. We make unbiased 
      recommendations and implement the best solution for your needs.</li>
    </ul>
  </div>
  <div class="qualSeparator"> </div>

  <div class="qualities">
    <h3>Prompt:</h3>
    <ul class="qualStretch">
      <li>Our on-site response time is typically less than two hours.</li>  
      <li>We can service your system instantly with remote access.</li>  
      <li>Your phone inquiries are handled immediately.</li>
    </ul>
  </div>
  <div class="qualSeparator"> </div>

  <div class="qualities">
    <h3>Affordable:</h3>
    <ul>
      <li>We emphasize value (quality, service and cost). </li>  
      <li>Our services are an affordable alternative to a dedicated Information Technology (IT) staff.</li>  
      <li>Your computer assets are a significant investment. We optimize your system and show you how to take full
      advantage of it.</li>  
      <li>We save you time and money by guarding against system / network failures and loss of valuable data.</li>
    </ul>
  </div>  <!-- /qualitiesWrapper -->
 
</div>

<div class="summary">
  Leave the computer problems to us &ndash; so you can run your business.
</div> 

<!-- end Main Content -->

<?php
  // Include common code below main content
  // (Required - do not modify)
  include("master_btmcode.php");
?>
