<!-- ***** BEGIN Master Bottom Code Include ***** -->
                <p style="clear:both" /> 
              </div><!-- /main -->
            </div><!-- /center -->
            <!-- Right Sidebar --> 
            <div id="right">
              <div id="sidebar"> 
<!-- Side Navigation -->
                <ul class="vmenu">
<?php 
// Write right side menu items
$first_item = true;
// File (page) name of current PHP page, without path (e.g. "index.php")
$current_page = substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'],'/') + 1);
foreach ($site_groups[$this_page_group] as $menu_item)
{
   $menu_item_href = $menu_item . '.php';
   // In case alternative text is specified for top nav
   if (is_array($page_menu_text[$menu_item]))
      $menu_item_text = $page_menu_text[$menu_item][1];
   else
      $menu_item_text = $page_menu_text[$menu_item];
   echo "<li";
   if ($first_item) {  // top-level page
      echo " class=\"smheading\"";
      $first_item = false;
   }
   elseif ($menu_item_href == $current_page)
      echo " class=\"currentPage\"";
   echo ">\n";
   echo "  <a href=\"$menu_item_href\" shape=\"rect\">$menu_item_text</a>\n";
   echo "</li>\n";
}
?>
                </ul>
<!-- end Side Navigation -->
                <div id="sidePicSpace"> 
                  <img src="images/pic-network.png" id="sidePic1" alt="" />  
                </div><!-- /sidePicSpace -->
              </div><!-- /sidebar -->
            </div><!-- /right -->
            <div class="clear"></div>
          </div><!-- /content --> 
        </div><!-- /page --> 
      </div><!-- /pageWrapper -->
<!-- Footer -->
      <div id="footerWrapper"> 
        <div id="footer"> 
          <p>&copy; Comp Solutions, LLC &nbsp;&bull;&nbsp; 32 Brushy Ridge Court &nbsp;&bull;&nbsp;
          Pittsburgh, PA 15239 &nbsp;&bull;&nbsp; 412-551-0361 &nbsp;&bull;&nbsp; service@compsolutionsllc.net</p> 
        </div><!-- /footer -->
      </div><!-- /footerWrapper -->
<!-- end Footer -->
    </div><!-- /wrapper -->
  </body>
</html>
