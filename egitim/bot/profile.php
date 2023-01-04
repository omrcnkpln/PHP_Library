<?php

session_start();

include "libraries/CurlLibrary.php";
$curl = new CurlLibrary();

$curl->SetUrl("http://phpprojects:8064/tm-unified/hesabim");
$curl->SetTimeout(0);
$curl->SetReferer("http://www.google.com/");
$curl->SetUserAgent($_SERVER["HTTP_USER_AGENT"]);
$curl->Follow();
$curl->SetCookieFile(session_id());

echo $curl->Execute();
