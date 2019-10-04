<?php

/* vim: set expandtab tabstop=8 shiftwidth=8 softtabstop=8: */
/**
 * This is a UK phone number lookup app
 *
*  Copyright 2019  Zoe Gadon-thompson
 * Licensed under the GPLv3, see file LICENSE
*
**/

require "lookup.php";

$cli_inputs = $argv;
if($argc<2){
  print_r("Supply more than one argument\n");
  exit();
  # closes the program to prompt user to enter valid args
  # argc is 0 indexed, and the first argument will be app.php.
} else {
  if($argc==2){
    $csv_name = $cli_inputs[1];
    if (!file_exists($csv_name)) {
      echo "\nEnter a valid csv file\n";
      exit();
    } else {
      parse_csv($csv_name);
    }
  }else if($argc>2) {
    check_numbers($cli_inputs[2]);
  }
}


function check_numbers($cli_numbers){
  $checkNumber = new MobileNumberLookup();
  $numbers = $cli_numbers;
    print "\n";
    $lookup = $checkNumber->validate_number($cli_numbers);
    print "\n";
    MobileNumberLookup::create_output_file([$lookup]);
  }

function parse_csv($csv_name){
  print_r("\n*** CHECKING CSV FILE " . $csv_name . " ***\n");
  $checkNumber = new MobileNumberLookup();
  $pattern = "/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/";
  $csv = fopen($csv_name, "r");
  $output = [];
    while (($row = fgetcsv($csv, 200, ",")) !== FALSE) {
      # prints the 4th column which is mobile number. could use regex to parse & find the column.
      $data = [$row[3]];
      foreach($data as $number){
        sleep(0.5);
        preg_match_all($pattern,$number,$matches, PREG_PATTERN_ORDER);
        $id = [];
        $id_count = 0;
        $all_matches = [];
        foreach($matches[0] as $valid){
          $id_count++;
          array_push($id, $id_count);
          if($valid){
            $number_details = $checkNumber->validate_number($number);
            if($number_details){
                array_push($output, $number_details);
            }
          }
        }
      }
    }
    print_r($output);
    MobileNumberLookup::create_output_file($output);
}


