<?php

// Set page-specific <head> values
$page_title = "Comp Solutions, LLC - Reconditioned Computers";
$meta_description = "";
$meta_keywords = "";

// Identify group this page belongs to
$this_page_group = "support";

// Add any local page styles
$page_style_spec = '
  .items {
    font-family: Verdana, Geneva, sans-serif;
    font-size: 12px;
  }
';

// Include common code above main content
// (Required - do not modify)
include("master_topcode.php");
?>

<!-- Main Content -->

<h1>Reconditioned Computers</h1>

<div class="items">
<?php
// Read list from text file specified here:
$data_file = "reconditioned.txt";
if (file_exists($data_file))
{
   $fp = fopen($data_file, "r");
   echo "<br />";
   while (!feof($fp))
   {
      echo fgets($fp) . "<br />";
   }
   fclose($fp);
}
else
{    
   echo "<br />Unable to access this information. Please contact us.<br />";
}
echo "\n";
?>
</div><!-- /items -->

<!-- end Main Content -->

<?php
  // Include common code below main content
  // (Required - do not modify)
  include("master_btmcode.php");
?>
