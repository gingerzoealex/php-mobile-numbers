<?php

/** Thanks to Twilio for creating this tutorial for using their Number Validation API.
 *  https://www.twilio.com/blog/2016/03/how-to-validate-phone-numbers-in-php-with-the-twilio-lookup-api.html
 *
 *  Copyright 2019  Zoe Gadon-thompson
 *  Licensed under the GPLv3, see file LICENSE
 *
 */

use Symfony\Component\Dotenv\Dotenv;
require "vendor/autoload.php";

# Use for .env file for Twilio auth variables
$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__.'/.env');
class MobileNumberLookup{

  function validate_number($phone_number){
    /*
     * Function runs for each valid number found.
     */

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
      $number_info = [$phone_number, $carrier, $number_type];
      return $number_info;

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
    fputcsv($file, array('mobile_number', 'carrier', 'type'));
    fclose($file);
    # The file has to be closed to prevent the headers being overwritten.
    $file = fopen('mobile_numbers.csv', 'a');
    foreach ($data as $item){
      fputcsv($file, $item);
    }
    fclose($file);
  }
}

?>
