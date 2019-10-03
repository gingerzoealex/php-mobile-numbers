<?php 

require "lookup.php";


$csv_file = './phone-numbers.csv';

//Open the file.
$fileHandle = fopen($csv_file, "r");

$data = [];
//Loop through the CSV rows.

$pattern = "/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/";

$checkNumber = new MobileNumberLookup();

$val = getopt(null, ["phone_number:"]);
if ($val !== false) {
  $numbers = explode(",",$val['phone_number']);
  foreach($numbers as $number){
    $checkNumber->validate_number($number);
  }
}
else {
	echo "Could not get value of command line option\n";
}

while (($row = fgetcsv($fileHandle, 0, ",")) !== FALSE) {
  # prints the 4th column which is mobile number. could use regex to parse & find the column.
    $data = [$row[3]];
    // print_r($data);
    foreach($data as $number){
      sleep(0.5);
      preg_match_all($pattern,$number,$matches, PREG_PATTERN_ORDER);
      foreach($matches[0] as $valid){
        // print_r($str_num);
        if($valid){
          $str_num = str_replace(' ', '', $valid);
          print $str_num . "\n";
          $checkNumber->validate_number($number);
        }
        else{
          print_r("No match");

        }
      }

    }

    // foreach($match as $valid_number){
      // print_r($valid_number . "\n");

    // }
    // if($match){
      // echo $data . "\n";
      // foreach($array as $number){
        // $validity = $checkNumber->validate_number($number);
      // }
    // }
    // else{
      // echo "No Match\n";
    // }
}


/*
$checkNumber = new MobileNumberLookup();

$csv = str_getcsv($csv_file, "\n");
// foreach($csv as $row){
  // print($row);
}

while (($column = fgetcsv($fileHandle, 0, ",")) !== FALSE) {
  # prints the 4th column which is mobile number. could use regex to parse & find the column.
    // print_r(gettype($data));
    // print_r(gettype($column[3]));
    // print_r($column[3] . "\n");
    // $str_num = $column[3] . ",";
    // print_r(explode(",", $str_num));
    // $var = array($str_num);
    // $var = explode(",", $str_num);
    // print_r(gettype($var));
    // $str_num = str_replace(' ', '', $column[3]);
    // print_r($str_num);

    // foreach($column[3] as $row){
      // $data = $column[3];
      // print_r($row);
      // $match = [preg_match($pattern,$data)];
      // print(gettype($match));
    // }
    // $nums_array = explode(",",$match);
    // if($match){
      // print($nums_array);
      // foreach($match as $num){
        // print(gettype($num));

      // }
      // echo $data . "\n";

      // foreach($match as $number){
        // printr($number);
      // $checkNumber->validate_number($number);
        // print_r(gettype($number));
        // $validity = $checkNumber->validate_number($number);
      // }
    // }
    // else{
      // echo "Not a valid UK mobile number\n";
    // }

}


?> */
