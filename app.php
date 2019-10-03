<?php

require "lookup.php";


$csv_file = './phone-numbers.csv';

//Open the file.
$fileHandle = fopen($csv_file, "r");

// $data = [];
//Loop through the CSV rows.

$pattern = "/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/";

$checkNumber = new MobileNumberLookup();

$cli_numbers = getopt(null, ["phone_number:"]);
$cli_csv_name = getopt(null, ["csv:"]);
// print_r (var_export($cli_csv_name, true));
if ($cli_numbers !== false) {
  $numbers = explode(",",$cli_numbers['phone_number']);
  foreach($numbers as $number){
    print "\n";
    // $checkNumber->validate_number($number);
    print "\n";
  }
}

if ($cli_csv_name !== false){
  $files = explode(",",$cli_csv_name['csv']);
  foreach($files as $file){
    $csv = fopen($file, "r");

###
    $columns = explode(",", $csv[0]);
    print_r($columns);
    // $csv_column_names = implode(" ", $columns);
    // print_r($csv_column_names);
###
    
    while (($row = fgetcsv($csv, 200, ",")) !== FALSE) {
      # prints the 4th column which is mobile number. could use regex to parse & find the column.
      $data = [$row[3]];
      foreach($data as $number){
        sleep(0.5);
        preg_match_all($pattern,$number,$matches, PREG_PATTERN_ORDER);
        foreach($matches[0] as $valid){
          if($valid){
            $str_num = str_replace(' ', '', $valid);
            $checkNumber->validate_number($number);
          }
          else{
            // print_r("No match");
          }
        }
      }
    }
  }
}
else{
  print_r("No file selected.");
}
  $checkNumber->create_output_file();
