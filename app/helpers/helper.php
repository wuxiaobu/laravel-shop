<?php
function test_helper() {
  return 'OK';
}

function route_class()
{
  return str_replace('.', '-', Route::currentRouteName());
}

function outputCsv($data, $filename, $emptyString = 'No Data'){
  if($data==false || count($data)==0){
      echo $emptyString;
      exit;
  }

  header('Content-Type: text/csv; charset=UTF-8');
  header("Content-Disposition: attachment; filename={$filename}.csv");
  header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
  header('Expires:0');
  header('Pragma:public');

  ob_start();
  $fp = fopen( 'php://output', 'w' ) or die();

  fputcsv($fp, array_keys(reset($data)));
  foreach ($data as $dataRow){
      fputcsv($fp, array_values($dataRow));
  }

  @fclose($fp);
  $output = ob_get_contents();
  ob_end_clean();
  echo "\xEF\xBB\xBF" . $output;
    exit;
}

function readCsv($filename){
  ini_set("auto_detect_line_endings", true);
  $rows = [];
  if ($csvFileHandler = fopen($filename, 'r')) {
      $columns = fgetcsv($csvFileHandler, 0, ",");
      while (($rowData = fgetcsv($csvFileHandler, 0, ",")) !== false) {
          foreach ($columns as $columnIndex => $columnName) {
              if(empty($columnName)) continue;
              $row[$columnName] = $rowData[$columnIndex];
          }
          $rows[] = $row;
      }
  }
  return $rows;
}

function readCsvEachRow($filename){
  ini_set("auto_detect_line_endings", true);
  if ($csvFileHandler = fopen($filename, 'r')) {
      $columns = fgetcsv($csvFileHandler, 0, ",");
      while (($rowData = fgetcsv($csvFileHandler, 0, ",")) !== false) {
          foreach ($columns as $columnIndex => $columnName) {
              if(empty($columnName)) continue;
              $row[$columnName] = $rowData[$columnIndex];
          }
          return $row;
      }
    return false;  
  }
  return false;
}