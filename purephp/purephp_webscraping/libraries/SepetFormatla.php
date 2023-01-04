<?php

namespace Libraries;

use Models\VT;
use function System\Helpers\Helper;

class SepetFormatla
{
    public $sepetProper = [];
    public $kargoDurum = 0;
    public $kargoUcreti = 0;
    public $sepetAgirlik = 0;

    public $kuponDurum = 0;
    public $kuponYuzde = 0;
    public $kuponKazanc = 0;

    public $sepetKDVTutar = 0;
    public $sepetKDVDahilTutar = 0;
    public $sepetKDVHaricTutar = 0;
    public $sepetkdvtutar18 = 0;
    public $sepetkdvtutar8 = 0;
    public $sepetkdvtutar6 = 0;
    public $sepetkdvtutar1 = 0;

    public $price = 0;

    public function __construct($sepetDefault = [])
    {
        $VT = new VT();

        // urunlerde dolas
        $i = 0;
        foreach ($sepetDefault as $row => $value) {
            $urunBilgisi = $VT->baglantiMySQLi->query("SELECT * FROM urunler WHERE DURUM = 1 AND ID = '$value[urunID]' LIMIT 1");

            if ($urunBilgisi->num_rows > 0) {
                $urunBilgisiContent = $urunBilgisi->fetch_assoc();

                // _____________________________ kargo ücreti yoksa sorgula _____________________________________________________________
                // eger bir urunde dahi kargo dumunu var ise kargo durmu bilgisini 1 yap
                if ($this->kargoDurum == 0) {
                    if ($urunBilgisiContent["kargo_durum"] == 1) {
                        $this->kargoDurum = 1;
                    }
                }

                // _____________________________ ürün fiyatı al _____________________________________________________________
                if (!empty($urunBilgisiContent["indirimlifiyat"])) {
                    $fiyat = $urunBilgisiContent["indirimlifiyat"] . "." . $urunBilgisiContent["indirimlikurus"];
                }
                else {
                    $fiyat = $urunBilgisiContent["fiyat"] . "." . $urunBilgisiContent["kurus"];
                }

                $urunKDVDahilFiyat = $fiyat * $value["adet"];

                /* Fiyatlara KDV dahil olduğundan KDVDahil fiyatı KDV oranına bölücez*/
                if ($urunBilgisiContent["kdvoran"] > 9) {
                    $oran = "1." . $urunBilgisiContent["kdvoran"];
                }
                else {
                    $oran = "1.0" . $urunBilgisiContent["kdvoran"];
                }

                $urunKDVHaricFiyat = $urunKDVDahilFiyat / $oran;
                $urunKDVTutari = ($urunKDVDahilFiyat - $urunKDVHaricFiyat); /*Üründeki KDV tutarı*/

                if ($urunBilgisiContent["kdvoran"] == 18) {
                    $this->sepetkdvtutar18 = ($this->sepetkdvtutar18 + $urunKDVTutari);
                }

                if ($urunBilgisiContent["kdvoran"] == 8) {
                    $this->sepetkdvtutar8 = ($this->sepetkdvtutar8 + $urunKDVTutari);
                }

                if ($urunBilgisiContent["kdvoran"] == 6) {
                    $this->sepetkdvtutar6 = ($this->sepetkdvtutar6 + $urunKDVTutari);
                }

                if ($urunBilgisiContent["kdvoran"] == 1) {
                    $this->sepetkdvtutar1 = ($this->sepetkdvtutar1 + $urunKDVTutari);
                }

                $this->sepetKDVHaricTutar = ($this->sepetKDVHaricTutar + $urunKDVHaricFiyat);
                $this->sepetKDVDahilTutar = ($this->sepetKDVDahilTutar + $urunKDVDahilFiyat);

                $this->sepetProper[$i]["id"] = $value["urunID"];
                $this->sepetProper[$i]["urunKodu"] = $urunBilgisiContent["urunkodu"];
                $this->sepetProper[$i]["name"] = $urunBilgisiContent["baslik"];
                $this->sepetProper[$i]["category"] = $urunBilgisiContent["kategori"];
                $this->sepetProper[$i]["adet"] = $value["adet"];
                $this->sepetProper[$i]["stok"] = $urunBilgisiContent["stok"];
                $this->sepetProper[$i]["kdv_durum"] = $urunBilgisiContent["kdvdurum"];
                $this->sepetProper[$i]["kdv_oran"] = $urunBilgisiContent["kdvoran"];
                $this->sepetProper[$i]["tekilFiyat"] = $fiyat;
                $this->sepetProper[$i]["kdvDahilFiyat"] = $urunKDVDahilFiyat;
                $this->sepetProper[$i]["kdvHariçFiyat"] = $urunKDVHaricFiyat;
                $this->sepetProper[$i]["kdvTutari"] = $urunKDVTutari;
                $this->sepetProper[$i]["image"] = $urunBilgisiContent["image"];
                $this->sepetProper[$i]["image_two"] = $urunBilgisiContent["image_two"];

                //sepet agirligini hesapla
                $this->sepetAgirlik += $urunBilgisiContent["agirlik"] * $value["adet"];
            }
            else {
//        $this->sepetProper = "ürün bulunamadı";
            }
            $i++;
        }

        $this->price = $this->sepetKDVDahilTutar;

        // urunde agirlik ve girliksiz urunler var ise

        //toplam fiyat ve kargo işlemi
        if ($this->kargoDurum) {
            $kargoBilgisi = $VT->veriGetir("kargolimit", "WHERE durum=?", array(1));

            if ($kargoBilgisi) {
                // 100 den farklı bir deger gorurse yeni sinir o olsun
                $kargoSinirTl = 100;
                foreach ($kargoBilgisi as $row => $value) {
                    if ($value["birim"] == 1) {
                        $kargoSinirTl = $value["sinir"];
                    }
                }

                if ($this->price < $kargoSinirTl) {
                    $kargoSinirGr = 0;

                    foreach ($kargoBilgisi as $row => $value) {
                        if ($value["birim"] == 2) {
                            if ($this->sepetAgirlik > $value["sinir"] && $value["sinir"] > $kargoSinirGr) {
                                $kargoSinirGr = $value["sinir"];

                                $this->kargoUcreti = $value["kargotutar"];
                            }
                        }
                    }

                    $this->price = $this->price + $this->kargoUcreti;
                    $this->kargoDurum = 1;
                }
                else {
                    $this->kargoDurum = 0;
                }
            }
            else {
                //kargo bilgisi bulunamadı :/
                // yok ise kargo fiyatı eklemez
            }
        }

        return $this;
    }

    public function KuponKullan($kuponKodu)
    {
        $VT = new VT();

        //kupon indirimi uygulanması
        if ($kuponKodu) {
            $kuponBilgisi = $VT->VeriGetir("kuponlar", "WHERE kod=? AND durum=?", array($kuponKodu, 1), "ORDER BY ID ASC", 1);

            if ($kuponBilgisi) {
                $kuponAdet = $kuponBilgisi[0]["adet"];
                if ($kuponAdet > 0) {
                    $currentDate = date("Y-m-d");
                    $kuponDate = $kuponBilgisi[0]["sure"];

                    if ($kuponDate > $currentDate) {
                        $this->kuponYuzde = $kuponBilgisi[0]["yuzde"];
                        $this->kuponDurum = 1;
                    }
                    else {
                        $this->kuponDurum = 3;
                    }
                }
                else {
                    $this->kuponDurum = 4;
                }
            }
            else {
                $this->kuponDurum = 2;
            }
        }

        if ($this->kargoDurum) {
            $this->price = $this->price - $this->kargoUcreti;
        }

        //kdv dahil toplam ve kupon işlemi
        $this->kuponKazanc = $this->price * $this->kuponYuzde / 100;
        $this->price = $this->price - $this->kuponKazanc;

        $kargoBilgisi = $VT->veriGetir("kargolimit", "WHERE durum=?", array(1), "", 1)[0];
        if ($this->price < $kargoBilgisi["sinir"]) {
            $this->price = $this->price + $this->kargoUcreti;
            $this->kargoDurum = 1;
        }
        else {
            $this->kargoDurum = 0;
        }
    }
}
