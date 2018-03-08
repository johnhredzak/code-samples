<!-- ***** BEGIN Bottom Include ***** -->
<!-- Left Bar / Side Menu -->
<?php
// For highlighting of menu item corresp. to currently displayed page, set ID to value "smThisPage".
$pageAry = array (
"about" => "",
"offerings" => "",
"localclubs" => "",
"atlarge" => "",
"memreq" => "",
"convention" => "",
"conv_natl" => "",
"communique" => "",
"officers" => "",
"scholarship" => "",
"forms" => "",
"pics" => "",
"links" => "",
"contact" => ""
);
foreach ($pageAry as $page => $pageTDIDAttr)
{
  if ($thisPage == $page)   // $thisPage is initialized in current page's code
    $pageAry[$page] = ' id="smThisPage"';
}
?>
<div id="leftBar">
  <table id="sideMenu" cellspacing="0" summary="left menu">
    <tr><td><a href="index.php">Home</a></td></tr>
    <tr><td<?php echo $pageAry["about"]; ?>><a href="about.php">About CACI &amp; CAC</a></td></tr>
    <tr><td<?php echo $pageAry["offerings"]; ?>><a href="offerings.php">What CAC Offers</a></td></tr>
    <tr><td<?php echo $pageAry["localclubs"]; ?>><a href="localclubs.php">Local Catholic Alumni Clubs</a></td></tr>
    <tr><td<?php echo $pageAry["atlarge"]; ?>><a href="atlarge.php">At-Large Membership</a></td></tr>
    <tr><td<?php echo $pageAry["memreq"]; ?>><a href="memreq.php">Membership Criteria</a></td></tr>
    <tr><td<?php echo $pageAry["convention"]; ?>><a href="convention.php">Convention &amp; Weekends</a></td></tr>
    <tr><td<?php echo $pageAry["conv_natl"]; ?> class="indent"><a href="conv_natl.php">Annual National Convention</a></td></tr>
    <tr><td<?php echo $pageAry["communique"]; ?>><a href="communique.php"><i>Communiqu&eacute;</i> Newsletter</a></td></tr>
    <tr><td<?php echo $pageAry["officers"]; ?>><a href="officers.php">CACI Officers</a></td></tr>
    <tr><td<?php echo $pageAry["scholarship"]; ?>><a href="scholarship.php">Scholarship Fund</a></td></tr>
    <tr><td<?php echo $pageAry["forms"]; ?>><a href="forms.php">Award Forms</a></td></tr>
    <tr><td<?php echo $pageAry["pics"]; ?>><a href="pics.php">Pics</a></td></tr>
    <tr><td<?php echo $pageAry["links"]; ?>><a href="links.php">Links</a></td></tr>
    <tr><td<?php echo $pageAry["contact"]; ?> class="last"><a href="contact.php">Contact Us</a></td></tr>
  </table>
</div> <!-- /leftBar -->

<!-- Bottom Menu -->
<div id="btmMenu">
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="about.php">About</a></li>
    <li><a href="offerings.php">Benefits</a></li>
    <li><a href="localclubs.php">Local CAC's</a></li>
    <li><a href="convention.php">Travel</a></li>
    <li class="last"><a href="contact.php">Contact</a></li>
  </ul>
</div> <!-- /btmMenu -->

</div> <!-- /midWrapper -->

<!-- Footer -->
<div id="footer">
  &copy; <?php echo date('Y'); ?> Catholic Alumni Clubs International
</div> <!-- /footer -->

</div> <!-- /page -->
<!-- ***** END Bottom Include ***** -->
