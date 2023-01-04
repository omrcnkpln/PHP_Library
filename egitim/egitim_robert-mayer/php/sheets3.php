<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();
$client = new Google_Client();
$client->setAuthConfig('jsondrive.json');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
    $service = new Google_Service_Sheets($client);
    $spreadsheetId = '15wKs2VAXypuU1DhwY5dlqIMQ4MKLqDtPrT-D5N0B1cM';
    $range = 'A2:C';
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();
    echo "<pre>";
    if (empty($values)) {
        print "No data found.\n";
    } else {
        print "Ad baba, Soyad baba:\n";
        foreach ($values as $row) {
            // Print columns A and E, which correspond to indices 0 and 4.
            printf("%s, %s\n", $row[0], $row[1]);
        }
    }
} else {
    // bu kullanım dah mı iyi sanki
    $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/phpprojects/Robert_Mayer/php//oauth2callback.php';
    // $redirect_uri = 'http://localhost/phpprojects/Robert_Mayer/php/oauth2callback.php?';
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}
