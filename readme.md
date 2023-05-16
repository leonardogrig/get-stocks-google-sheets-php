# Stock Data Updater

This project uses the Google Sheets API to update stock data. The data is fetched from specific ranges in a Google Spreadsheet, processed, and then written to a JSON file named 'stock-data.json'. 

The script runs continuously, updating the data every 15 minutes. However, it only operates on weekdays from 8 AM to 7 PM (Sao Paulo timezone).

## Prerequisites

* Google API credentials (`credentials.json`)
* Google Sheets API PHP Client library
* PHP 7.1 or higher
* Composer for installing the Google Sheets API PHP Client library (run: composer require google/apiclient)

## Usage

Clone the repository, install dependencies using Composer, and run the script.