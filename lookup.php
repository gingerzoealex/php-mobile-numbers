<?php
# Use for .env file for Twilio auth variables
use Symfony\Component\Dotenv\Dotenv;
require "vendor/autoload.php";

$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__.'/.env');
class MobileNumberLookup{

  function validate_number($phone_number){

    $sid = $_ENV['TWILIO_ACCOUNT_SID'];
    $token = $_ENV['TWILIO_AUTH_TOKEN'];
    $str_output = "";

    try{
      $client = new Lookups_Services_Twilio($sid, $token);
      // Perform a carrier Lookup using a US country code
      $number = $client->phone_numbers->get($phone_number, array("CountryCode" => "UK", "Type" => "carrier"));
      // Log the carrier type and name
      $number_type = $number->carrier->type . "\r\n"; // => mobile
      $carrier =  $number->carrier->name; // => Sprint Spectrum, L.P.
      print_r ("\nNumber:\t" . $phone_number . "\nCarrier:\t" . $carrier . "\nType:\t" . $number_type . "\n_______\n");
      $mobile_data = [$phone_number, $carrier, $number_type];
      return $mobile_data[0];

    } catch (Exception $e) {
      // If a 404 exception was encountered return false.
      print "Error: " . $e->getStatus() . "\n";
      if($e->getStatus() == 404) {
        print " Number is invalid\n";
        return false;
      }
      if($e->getStatus() == 400) {
        print " Invalid format\n";
        return false;
      } else {
        print "\n";
        return false;
      }
    }
  }

  function create_output_file($data){
    $file = fopen('mobile_numbers.csv', 'w');
    // print_r("\n\nFile: " .$file);
    fputcsv($file, array('mobile_number', 'carrier', 'type'));
    fclose($file);
    // $f = fopen($file, 'w');
    $file = fopen('mobile_numbers.csv', 'a');
    // print_r("\n\nFile: " .$file);
    // print_r(gettype($data));
    // print_r(gettype($data));
    foreach ($data as $item){
      // print_r($item);
      // $row = [$item];
      // foreach($item as $entry){
      // print_r(gettype($row));
      // print_r("\nType : " . gettype($item));
      fputcsv($file, [$item], ",");
      // }
    }
    fclose($file);
  }
}

?>
