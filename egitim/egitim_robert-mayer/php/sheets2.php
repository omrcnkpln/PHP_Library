

<?php

// ssl hatası php.ini extension ve cacert.pem ile çözüldü 
// sheets.php ve sheets2.php de cmd den izin aldıktan sonra browserda da görebiliyoruz
// .json dosyasında son satır virgül olmicak
// koda daha hakim ol

// 1 2 token.json ile giriyo var ise, 3 session kontrolü ile tarayıcı kapanana kadar, 4 a.bile qoyuyo denetimsiz
// en temizi 3

// bunlar lazım. aslında çok da lazım değilde neyse
//     "project_id": "electric-facet-271113",
//     "auth_uri": "https://accounts.google.com/o/oauth2/auth",
//     "token_uri": "https://oauth2.googleapis.com/token",
//     "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
//     "client_id": "878759373515-eqbnep44kcm4jc58u7o8mm3le5q49mbb.apps.googleusercontent.com",
//     "client_secret": "odqLNGKceCrMmobZc6yOxsmf",
//     "redirect_uris": ["urn:ietf:wg:oauth:2.0:oob", "http://localhost"]


// ne işe yaradığını bilmiyom
// api key : AIzaSyAsB2QWtRv40YgugXneRsEd3ptkPRYRsGE

// istemci kimliği uygulamayı belirtiyo galiba
// üçü de oluyo 2 4 için

// OAuth 2.0 İstemci Kimlikleri 1.si
// bu eski silindi bu
// "client_id" : "878759373515-saci6phlai20fkda57od4uqtmbk7ne0s.apps.googleusercontent.com",
// "client_secret" : "FgjyT7jlWIFgBtx3F8UC-260",

// OAuth 2.0 İstemci Kimlikleri 2.si
// omerdeneme uygulaması galiba
// "client_id" : "878759373515-eqbnep44kcm4jc58u7o8mm3le5q49mbb.apps.googleusercontent.com",
// "client_secret" : "odqLNGKceCrMmobZc6yOxsmf"

// quickstart
// "client_id" : "48955115255-us8q2igq3u8ab9rc6rurs686g32q0v6l.apps.googleusercontent.com",
// "client_secret" : "tu5vcRTmId6v7te7AtSrqIG5"

require __DIR__ . '/vendor/autoload.php';

// if (php_sapi_name() != 'cli') {
//     throw new Exception('This application must be run on the command line.');
// }

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Google Sheets API PHP Quickstart');
    $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);

    $client->setAuthConfig('credentials2.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = 'token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}


// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Sheets($client);

// Prints the names and majors of students in a sample spreadsheet:
// https://docs.google.com/spreadsheets/d/1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms/edit
$spreadsheetId = '15wKs2VAXypuU1DhwY5dlqIMQ4MKLqDtPrT-D5N0B1cM';
$range = 'A2:C';
// $range = 'Class Data!A2:C';
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
?>