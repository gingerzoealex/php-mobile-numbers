<?php
// Get the PHP helper library from twilio.com/docs/php/install
// Loads the library

require "vendor/autoload.php";

class MobileNumberLookup{
  
  function validate_number($phone_number){

    $sid = "AC6488e8b7bcd7f4ca917791aedd7b86ce";
    $token = "969ad4307a81385f32add735247bd419";

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
