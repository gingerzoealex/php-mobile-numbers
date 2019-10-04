<?php

require "lookup.php";

$cli_inputs = $argv;
if($argc<2){
  print_r("Supply more than one argument\n");
  exit();
} else {
  if($argc==2){
    # when argc = only csv file name
    $cli_csv_name = $cli_inputs[1];
    print $cli_csv_name;
    if (!file_exists($cli_csv_name)) {
      echo "\nEnter a valid csv file\n";
      exit();
    } else {
      parse_csv($cli_csv_name);
    } 
  }else if($argc>2) {
    check_numbers($cli_inputs[2]);
  }
}


function check_numbers($cli_numbers){
  $checkNumber = new MobileNumberLookup();
  $numbers = $cli_numbers;
  print(gettype($numbers));
  // foreach($numbers as $number){
    print "\n";
    $checkNumber->validate_number($cli_numbers);
    print "\n";
  MobileNumberLookup::create_output_file($all_matches);
  }

function parse_csv($cli_csv_name){
  $checkNumber = new MobileNumberLookup();
  $pattern = "/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/";
    $csv = fopen($cli_csv_name, "r");
    while (($row = fgetcsv($csv, 200, ",")) !== FALSE) {
      # prints the 4th column which is mobile number. could use regex to parse & find the column.
      $data = [$row[3]];
      foreach($data as $number){
        sleep(0.5);
        preg_match_all($pattern,$number,$matches, PREG_PATTERN_ORDER);
        foreach($matches[0] as $valid){
          if($valid){
            $str_num = str_replace(' ', '', $valid);
            $all_matches = [$checkNumber->validate_number($number)];
          }
        }
      }
    }
  MobileNumberLookup::create_output_file($all_matches);
}


