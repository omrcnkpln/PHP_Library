<?php


class CurlLibrary
{
    public $curl;
    public $response;

    public function __construct()
    {
        $this->curl = curl_init();

        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);

//        curl_setopt($this->curl, CURLOPT_NOBODY, true);
    }

    public function SetTimeout($timeout)
    {
        curl_setopt($this->curl, CURLOPT_TIMEOUT, $timeout);
    }

    public function Follow($follow = true)
    {
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, $follow);
    }

    public function SetUrl($url)
    {
        curl_setopt($this->curl, CURLOPT_URL, $url);
    }

    public function SetReferer($referer)
    {
        curl_setopt($this->curl, CURLOPT_REFERER, $referer);
    }

    public function SetUserAgent($userAgent)
    {
        curl_setopt($this->curl, CURLOPT_USERAGENT, $userAgent);
    }

    public function SetRequestMethod($reuquestMethod = "get")
    {
        if ($reuquestMethod == "post") {
            curl_setopt($this->curl, CURLOPT_POST, true);
        }
    }

    public function SetPostFields($postFields)
    {
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $postFields);
    }

    public function SetCookieJar($cookieJar)
    {
        //curl_setopt($ch, CURLOPT_COOKIE, "test=200");
//        curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
//        curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
//curl_setopt($ch, CURLOPT_PROXY, "170.140.119.70");
//curl_setopt($ch, CURLOPT_PROXYPORT, "3124");

        $dir = realpath(".") . "/";
        $filePath = $dir . "temp/" . $cookieJar;

        curl_setopt($this->curl, CURLOPT_COOKIEJAR, $filePath);
    }

    public function SetCookieFile($cookieFile)
    {
        $dir = realpath(".") . "/";
        $filePath = $dir . "temp/" . $cookieFile;

        curl_setopt($this->curl, CURLOPT_COOKIEFILE, $filePath);
    }

    public function CurlHeader($header = true)
    {
        curl_setopt($this->curl, CURLOPT_HEADER, $header);
    }

    public function Execute()
    {
        $this->response = curl_exec($this->curl);
        curl_close($this->curl);

//        print_r($this->response);

        return $this->response;
    }
}
