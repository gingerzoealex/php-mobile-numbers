<?php
// Get the PHP helper library from twilio.com/docs/php/install
// Loads the library
require "vendor/autoload.php";

// Your Account Sid and Auth Token from twilio.com/user/account
// waiting on text to authorise account
$sid = "{{account_sid}}";
$token = "{{ auth_token }}";
$client = new Lookups_Services_Twilio($sid, $token);

// Make a call to the Lookup API
$number = $client->phone_numbers->get("15108675309");

// Print the nationally formatted phone number
echo $number->national_format . "\r\n"; // => (510) 867-5309
