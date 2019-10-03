<?php

require "lookup.php";

//Open the file.

# do argument count

$cli_numbers = getopt(null, ["phone_number:"]);
$cli_csv_name = getopt(null, ["csv:"]);

$cli_filename = true;
$cli_numbers = true;

if (isset($argc)) {
	for ($i = 0; $i < $argc; $i++) {
		echo "Argument #" . $i . " - " . $argv[$i] . "\n";
	}
}

if($argc<2){
  print_r("Supply more than one argument\n");
  exit();
} else {
  if($argc==2){
    # when argc = only csv file name
    $cli_csv_name=$argv[1];
    print $cli_csv_name;
    if (file_exists($cli_csv_name)) {
      echo "\nEnter a file to be parsed\n";
      exit();
    }
    else{
      print("csv file logic here");
      parse_csv();
    }
  }
  // if ($argc==3){
    // print("number logic here");
    // this::check_numbers();

  // }
}



$pattern = "/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/";
function check_numbers(){
$checkNumber = new MobileNumberLookup();
// if ($argv[1] !== null) {
// if ($cli_numbers !== false) {
  $numbers = explode(",",$cli_numbers['phone_number']);
  foreach($numbers as $number){
    print "\n";
    $checkNumber->validate_number($number);
    print "\n";
  }
// }
}

function parse_csv(){
// if ($cli_csv_name !== null){
// if ($cli_filename == false){
  $files = explode(",", $cli_csv_name['csv']);
  foreach($files as $file){
    print(gettype($file));
    $csv = fopen($file, "r");
    while (($row = fgetcsv($csv, 200, ",")) !== FALSE) {
      // print_r(gettype($csv));
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
  }
  // MobileNumberLookup::create_output_file($all_matches);
// }
}


