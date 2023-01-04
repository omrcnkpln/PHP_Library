<?php
/**
 * @todo jsonu direk array yapan bir metot yazılacak
 */

include("Func/StringOperations.php");
$followingFILE = file_get_contents("following.json");
$followingJSON = json_decode($followingFILE, true);

$followersFILE = file_get_contents("followers.json");
$followersJSON = json_decode($followersFILE, true);
//echo $json_a['data']['user']['edge_followed_by']['count'];

//print_r($json_a['data']['user']['edge_followed_by']['edges']);

//foreach ($followingJSON['relationships_following']['string_list_data']['value'] as $key => $value) {
//    echo $i . ":" . $value . "<br>";
//    $i++;
//}

$i = 1;
foreach ($followingJSON['relationships_following'] as $key => $value) {
//    echo $i . " : " . $value['string_list_data'][0]['value'] . "<br>";
    $person = $value['string_list_data'][0]['value'];
    $followings[$i] = $person;
    $i++;
}

$i = 1;
foreach ($followersJSON['relationships_followers'] as $key => $value) {
//    echo $i . " : " . $value['string_list_data'][0]['value'] . "<br>";
    $person = $value['string_list_data'][0]['value'];
    $followers[$i] = $person;
    $i++;
}

$BeniTakipEtmeyenler = SearchIn($followers, $followings);
$BenimTakipEtmediklerim = SearchIn($followings, $followers);

echo "beni takip etmeyenler";
echo "<pre>";
print_r($BeniTakipEtmeyenler);
echo "</pre>";

echo "benim takip etmediklerim";
echo "<pre>";
print_r($BenimTakipEtmediklerim);
echo "</pre>";

$herkes = MergeTwoArray($followers, $followings);

echo "herkes";
echo "<pre>";
print_r($herkes);
echo "</pre>";

