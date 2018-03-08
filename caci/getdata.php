<?php

// Function to assemble data for use by AngularJS
function finalJsonFormat($dataset, $jsonData) {
   return "{\"$dataset\":$jsonData}";
}

// Outputs JSON data from CSV file 
function writeJsonFromCsv($dataset, $dataFile, $keysArray) {
   // Initialize
   $dataFile = "./data/$dataFile.csv";
   $tableArray = array ();
   // Open file
   $fp = fopen($dataFile, 'r');
   if ($fp) {
      $recordIn = fgetcsv($fp, 1000, ',');
      // For each record, add CSV data to an associative array
      while (!feof($fp)) {
        // Accommodate data whose field(s) at end of record are not to be transmitted (e.g. email)
        if (count($keysArray) < count($recordIn))
           array_splice($recordIn, count($keysArray));
        $recordArray = array_combine($keysArray, $recordIn);
        array_push($tableArray, $recordArray);
        $recordIn = fgetcsv($fp, 1000, ',');
      }
      fclose($fp);
      // Write array data in JSON format
      $jsonData = json_encode($tableArray, JSON_UNESCAPED_SLASHES);
      // Send data
      echo finalJsonFormat($dataset, $jsonData);
   }
   else {  // Could not open file
      echo 'ERROR - Unable to open data file.';
   }
} // end function writeJsonFromCsv

// TODO: Need error handling (in AngularJS code)

// MAIN
switch ($_GET['dataset']) {
   case 'localclubs':
      writeJsonFromCsv('localclubs', 'localclubs', array ('club','region','website'));
      break;
   case 'travel':
      writeJsonFromCsv('travel', 'travel', array ('date','event','location', 'infoloc'));
      break;
   case 'newsletter':
      writeJsonFromCsv('newsletter', 'newsletter', array ('issue','filename'));
      break;

   // Replaced by case 'contact'
//    case 'officers':
//       writeJsonFromCsv('officers', 'contact', array ('type','office','person','affil'));
//       break;

   case 'contact':
      writeJsonFromCsv('contact', 'contact', array ('type','title','person','affil'));
      break;

   case 'pastConventions':
      writeJsonFromCsv('pastConventions', 'past-conventions', array ('year','place','infoLoc'));
      break;
   default:
      echo 'INVALID dataset VALUE';
}
?>