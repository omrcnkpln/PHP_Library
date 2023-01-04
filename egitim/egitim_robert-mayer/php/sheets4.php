<?php

// 4 için bunlar lazım sade
// bu lazım ama olursa 2 olmuyo yalnız
// "type": "service_account",
// bunun izni olduğu için uygulamada izin istemiyo belki
//   "client_email": "googlesheetsphp@electric-facet-271113.iam.gserviceaccount.com",
//   "private_key": "-----BEGIN PRIVATE KEY-----\nMIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCt9VY640HBYB+i\nPERq+O+IRKMhBQE8YOtRpul2PIHv0PrSGMW3gKOAcHN/B4o2djdde/bqboluJW/j\nj7yFbEGg3atcK2wF/7HIkHNk1kkCe4DRsNix7JtOWOCFI8g4qZ1qiIsyjfdp527d\n4B0KQQ0gzNrNVg6NhkyNXWEFPmEd7S+OAJAGDA5lYEppxRFRp6xCjXGuHMKq0cFf\noPHiC1LzLyU1CA+pUl0BjjxlUV+QpfLr0db0yFx9kvQ4/SGpjClOsdxYY1vzPBL6\nZ5U8Q2X0vMiq93V6XvLq0KCHFycH1GTbgsVj2zbW+9OpdVNgvuYzrybg3QZ31uFz\nt02RNp8LAgMBAAECggEAATQo6BhpfJKTNXawTIMzeSBsdo6HzyimiDac9/X8OjIa\ngjisqZPozbs5eWAOe0j/IhT5BO9F4S6+Ivd8KPoyTBAsnuMoCLSXwNkLC2AWOj+r\niQftv/Fws66WwyUXvhiiX7nZKLzlwORalot19/uyQQ9Z1kDpsd4DipjiUnx3hJL8\nKM+Usu0irMCXhubdLIy9MNSK1UZmwdQqjQZpApMsfFCPzMN5HYIEniXiCfEnfKgF\n5iXPc6OAIeWL8IOftRspP7Sa4PXqkNwrBta38a/VdgI7403nWiw03cy0mJoS85zi\nJA5Ka3uEgm4sbfLuF5beoyNIguH/7ErVBZ2/UqKTXQKBgQDq1uo9PplQpfnCD4O1\nULBQ47Z83g6othpERrBxWNQbJ4Xtxlki0HC6x10y6eTwFbXxmWOzpNBHPa15hoNg\nyVAfV+4D5+3D8pdywZdDczllP/+zVPLhSSTe2YNEsAutrHY9fwBoLa2agiRqJVLc\nLs5aU297xn281Ou2fBNf6GSOBwKBgQC9ohCsP39ipQAzZivdmtdTtexQpZXYWBya\nD6WvrhYpIAbbzMzpeI8lYSQ6+Xreyxc04JDMaI09YxOUELYHlzTIRnEZUc9VhJqH\nYVG2UcXlsu9hzc8lOalDMyGrQsSZbYZfR/GVgdsyzLGrfklkjkG0zED+1lgPC8Vz\niNi+Ttcl3QKBgE1nMuOm21+ypSSqem3rv4GZ3I9BnbFL/FJevk9NyPN+Tm11v/Fy\npIVbqsNaRmQ/s62DMlKG00N399KjXHAtSmRaVhAhhMPeFL71QgcwVk2iD4SrTjal\nJirxpIuiPucqffp8/sRXse3IUXpO/QWnw8oP0CIK5Wy0/VAziytEbMhHAoGASkhZ\nz59v/uwzj+7N8BjfkGMLFuxGLmEVkyPd+1tuQt3Q0fj/q9UV/cZ3ssJXZz6W8Jen\nIOszqIBPAwkoxQBuJKWzV/+7//vZrH5qy8hshPX6340HP8W+kBxPbA7ThGZq5JgC\nAlbDzrpwPoVRqpovEuuP6kN8ayhpSECq5qFrleECgYA5p+kow1FYXmJRxVz2i53v\nxzjHjLrNAPrckFsHd2crTuBD43O5hZvDV0oZHtBZCDcTrLewOIMwplyLWUgm35YK\nrUCR3FHHsPwvdZYgRwpcPHigPjl7Zui3CCeBR/+JLW5K+azBd6VTM4FnVTAp4lk0\nXVjUnuspkdCl5b/0GwGjow==\n-----END PRIVATE KEY-----\n",


//  bunlar olmasa da oluyo . nası oluyo client lersiz ?
//   "client_id": "878759373515-eqbnep44kcm4jc58u7o8mm3le5q49mbb.apps.googleusercontent.com",
//   "client_secret": "odqLNGKceCrMmobZc6yOxsmf",
// bu ikisi ne bokuma bilmiyom
//   "private_key_id": "283e630a116cc0997ff865742977a147f7d34c83",
//   "client_x509_cert_url": "https://www.googleapis.com/robot/v1/metadata/x509/googlesheetsphp%40electric-facet-271113.iam.gserviceaccount.com"



// direk videodaki
// burda hiç google izni istemiyor
require __DIR__ . '/vendor/autoload.php';
$client = new Google_Client();
$client->setApplicationName('Google Sheets API PHP Quickstart');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
// $client->setAccessType('offline');
$client->setAuthConfig('credentials2.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId = '15wKs2VAXypuU1DhwY5dlqIMQ4MKLqDtPrT-D5N0B1cM';
// class data olmicak
$range = 'A2:C';
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();
echo "<pre>";
if (empty($values)) {
    print "No data found.\n";
} else {
    print "isim , soyad:\n";
    foreach ($values as $row) {
        // Print columns A and E, which correspond to indices 0 and 4.
        printf("%s, %s\n", $row[0], $row[1]);
    }
}




?>