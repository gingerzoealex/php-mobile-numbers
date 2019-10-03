# PHP App to Validate UK Mobile Numbers

## Set Up Dev Environment

Copy `.env.example` to `.env`. You will need to get a Twilio Account SID & a Twilio Auth Token by setting up an account. This provides API access for the number lookup functionality.

Clone the repo using SSH or HTTPS.

run `composer install` to get the dependencies.

## How It Works

To run the app: `php app.php --phone_number="+4407904787677","+4402891273002","+44078988776566"`--csv="phone-numbers.csv"`
This adds numbers so you can check provider & type of number.



