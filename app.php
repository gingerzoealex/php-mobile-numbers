<?php 

$csvFile = './phone-numbers.csv';

//Open the file.
$fileHandle = fopen($csvFile, "r");

$data = [];
//Loop through the CSV rows.

$pattern = "/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/";


while (($row = fgetcsv($fileHandle, 0, ",")) !== FALSE) {
  # prints the 4th column which is mobile number. could use regex to parse & find the column.
    $data = $row[3];
    $match = preg_match($pattern,$data);
    if($match){
      echo $data . "\n";
    }
    else{
      echo "No Match\n";
    }
}

?>
