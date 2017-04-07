<?php
// INITIAL PROCESSING - Define menus

// Menu text definition for pages:
// If main menu and side menu text differ for any page element of this array,
// make the element an array (of this array) and add the text for the main menu listing
// as the second (alternative) element.
// Example: "support" => array ("Technical Support", "Tech Support")
$page_menu_text = array (
"index" => "Home",
"security" => "Computer Security",
"remote" => "Remote Access",
"networks" => "Networks",
"servers" => "Servers",
"support" => array ("Technical Support", "Tech Support"),
"troubleshooting" => "Computer Troubleshooting",
"tuneup" => "Computer Tune-up",
"repair" => "Computer Repair",
"reconditioned" => "Reconditioned Computers",
"data_services" => "Data Services",
"data_backup" => "Data Backup",
"data_migration" => "Data Migration",
"disk_cloning" => "Disk Cloning",
"data_recovery" => "Data Recovery",
"about" => "About Us",
"testimonials" => "Testimonials"
);
// Menu groups definition
$site_groups = array (
"index" => array ("index"),
"security" => array ("security", "remote"),
"networks" => array ("networks", "servers"),
"support" => array ("support", "troubleshooting", "tuneup", "repair", "reconditioned"),
"data_services" => array ("data_services", "data_backup", "data_migration", "disk_cloning", "data_recovery"),
"about" => array ("about", "testimonials")
);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
  <head>
    <title><?php echo $page_title; ?></title>
    <meta name="description" content="<?php echo $meta_description; ?>" />
    <meta name="keywords" content="<?php echo $meta_keywords; ?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <link id="theme" rel="stylesheet" type="text/css" href="style.css" title="theme" />
    <script src="scripts.js" type="text/javascript" language="JavaScript"></script>
    <style type="text/css">
      <?php echo $page_style_spec; ?>
    </style>
  </head>
  <body>
    <div id="wrapper"> 
      <div id="headerWrapper"> 
        <div id="header">
        <a href="http://www.compsolutionsllc.net/"><img id="csbanner" src="images/csbanner.png" 
        alt="Comp Solutions, LLC - Solving Your Computer Problems" title="" /></a>
          <div id="phone_no">412-551-0361</div>
        </div><!-- /header -->
      </div><!-- /headerWrapper -->
      <div id="pageWrapper"> 
        <div id="page"> 
<!-- Top Navigation -->
          <div id="nav1"> 
            <ul>
<?php
// Write top menu
$m_index = 0;  // Mouseover index
foreach ($site_groups as $menu_item)
{
  $m_index = $m_index + 1;
  $first_item = $menu_item[0];
  $menu_item_href = $first_item . '.php';
  // If alternative text for top nav is specified, list second [1] instead of first [0]   
  if (is_array($page_menu_text[$first_item]))
    $menu_item_text = $page_menu_text[$first_item][1];
  else
    $menu_item_text = $page_menu_text[$first_item];
  // Write menu text and link; highlight if menu item belongs to page's group
  if ($this_page_group == $first_item)
//      echo "<li id=\"current\" style=\"border:none\">\n";
    echo "<li id=\"current\">\n";                // ??? Took out border="none". What purpose does it serve???
  else
    echo "<li>\n";
  echo "  <a href=\"$menu_item_href\" shape=\"rect\"";
  if (sizeof($menu_item) > 1)  // mouseover submenu for this menu item?
     echo " onmouseover=\"mopen('m$m_index')\" onmouseout=\"mclosetime()\"";
  echo ">$menu_item_text</a>\n";
  if (sizeof($menu_item) > 1)  // mouseover submenu for this menu item?
  {
    echo "  <div id=\"m$m_index\" class=\"momenu\" onmouseover=\"mcancelclosetime()\" onmouseout=\"mclosetime()\">\n";
    
    // Write mouseover submenus
    $is_first_subitem = true;
    foreach ($menu_item as $submenu_item)
    {
       if ($is_first_subitem)
          $is_first_subitem = false;
       else
       {
          $submenu_item_href = $submenu_item . '.php';
          $submenu_item_text = $page_menu_text[$submenu_item];
          echo "  <a href=\"$submenu_item_href\">$submenu_item_text</a>\n";
  //      echo "  <a href=\"$submenu_item_href\" shape=\"rect\">$submenu_item_text</a>\n";
       }
    }
    echo "  </div>\n";
  }
  echo "</li>\n";
}
?>
            </ul> 
          </div><!-- /nav1 -->
<!-- end Top Navigation -->
          <!-- Content -->  
          <div id="content"> 
            <div id="center"> 
              <div id="main"> 
<!-- ***** end Master Top Code Include ***** -->