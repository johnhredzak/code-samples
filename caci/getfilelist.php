<?php
// Returns list of files in directory, in JSON format

$year = $_GET['year'];
$dir = "./downloads/$year/";
$dirList = array();

// Open and read directory; output all but current & parent dir ref.
if (!($dp = opendir($dir))) die("Cannot open $dir.");
while ($file = readdir($dp))
   if ($file != '.' && $file != '..')
      array_push($dirList, $file);
sort($dirList);
// Put in JSON format expected by AngularJS
$outString = '{ "fileList":' . json_encode($dirList) . '}';
echo $outString;
closedir($dp);
?>