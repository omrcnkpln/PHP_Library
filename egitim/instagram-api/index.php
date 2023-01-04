<?php


//include ("System/Settings.php");

//require __DIR__ . '/vendor/autoload.php';
//require 'vendor/autoload.php';

//$userID = 17841403792932157;
//$accessToken = "IGQVJWazRrc05NRnBHUWhWTDB6QTRNUnRLai15U2RCQ0lKU19KQUxEdVRyTFpXSEcwYUYzc0FTVjhhcFFvSDFxMkZANZATJCbUtseDNKcXhjdkV5ejFMX3FkeUN4T096eFhva0ItSHduSTNPdFQ4bkRxV1lqX1lWV09vVUpj";
//$link = "https://api.instagram.com/v1/users/{$userID}/followed-by/?access_token={$accessToken}";

//$header = 0;
//$data = 0;
//
//function dene($url)
//{
//    $curl = curl_init();
//    curl_setopt($curl, CURLOPT_URL, $url);
//    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
//    curl_setopt($curl, CURLOPT_HEADER, 0);
//    curl_close($curl);
//
//    echo $curl;
//}
//
//dene($link);

//console dan
//önce bu

//options = {
//    userId: 3617262431,
//    list: 1 //1 for following, 2 for followers
//}
//
//`https://www.instagram.com/graphql/query/?query_hash=c76146de99bb02f6415203be841dd25a&variables=` + encodeURIComponent(JSON.stringify({
//        "id": options.userId,
//        "include_reel": true,
//        "fetch_mutual": true,
//        "first": 50
//    }))

// bu n eise yariyor bilmiyorum
$string = file_get_contents("data.json");
$json_a = json_decode($string, true);

//echo $json_a['data']['user']['edge_followed_by']['count'];

//print_r($json_a['data']['user']['edge_followed_by']['edges']);

$i = 0;
foreach ($json_a['data']['user']['edge_followed_by']['edges'] as $key => $value) {
    echo $i . ":" . $value["node"]["username"] . "<br>";
    $i++;
}
?>














