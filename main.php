<?php

function updateStockData()
{

    require __DIR__ . '/vendor/autoload.php';

    $client = new \Google_Client();
    $client->setApplicationName("Google Sheets API PHP Quickstart");
    $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
    $client->setAuthConfig(__DIR__ . '/credentials.json');
    $client->setAccessType('offline');

    $service = new Google_Service_Sheets($client);

    $spreadsheetId = '1K-5p6Q1T6vAtY0DNwymDZLKSVFTnSqz9mQ-eIGfwS74';

    echo "Today is " . date("l");
    echo "The time is " . date("h:i:sa");

    if (date("l") != "Sunday" && date("l") != "Saturday") {
        if (date("H") >= 8 && date("H") <= 19) {
            
            $totalArray = [];
           
            $range = 'TOP_PRICE_CHANGE';
            $response = $service->spreadsheets_values->get($spreadsheetId, $range);
            $rows = $response->getValues();
           
            $headers = array_shift($rows);
           
            $array = [];
            foreach ($rows as $row) {
                $array[] = array_combine($headers, $row);
            }

            $totalArray['top_price_change'] = $array;

            $range = 'TOP_PL';
            $response = $service->spreadsheets_values->get($spreadsheetId, $range);
            $rows = $response->getValues();
        
            $headers = array_shift($rows);
          
            $array = [];
            foreach ($rows as $row) {
                $array[] = array_combine($headers, $row);
            }

            $totalArray['top_pl'] = $array;

            $range = 'TOP_DY';
            $response = $service->spreadsheets_values->get($spreadsheetId, $range);
            $rows = $response->getValues();
           
            $headers = array_shift($rows);
           
            $array = [];
            foreach ($rows as $row) {
                $array[] = array_combine($headers, $row);
            }

            $totalArray['top_dy'] = $array;

            $jsonString = json_encode($totalArray, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            print($jsonString);

            $path = 'data/stock-data.json';

            $fp = fopen($path, 'w');
            fwrite($fp, $jsonString);
            fclose($fp);
        }
    }
}?>
<?php

while (true) {
    date_default_timezone_set('America/Sao_Paulo');
    updateStockData();
    sleep(60*15);
}

?>
