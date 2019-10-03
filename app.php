<?php

require "lookup.php";

//Open the file.

# do argument count

$cli_numbers = getopt(null, ["phone_number:"]);
$cli_csv_name = getopt(null, ["csv:"]);


if (isset($argc)) {
	for ($i = 0; $i < $argc; $i++) {
		echo "Argument #" . $i . " - " . $argv[$i] . "\n";
	}
}

if((count($argv)) > 1){
  print_r("More than one argument");
}

$pattern = "/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/";

$checkNumber = new MobileNumberLookup();

if ($argv[1] !== null) {
  $numbers = explode(",",$cli_numbers['phone_number']);
  foreach($numbers as $number){
    print "\n";
    $checkNumber->validate_number($number);
    print "\n";
  }
}

if ($cli_csv_name !== null){
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
}


else{
  print_r("No file selected.");
}
