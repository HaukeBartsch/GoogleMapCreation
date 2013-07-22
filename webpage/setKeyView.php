<?php

if (!empty($_GET['lat'])) {
  $lat = $_GET['lat'];
} else {
  print('no lat given');
  return 0;
}
if (!empty($_GET['lng'])) {
  $lng = $_GET['lng'];
} else {
  print('no lng given');
  return 0;
}
if (!empty($_GET['zoom'])) {
  $zoom = $_GET['zoom'];
} else {
  print('no zoom given');
  return 0;
}
if (!empty($_GET['filename'])) {
  $filename = $_GET['filename'];
} else {
  print('no filename given');
  return 0;
}

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

function saveDatabase( $data, $filename) {
  $fp = fopen($filename, 'w');
  if ($fp == FALSE)
    return;
  foreach ($data as $d) {
    fputcsv($fp, $d);
  }
  fclose($fp);
}

$d = loadDatabase( "dbfile.txt" );
$d[] = array( "lat" => $lat, "lng" => $lng, "zoom" => $zoom, "filename" => $filename );
saveDatabase( $d, "dbfile.txt" );

return;
?>