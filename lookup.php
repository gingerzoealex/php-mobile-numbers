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
      // print gettype($number_type);
      $carrier =  $number->carrier->name; // => Sprint Spectrum, L.P.
      print_r ("\nNumber:\t" . $phone_number . "\nCarrier:\t" . $carrier . "\nType:\t" . $number_type . "\n_______\n");


      return true;
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

  function create_output_file(){
    // open the file "demosaved.csv" for writing
    $file = fopen('mobile_numbers.csv', 'w');
    // save the column headers
    fputcsv($file, array('mobile_number', 'carrier', 'type'));

    // Sample data. This can be fetched from mysql too
    $data = array(
    array('Data 11', 'Data 12', 'Data 13'),
    );

    // save each row of the data
    foreach ($data as $row)
    {
    fputcsv($file, $row);
    }

    // Close the file
    fclose($file);
  }
}

?>
