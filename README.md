# PHP App to Validate UK Mobile Numbers

An application in PHP that consumes the Twilio API to validate UK obile numbers (with the dialling code `+44`).

The app can take an input from the command line - the input should be a CSV file name and a mobile number.

This uses the GPLv3 licence & additional licences from third party code as indicated. 

## Set Up Dev Environment

Copy `.env.example` to `.env`. You will need to get a Twilio Account SID & a Twilio Auth Token by setting up an [account](https://www.twilio.com). This provides API access for the number lookup functionality.

Clone this repo using SSH or HTTPS.

Run `composer install` to get the dependencies.

*If you're unsure what Composer is, the TLDR; is that it's a package manager for PHP projects. [Read the docs for it here](https://getcomposer.org/doc/01-basic-usage.md).*

## How It Works

To run the app: `php app.php phone-numbers.csv +4407904565688 ` to validate the mobile number.

Run `php app.php phone-numbers.csv` to validate the numbers in the CSV file.

The valid numbers will be output to the CSV file `mobile_numbers.csv`, along with the network provider.

The number input to the command line must be in the format `+4407xxxxxxxxx`.

## What Can Be Improved?

This is a work in progress. If you want to contribute to this project please open a pull request!
