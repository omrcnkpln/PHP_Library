<?php
namespace Libraries;

class CustomCrypt
{
  protected $encrypt_method = 'AES-256-CBC'; //sifreleme yontemi
  protected $secret_key = '11*_33'; //sifreleme anahtari
  protected $secret_iv = '22-=**_'; //gerekli sifreleme baslama vektoru

  public function encrypt($value)
  {
    $key = hash('sha256', $this->secret_key); //anahtar hash fonksiyonu ile sha256 algoritmasi ile sifreleniyor
    $iv = substr(hash('sha256', $this->secret_iv), 0, 16);

    $sifrelendi = openssl_encrypt($value, $this->encrypt_method, $key, false, $iv);

    return $sifrelendi;
  }

  public function decrypt($value)
  {
    $key = hash('sha256', $this->secret_key); //anahtar hash fonksiyonu ile sha256 algoritmasi ile sifreleniyor
    $iv = substr(hash('sha256', $this->secret_iv), 0, 16);

    $sifre_cozuldu = openssl_decrypt($value, $this->encrypt_method, $key, false, $iv);

    return $sifre_cozuldu;
  }
}
