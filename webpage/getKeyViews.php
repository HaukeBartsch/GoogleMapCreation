<?php

function loadDatabase ( $db_file ) {
  $row = 1;
  $d = array();
  if (($handle = fopen($db_file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 100000, ",")) !== FALSE) {
      $num = count($data);
      $row++;
      $vals = array();
      for ($c=0; $c < $num; $c++) {
        $vals[$c] = $data[$c]; 
      }
      $d[$row] = $vals;
    }
    fclose($handle);
  }
  return $d;
}

$d = loadDatabase( "dbfile.txt" );

$str = "";
foreach ($d as $line) {
  if (strlen($str) > 0) {
    $str = $str.",";
  }
  $str = $str."{ \"lat\": \"".$line[0]."\", \"lng\": \"".$line[1]."\", \"zoom\": \"".$line[2]."\", \"keyview\": \"".$line[3]."\" }";
}
echo "[".$str."]";
return;
?>