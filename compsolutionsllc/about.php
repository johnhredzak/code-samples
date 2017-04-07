<?php

// Set page-specific <head> values
$page_title = "Comp Solutions, LLC - About Us";
$meta_description = "";
$meta_keywords = "";

// Identify group this page belongs to
$this_page_group = "about";

// Add any local page styles
$style_spec = '
  .strongLink {
    font-weight:bold;
    font-size: 110%;
  }
';

// Include common code above main content
// (Required - do not modify)
include("master_topcode.php");
?>

<!-- Main Content -->

    <h1>About Us</h1>
    <p>Comp Solutions, LLC is a company that provides a wide range of computer services to small businesses 
    throughout the Pittsburgh area. In addition to servicing our customers on-site, we 
    solve computer problems through remote access. We have been in business and a part of the Greater Pittsburgh 
    business community since 2000.
    </p>
    <p>Our slogan is, "Solving Your Computer Problems." We emphasize value (quality, service and cost). 
    Comp Solutions appreciates the opportunity to be your IT service provider.
    </p>
    <h2>Why choose us?</h2>
    <ul>  
      <li>We are experienced, dedicated professionals providing quality service to our clients.
      </li>  
      <li>Comp Solutions is not affiliated with any hardware or software companies. 
      Our independence allows us to make unbiased recommendations for your particular needs.
      </li>  
      <li>Comp Solutions promptly responds to your needs. 
      On-site response time is typically less than two hours. 
      We answer or return your phone calls immediately.
      </li>  
      <li>Our professionals focus on solving your computer problems, freeing you to run your business!
      </li>
    </ul>
    <h2><a href="testimonials.php">Testimonials</a></h2>
    <p>
      <a href="testimonials.php" class="strongLink">See what our customers say about us.</a>
    </p>  

<!-- end Main Content -->

<?php
  // Include common code below main content
  // (Required - do not modify)
  include("master_btmcode.php");
?>
