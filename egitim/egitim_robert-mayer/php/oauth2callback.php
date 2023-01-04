<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();

$client = new Google_Client();
$client->setAuthConfigFile('jsondrive.json');
$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/phpprojects/Robert_Mayer/php/oauth2callback.php');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);

if (!isset($_GET['code'])) {
    $auth_url = $client->createAuthUrl();
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} else {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/phpprojects/Robert_Mayer/php/sheets3.php';
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}
