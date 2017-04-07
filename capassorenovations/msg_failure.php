<?php

// BEGIN Page-specific <head> values
$page_title = "Capasso Renovations - Unable to send message";
$meta_description = "";

// Add any local page styles
$page_style_spec = '
.mainText {
  text-align: center;
  font-weight: bold;
  font-size: 125%;
  font-style: italic;
  color:#ff0000;
  margin: 100px;
  line-height: 1.6em;
}
';
// END Page-specific <head> values

// Include common code above main content
// (Do not modify this line)
include("master_topcode.php");
?>

<!-- MAIN CONTENT -->

<p class="mainText">Unable to send your message.<br />
Please try again later, or contact us via e-mail:<br />
<script type="text/javascript" language="JavaScript">
  {WriteEmailLink("info", "capassorenovations", "com");}
</script>
</p>
<p style="text-align: center;"><a href="index.php">Home Page</a><br />
<a href="gallery.php">Our Work</a></p>

<!-- end MAIN CONTENT -->

<?php
// Include common code below main content
// (Do not modify this line)
include("master_btmcode.php");
?>
