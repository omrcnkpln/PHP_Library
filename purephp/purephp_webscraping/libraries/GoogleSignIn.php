<?php
/** @var object $VT */
namespace Libraries;

use Exception; // Global exception sınıfımız bu galiba
use Dotenv\Dotenv;
use Google\Client;
use Google_Service_Oauth2;
use Models\VT;
use System\Helpers\Helper;

class GoogleSignIn extends Client
{
    public $scopes = array("profile", "email",);
    public $client;

    public function __construct()
    {
        $dotnet = Dotenv::createImmutable(dir);
        $dotnet->load();
        $requestUri = explode("?", REQUESTURI);
        $requestUriClean = trim($requestUri[0], "/");

        $this->client = new Client();

        $this->client->setClientId($_ENV["GOOGLE_CLIENT_ID"]);
        $this->client->setClientSecret($_ENV["GOOGLE_CLIENT_SECRET"]);
        $this->client->setRedirectUri(BASE . $requestUriClean);
        $this->client->setScopes($this->scopes);

        if (isset($_GET["code"])) {
            $VT = new VT();
            $googleClientResult = $this->GetResponse($_GET["code"]);

            if (!$googleClientResult) {
            }
            else {
                $email = $googleClientResult["email"];
                if ($requestUriClean == "giris") {
                    $rutbe = 3; // standart kullanici girisi icin sorgula

                    $response = $VT->Auth($email, $rutbe);

                    if (!$response) { // basarili degil ise admin icin sorgula
                        $rutbe = 1;
                        $responseAdmin = $VT->Auth($email, $rutbe);

                        if (!$responseAdmin) {
                            $_SESSION["durum"] = 4; // Yani basarisiz
                        }
                    }
                }
                elseif ($requestUriClean == "giris-ogretmen") {
                    $rutbe = 2; // ogretmen kullanici girisi icin sorgula

                    $response = $VT->Auth($email, $rutbe);

                    if (!$response) {
                        $_SESSION["durum"] = 4; // Yani basarisiz
                    }
                }
                elseif ($requestUriClean == "kayit") {
                    $isim = isset($googleClientResult["isim"]) ? $googleClientResult["isim"] : null;
                    $soyisim = isset($googleClientResult["soyisim"]) ? $googleClientResult["soyisim"] : null;
                    $telNo = isset($googleClientResult["telNo"]) ? $googleClientResult["telNo"] : null;
//                    $profile = $googleClientResult["profile"];
                    $email = $googleClientResult["email"];
                    $hash = md5(Helper::CreateHash());
                    $rutbe = 3;

                    $response = $VT->RegisterLess($isim, $soyisim, $email, $telNo, $hash, $rutbe);
                }
                elseif ($requestUriClean == "kayit-ogretmen") {
                    $isim = isset($googleClientResult["isim"]) ? $googleClientResult["isim"] : null;
                    $soyisim = isset($googleClientResult["soyisim"]) ? $googleClientResult["soyisim"] : null;
                    $telNo = isset($googleClientResult["telNo"]) ? $googleClientResult["telNo"] : null;
                    $email = $googleClientResult["email"];
                    $hash = md5(\Libraries\Helper::CreateHash());
                    $rutbe = 2;

                    $response = $VT->RegisterLess($isim, $soyisim, $email, $telNo, $hash, $rutbe);
                }
                else {
                    echo "basarisiz";
                    $_SESSION["durum"] = 4; // Yani basarisiz
                }
            }
        }
    }

    public function GetResponse($token)
    {
        try {
            $token = $this->client->fetchAccessTokenWithAuthCode($token);
            $this->client->setAccessToken($token);
            // getting the profile
            $gauth = new Google_Service_Oauth2($this->client);
            $google_info = $gauth->userinfo->get();

            $userInfos = array(
                "email" => $google_info->email,
                "name" => $google_info->name,
            );

            return $userInfos;
        } catch (Exception $ex) {
            return false;
        }
    }
}
