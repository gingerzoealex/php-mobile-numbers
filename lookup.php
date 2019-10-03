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

    try{
      $client = new Lookups_Services_Twilio($sid, $token);
      // Perform a carrier Lookup using a US country code
      $number = $client->phone_numbers->get($phone_number, array("CountryCode" => "UK", "Type" => "carrier"));
      // Log the carrier type and name
      $number_type = $number->carrier->type . "\r\n"; // => mobile
      $carrier =  $number->carrier->name; // => Sprint Spectrum, L.P.

      print "Number:\t" . $phone_number . "\nCarrier:\t" . $carrier . "\nType:\t" . $number_type . "\n_______\n";

      return true;
    } catch (Exception $e) {
        // If a 404 exception was encountered return false.
        if($e->getStatus() == 404) {
            return false;
        } else {
            throw $e;
        }
    }

    if (isValidNumber("19999999999")) {
        echo "Phone number is valid";
    } else {
        echo "Phone number is not valid";
    }
  }
}

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

?>
