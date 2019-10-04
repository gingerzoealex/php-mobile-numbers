# PHP App to Validate UK Mobile Numbers

An application in PHP that consumes the Twilio API to validate UK Mobiles numbers (with the dialling code `+44`).

The app can take an input from the command line, the input should be a CSV file name and a mobile number.

This uses the GPLv3 licence & additional licences from third party code as indicated. 

## Set Up Dev Environment

Copy `.env.example` to `.env`. You will need to get a Twilio Account SID & a Twilio Auth Token by setting up an account. This provides API access for the number lookup functionality.

Clone the repo using SSH or HTTPS.

run `composer install` to get the dependencies.

## How It Works

To run the app: `php app.php phone-numbers.csv +4407904565688 `


