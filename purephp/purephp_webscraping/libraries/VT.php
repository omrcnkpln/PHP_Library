<?php
/**
 * @var object $email
 * @var object $user_name
 * @var object $user_surname
 * @var object $user_id
 * @var object $user_rutbe
 */

namespace Libraries;

use Dotenv\Dotenv;
use Exception;
use Libraries\CustomCrypt;
use mysqli;
use PDO;
use System\Helpers\Helper;
use function System\Helpers\Helper;


class VT
{
    public $sunucu;
    public $user;
    public $password;
    public $dbname;
    public $baglantiPDO;
    public $baglantiMySQLi;

    function __construct()
    {
        $dotnet = Dotenv::createImmutable(dir);
        $dotnet->load();

        //tm global
        if ($_SERVER["SERVER_ADDR"] == $_ENV["DB_HOST"]) {
            $this->sunucu = $_ENV["DB_HOST"];
            $this->dbname = $_ENV["DB_DATABASE"];
            $this->user = $_ENV["DB_USERNAME"];
            $this->password = $_ENV["DB_PASSWORD"];
        }

        try {
            $this->baglantiPDO = new PDO("mysql:host=" . $this->sunucu . ";dbname=" . $this->dbname . ";charset=utf8;", $this->user, $this->password);
            $this->baglantiMySQLi = new mysqli("$this->sunucu", "$this->user", "$this->password", "$this->dbname");

            if ($this->baglantiMySQLi->connect_error) {
                echo $this->baglantiMySQLi->connect_error;
                exit();
            }
            else {
                $this->baglantiMySQLi->set_charset("utf8");
            }

        } catch (PDOException $error) {
            echo $error->getMessage();
            exit();
        }
    }

    //
    public function selectBoxDoldur($tablo, $uniqueColumn = "", $valueColumn = "", $selectedValue = "")
    {
        $veriler = $this->VeriGetir($tablo);
        $sonuc = [];
        $i = 0;

        foreach ($veriler as $row => $value) {
            if ($value[$uniqueColumn] == $selectedValue) {
                $sonuc[$i] = '
                <option selected="selected" value="' . $value[$uniqueColumn] . '">' . $value[$valueColumn] . '</option>
        ';
            }
            else {
                $sonuc[$i] = '
                <option value="' . $value[$uniqueColumn] . '">' . $value[$valueColumn] . '</option>
        ';
            }
            $i++;
        }
        return $sonuc;
    }

    public function sifrele($value, $islem = "decrypt")
    {
        $c = new CustomCrypt();

        if ($islem == "encrypt") {
            $value = $c->encrypt($value);
        }
        else {
            $value = $c->decrypt($value);
        }

        return $value;
    }

    //    @omrcnkpln tek veri yazar
    public function VeriGuncelle($tablo, $column, $columnValue, $rowID, $rowValue)
    {
        $this->baglantiPDO->query("SET CHARACTER SET utf8");
        $sql = "UPDATE " . $tablo;
        $sql .= " SET " . $column . " = ?";
        $sql .= " WHERE " . $rowID . " = ?";

        $hazirla = $this->baglantiPDO->prepare($sql);
        $hazirla->bindParam(1, $columnValue, PDO::PARAM_STR);
        $hazirla->bindParam(2, $rowValue, PDO::PARAM_STR);
        $sonuc = $hazirla->execute();

        if ($sonuc) {
            return TRUE;
        }
    }

    //    @omrcnkpln
    public function veriYaz($table, $columnArray = "", $columnValueArray = "")
    {
        $this->baglantiPDO->query("SET CHARACTER SET utf8");
        foreach ($columnArray as $row => $value) {
            $keys[] = ':' . $value;
        }

        $columnString = implode(',', $columnArray);
        $keys = implode(',', $keys);
        $sql = "INSERT INTO $table ($columnString) VALUES ($keys)";

        $combineData = array_combine($columnArray, $columnValueArray);
        $query = $this->baglantiPDO->prepare($sql);

        foreach ($combineData as $f => $v) {
            $query->bindValue(':' . $f, $v);
        }
        $sonuc = $query->execute();

        if ($sonuc) {
            return TRUE;
        }
    }

    public function VeriGetirCustom($sql = "", $values = "")
    {
        $this->baglantiPDO->query("SET CHARACTER SET utf8");
        $calistir = $this->baglantiPDO->prepare($sql);

        if ($values != NULL)
            $calistir->execute($values);
        else
            $calistir->execute();

        $sonuc = $calistir->fetchAll(PDO::FETCH_ASSOC);

        if ($sonuc) {
            return $sonuc;
        }
        else {
            return false;
        }
    }

    public function VeriGetir($tablo, $wherealanlar = "", $wherearraydeger = "", $orderby = "", $limit = "")
    {
//    $this->baglantiPDO->query("SET CHARACTER SET utf8");
        $sql = "SELECT * FROM " . $tablo; /*SELECT * FROM ayarlar*/

        if (!empty($wherealanlar) && !empty($wherearraydeger)) {
            $sql .= " " . $wherealanlar; /*SELECT * FROM ayarlarWHERE */

            if (!empty($orderby)) {
                $sql .= " " . $orderby;
            }
            if (!empty($limit)) {
                $sql .= " LIMIT " . $limit;
            }

            $calistir = $this->baglantiPDO->prepare($sql);
            $sonuc = $calistir->execute($wherearraydeger);
            $veri = $calistir->fetchAll(PDO::FETCH_ASSOC);
        }
        else {
            if (!empty($orderby)) {
                $sql .= " " . $orderby;
            }

            if (!empty($limit)) {
                $sql .= " LIMIT " . $limit;
            }
            $veri = $this->baglantiPDO->query($sql, PDO::FETCH_ASSOC);
        }

        if ($veri != false && !empty($veri)) {
            $datalar = array();
            foreach ($veri as $bilgiler) {
                $datalar[] = $bilgiler;
            }

            return $datalar;
        }
        else {
            return false;
        }
    }

    public function SorguCalistir($tablo, $alanlar = "", $degerlerarray = "", $limit = "")
    {
        $this->baglantiPDO->query("SET CHARACTER SET utf8");

        if (!empty($alanlar) && !empty($degerlerarray)) {
            $sql = $tablo . " " . $alanlar;

            if (!empty($limit)) {
                $sql .= " LIMIT " . $limit;
            }

            $calistir = $this->baglantiPDO->prepare($sql);
            $sonuc = $calistir->execute($degerlerarray);
        }
        else {
            $sql = $tablo;

            if (!empty($limit)) {
                $sql .= " LIMIT " . $limit;
            }

            $sonuc = $this->baglantiPDO->exec($sql);
        }

        if ($sonuc != false) {
            return true;
        }
        else {
            return false;
        }

        $this->baglantiPDO->query("SET CHARACTER SET utf8");
    }

    public function seflink($val)
    {
        $find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#', '?', '*', '!', '.', '(', ')');
        $replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp', '', '', '', '', '', '');
        $string = strtolower(str_replace($find, $replace, $val));
        $string = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $string);
        $string = trim(preg_replace('/\s+/', ' ', $string));
        $string = str_replace(' ', '-', $string);

        return $string;
    }

    public function ModulEkle()
    {
        if (!empty($_POST["baslik"])) {
            $baslik = $_POST["baslik"];

            if (!empty($_POST["durum"])) {
                $durum = 1;
            }
            else {
                $durum = 2;
            }

            $tablo = str_replace("-", "", $this->seflink($baslik));
            $kontrol = $this->VeriGetir("moduller", "WHERE tablo=?", array($tablo), "ORDER BY ID ASC", 1);

            if ($kontrol != false) {

                return false;
            }
            else {

                $tabloOlustur = $this->SorguCalistir('CREATE TABLE IF NOT EXISTS `' . $tablo . '` (

                  `ID` int(11) NOT NULL AUTO_INCREMENT,
                
                  `baslik` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
                
                  `seflink` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
                
                  `kategori` int(11) DEFAULT NULL,
                
                  `metin` text COLLATE utf8_turkish_ci,
                
                  `resim` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
                
                  `anahtar` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
                
                  `description` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
                
                  `durum` int(5) DEFAULT NULL,
                
                  `sirano` int(11) DEFAULT NULL,
                
                  `tarih` date DEFAULT NULL,
                
                  PRIMARY KEY (`ID`)
                
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=1 ;');

                $modulekle = $this->SorguCalistir("INSERT INTO moduller", "SET baslik=?, tablo=?, durum=?, tarih=?", array($baslik, $tablo, $durum, date("Y-m-d")));
                $kategoriekle = $this->SorguCalistir("INSERT INTO kategoriler", "SET baslik=?, seflink=?, tablo=?, durum=?, tarih=?", array($baslik, $tablo, 'modul', 1, date("Y-m-d")));

                if ($modulekle != false) {
                    return true;
                }
                else {
                    return false;
                }
            }
        }
        else {
            return false;
        }
    }

    public function filter($val, $tag = false)
    {
        if ($tag == false) {
            $val = addslashes(strip_tags(trim($val)));
        }
        else {
            $val = addslashes(trim($val));
        }
        return $val;
    }

    public function uzanti($dosyaadi)
    {
        $parca = explode(".", $dosyaadi);
        $uzanti = end($parca);
        $donustur = strtolower($uzanti);

        return $donustur;
    }

//  tabloya işlenerek yükleniyor
    public function uploadMulti($nesnename, $tablo = 'nan', $KID = 1, $yuklenecekyer = 'images/', $tur = 'img', $w = '', $h = '', $resimyazisi = '')
    {
        if ($tur == "img") {
            if (!empty($_FILES[$nesnename]["name"][0])) {
                $dosyanizinadi = $_FILES[$nesnename]["name"][0];
                $tmp_name = $_FILES[$nesnename]["tmp_name"][0];
                $uzanti = $this->uzanti($dosyanizinadi);

                if ($uzanti == "png" || $uzanti == "jpg" || $uzanti == "jpeg" || $uzanti == "gif") {
                    $resimler = array();

                    foreach ($_FILES[$nesnename] as $k => $l) {
                        foreach ($l as $i => $v) {
                            if (!array_key_exists($i, $resimler)) {
                                $resimler[$i] = array();
                            }
                            $resimler[$i][$k] = $v;
                        }
                    }

                    foreach ($resimler as $resim) {
                        $uzanti = $this->uzanti($resim["name"]);

                        if ($uzanti == "png" || $uzanti == "jpg" || $uzanti == "jpeg" || $uzanti == "gif") {
                            $handle = new verotFotoUpload($resim);

                            if ($handle->uploaded) {
                                /* Resmi Yeniden Adlandır */
                                $rand = uniqid(true);
                                $handle->file_new_name_body = $rand;

                                /* Resmi Yeniden Boyutlandır */
                                if (!empty($w)) {
                                    if (!empty($h)) {
                                        $handle->image_resize = true;

                                        $handle->image_x = $w;

                                        $handle->image_y = $h;
                                    }
                                    else {
                                        if ($handle->image_src_x > $w) {
                                            $handle->image_resize = true;

                                            $handle->image_x = $w;

                                            $handle->image_ratio_y = true;
                                        }
                                    }
                                }
                                else if (!empty($h)) {
                                    if ($handle->image_src_h > $h) {
                                        $handle->image_resize = true;
                                        $handle->image_y = $h;
                                        $handle->image_ratio_x = true;
                                    }
                                }

                                //üzerine yazı yazdırma
                                if (!empty($resimyazisi)) {
                                    $handle->image_text = $resimyazisi;
                                    $handle->image_text_color = '#FFFFFF';
                                    $handle->image_text_opacity = 80;
                                    //$handle->image_text_background = '#FFFFFF';
                                    $handle->image_text_background_opacity = 70;
                                    $handle->image_text_font = 5;
                                    $handle->image_text_padding = 1;
                                }

                                /* Resim Yükleme İzni */
                                $handle->allowed = array('image/*');

                                /* Resmi İşle */
                                //$handle->Process(realpath("../")."/upload/resim/");
                                $handle->Process($yuklenecekyer);
                                if ($handle->processed) {
                                    $yukleme = $rand . "." . $handle->image_src_type;
                                    if (!empty($yukleme)) {
                                        //$yuklemekontrol=$fnk->DKontrol("../images/resimler/".$yukleme);
                                        $sira = $this->IDGetir("resimler");
                                        $sql = $this->SorguCalistir("INSERT INTO resimler", "SET tablo=?, KID=?, resim=?, tarih=?", array($tablo, $KID, $yukleme, date("Y-m-d")));
                                    }
                                    else {
                                        return false;
                                    }
                                }
                                else {
                                    return false;
                                }
                                $handle->Clean();
                            }
                            else {
                                return false;
                            }
                        }
                    }
                    return true;
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    // Bunu çok kullanmıyorum
    public function upload($nesnename, $yuklenecekyer = ASSETS . 'images/', $tur = 'img', $w = '', $h = '', $resimyazisi = '')
    {
        if ($tur == "img") {
            if (!empty($_FILES[$nesnename]["name"])) {

                $dosyanizinadi = $_FILES[$nesnename]["name"];
                $tmp_name = $_FILES[$nesnename]["tmp_name"];
                $uzanti = $this->uzanti($dosyanizinadi);

                if ($uzanti == "png" || $uzanti == "jpg" || $uzanti == "jpeg" || $uzanti == "gif") {

                    $classIMG = new \Verot\Upload\Upload($_FILES[$nesnename]);

                    if ($classIMG->uploaded) {

                        if (!empty($w)) {
                            if (!empty($h)) {
                                $classIMG->image_resize = true;
                                $classIMG->image_x = $w;
                                $classIMG->image_y = $h;
                            }
                            else {
                                if ($classIMG->image_src_x > $w) {
                                    $classIMG->image_resize = true;
                                    $classIMG->image_ratio_y = true;
                                    $classIMG->image_x = $w;
                                }
                            }
                        }
                        else if (!empty($h)) {
                            if ($classIMG->image_src_h > $h) {
                                $classIMG->image_resize = true;
                                $classIMG->image_ratio_x = true;
                                $classIMG->image_y = $h;
                            }
                        }

                        if (!empty($resimyazisi)) {
                            $classIMG->image_text = $resimyazisi;
                            $classIMG->image_text_direction = 'v';
                            $classIMG->image_text_color = '#FFFFFF';
                            $classIMG->image_text_position = 'BL';
                        }
                        $rand = uniqid(true);
                        $classIMG->file_new_name_body = $rand;

                        $classIMG->Process($yuklenecekyer);
                        if ($classIMG->processed) {
                            $resimadi = $rand . "." . $classIMG->image_src_type;
                            return $resimadi;
                        }
                        else {
                            return false;
                        }
                    }
                    else {
                        return false;
                    }
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
        }
        else if ($tur == "ds") {
            if (!empty($_FILES[$nesnename]["name"])) {
                $dosyanizinadi = $_FILES[$nesnename]["name"];
                $tmp_name = $_FILES[$nesnename]["tmp_name"];
                $uzanti = $this->uzanti($dosyanizinadi);
                if ($uzanti == "doc" || $uzanti == "docx" || $uzanti == "pdf" || $uzanti == "xlsx" || $uzanti == "xls" || $uzanti == "ppt" || $uzanti == "xml" || $uzanti == "mp4" || $uzanti == "avi" || $uzanti == "mov") {
                    $classIMG = new upload($_FILES[$nesnename]);
                    if ($classIMG->uploaded) {
                        $rand = uniqid(true);
                        $classIMG->file_new_name_body = $rand;
                        $classIMG->Process($yuklenecekyer);
                        if ($classIMG->processed) {
                            $dokuman = $rand . "." . $uzanti;
                            return $dokuman;
                        }
                        else {
                            return false;
                        }
                    }
                }
            }
        }
        else {
            return false;
        }
    }

    public function kategoriGetir($tablo, $secID = "", $uz = -1)
    {
        $uz++;
        $kategori = $this->VeriGetir("kategoriler", "WHERE tablo=?", array($tablo), "ORDER BY ID ASC");
        if ($kategori != false) {
            for ($q = 0; $q < count($kategori); $q++) {
                $kategoriseflink = $kategori[$q]["seflink"];
                $kategoriID = $kategori[$q]["seflink"];

                if ($secID == $kategoriID) {
                    echo '<option value="' . $kategoriID . '" selected="selected">' . str_repeat("&nbsp;&nbsp;&nbsp;", $uz) . stripslashes($kategori[$q]["baslik"]) . '</option>';
                }
                else {
                    echo '<option value="' . $kategoriID . '">' . str_repeat("&nbsp;&nbsp;&nbsp;", $uz) . stripslashes($kategori[$q]["baslik"]) . '</option>';
                }

                if ($kategoriseflink == $tablo) {
                    break;
                }

                $this->kategoriGetir($kategoriseflink, $secID, $uz);
            }
        }
        else {
            return false;
        }
    }

    /*Ektra Bonus Fonksiyonlar*/
    /*
    * Sitenize gelen ziyaretçilerin rapoarlarını kaydedebilir ve hangi tarayıcıdan kaç ziyaretçinin sitenizi ziyaret ettiğini görebilirsiniz.
    * Buradaki fonksiyonlar eğitim serimizin 2. Etebında kurumsal firma ve e-ticaret siteleri oluşturulurken kullanılacaktır.
    */

    public function TekilCogul()
    {
        date_default_timezone_set('Europe/Istanbul');
        $tarih = date("Y-m-d");
        $IP = $this->ipGetir();
        $TARAYICI = $this->tarayiciGetir();
        $tarayicistatistic = $this->VeriGetir("ziyarettarayici", "", "", "ORDER BY ID ASC");
        $konts = $this->VeriGetir("ziyaretciler", "WHERE tarih=? AND IP=?", array($tarih, $IP), "ORDER BY ID ASC", 1);
        if (count($konts) > 0 && $konts != false) {
            $c = ($konts[0]["cogul"] + 1);
            $ID = $konts[0]["ID"];
            $gunc = $this->SorguCalistir("UPDATE ziyaretciler", "SET cogul=? WHERE ID=?", array($c, $ID), 1);
        }
        else {
            if (!empty($_COOKIE["siteSettingsUse"])) {
            }
            else {
                $eks = $this->SorguCalistir("INSERT INTO ziyaretciler", "SET IP=?, tarayici=?, tekil=?, cogul=?, xr=?, tarih=?", array($IP, $TARAYICI, 1, 1, 1, $tarih));
                @setcookie("siteSettingsUse", md5(rand(1, 99999)), time() + (60 * 60 * 8));
                if ($TARAYICI == "Google Chrome") {
                    $tbl = ($tarayicistatistic[0]["ziyaret"] + 1);
                    $tiid = $tarayicistatistic[0]["ID"];
                    $ersa = $this->SorguCalistir("UPDATE ziyarettarayici", "SET ziyaret=? WHERE ID=?", array($tbl, $tiid), 1);
                }
                else if ($TARAYICI == "İnternet Explorer") {
                    $tbl = ($tarayicistatistic[1]["ziyaret"] + 1);
                    $tiid = $tarayicistatistic[1]["ID"];
                    $ersa = $this->SorguCalistir("UPDATE ziyarettarayici", "SET ziyaret=? WHERE ID=?", array($tbl, $tiid), 1);
                }
                else if ($TARAYICI == "Firefox") {
                    $tbl = ($tarayicistatistic[2]["ziyaret"] + 1);
                    $tiid = $tarayicistatistic[2]["ID"];
                    $ersa = $this->SorguCalistir("UPDATE ziyarettarayici", "SET ziyaret=? WHERE ID=?", array($tbl, $tiid), 1);
                }
                else {
                    $tbl = ($tarayicistatistic[3]["ziyaret"] + 1);
                    $tiid = $tarayicistatistic[3]["ID"];
                    $ersa = $this->SorguCalistir("UPDATE ziyarettarayici", "SET ziyaret=? WHERE ID=?", array($tbl, $tiid), 1);
                }
            }
        }
        /*sayfa hızı hesaplama*/
        $start = microtime(true);
        $end = microtime(true);
        $time = mb_substr(($end - $start), 0, 4);
        $tarah = $this->SorguCalistir("UPDATE ziyarettarayici", "SET hiz=? WHERE ID=?", array($time, 5), 1);
    }

    public function tarayiciGetir()
    {
        $tarayiciBul = $_SERVER["HTTP_USER_AGENT"];
        $msie = strpos($tarayiciBul, 'MSIE') ? true : false;
        $firefox = strpos($tarayiciBul, 'Firefox') ? true : false;
        $chrome = strpos($tarayiciBul, 'Chrome') ? true : false;

        if (!empty($msie) && $msie != false) {
            $tarayici = "İnternet Explorer";
        }
        else if (!empty($firefox) && $firefox != false) {
            $tarayici = "Firefox";
        }
        else if (!empty($chrome) && $chrome != false) {
            $tarayici = "Google Chrome";
        }
        else {
            $tarayici = "Diğer";
        }

        return $tarayici;
    }

    public function ipGetir()
    {
        if (getenv("HTTP_CLIENT_IP")) {
            $ip = getenv("HTTP_CLIENT_IP");
        }
        elseif (getenv("HTTP_X_FORWARDED_FOR")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");

            if (strstr($ip, ',')) {
                $tmp = explode(',', $ip);
                $ip = trim($tmp[0]);
            }
        }
        else {
            $ip = getenv("REMOTE_ADDR");
        }

        return $ip;
    }

    public function IDGetir($tablo)
    {
        $sql = $this->baglantiPDO->query("SHOW TABLE STATUS FROM `" . $this->dbname . "` LIKE '" . $tablo . "'");

        if ($sql != false) {
            foreach ($sql as $sonuc) {
                $IDbilgisi = $sonuc["Auto_increment"];
                return $IDbilgisi;
            }
        }
        else {
            return false;
        }
    }

    public function UserClaimFill($username, $user_id = "", $user_rutbe = "")
    {
        session_destroy();
        session_start();

        $_SESSION["oturum"] = true;
        $_SESSION["username"] = $username;
        $_SESSION["uyeID"] = $user_id;
        $_SESSION["user_rutbe"] = $user_rutbe;

        $_SESSION["durum"] = $user_rutbe;
    }

    public function Auth($email, $rutbe)
    {
        if (!empty($email)) {
            $sorgu = "SELECT * FROM users WHERE user_mail = '{$email}' AND user_rutbe = '{$rutbe}'";
            $find_user = mysqli_query($this->baglantiMySQLi, $sorgu);

            if ($find_user) {
                $verify_user = mysqli_num_rows($find_user);
            }
            else {
                $verify_user = 0;
            }

            if ($verify_user > 0) {
                extract(mysqli_fetch_assoc($find_user));

                $this->UserClaimFill($email, $user_name, $user_surname, $user_id, $user_rutbe);

                return true;
            }
            else { // Kullanıcı bulunamadi
                return false;
            }
        }
        else { // Eksik bilgi var
            return false;
        }
    }

    public function AuthWithPass($email, $sifre, $rutbe)
    {
        if (!empty($email) && !empty($sifre)) {
            $sifre = md5($sifre);

            $sorgu = "SELECT * FROM users WHERE user_mail = '{$email}' AND user_password = '{$sifre}' AND user_rutbe = '{$rutbe}'";

            $find_user = mysqli_query($this->baglantiMySQLi, $sorgu);

            if ($find_user) {
                $verify_user = mysqli_num_rows($find_user);
            }
            else {
                $verify_user = 0;
            }

            if ($verify_user > 0) {
                extract(mysqli_fetch_assoc($find_user));
                $this->UserClaimFill($email, $user_name, $user_surname, $user_id, $user_rutbe);

                return true;
            }
            else { // Kullanıcı bulunamadi
                return false;
            }
        }
        else { // Eksik bilgi var
            return false;
        }
    }

    public function AuthWithPassUsername($username, $sifre, $rutbe)
    {
        if (!empty($username) && !empty($sifre)) {
            $sifre = md5($sifre);

            $sorgu = "SELECT * FROM users WHERE user_kadi = '{$username}' AND user_password = '{$sifre}' AND user_rutbe = '{$rutbe}'";

            $find_user = mysqli_query($this->baglantiMySQLi, $sorgu);

//            Helper::Pr($find_user);
//            exit();
            if ($find_user) {
                $verify_user = mysqli_num_rows($find_user);
            }
            else {
                $verify_user = 0;
            }

            if ($verify_user > 0) {
                extract(mysqli_fetch_assoc($find_user));
                $this->UserClaimFill($user_kadi, $user_id, $user_rutbe);

                return true;
            }
            else { // Kullanıcı bulunamadi
                return false;
            }
        }
        else { // Eksik bilgi var
            return false;
        }
    }

    public function Register($isim, $soyisim, $email, $okul, $sinif, $telNo, $sifre1, $sifre2, $hash, $rutbe)
    {
        $kadi = $email;
        if ($rutbe == 2) {
            if (empty($isim) || empty($soyisim) || empty($email) || empty($okul) || empty($telNo) || empty($sifre1) || empty($sifre2) || empty($hash) || empty($rutbe)) {
                $_SESSION["register-state"] = 0;
                return false;
            }
        }
        else {
            if (empty($isim) || empty($soyisim) || empty($email) || empty($okul) || empty($sinif) || empty($telNo) || empty($sifre1) || empty($sifre2) || empty($hash) || empty($rutbe)) {
                $_SESSION["register-state"] = 0;
                return false;
            }
        }

        $eposta_exist = mysqli_query($this->baglantiMySQLi, "SELECT * FROM users WHERE user_mail = '{$email}' LIMIT 1");
        $is_eposta_exist = mysqli_fetch_row($eposta_exist);

        if (($is_eposta_exist)) {
            $_SESSION["register-state"] = 1;
            return false;
        }
        else {
            if ($sifre1 != $sifre2) {
                $_SESSION["register-state"] = 2;
                return false;
            }
            else {
                $sifre = md5($_POST["sifre2"]);
                $kayit_ekle = mysqli_query($this->baglantiMySQLi, "INSERT INTO users(user_kadi, user_name,user_surname,user_mail,user_password,user_hash, user_rutbe, user_tip,user_durum) VALUES('$kadi', '$isim', '$soyisim', '$email', '$sifre', '$hash', '$rutbe', 1, 1)");

                if (!$kayit_ekle) {
                    $_SESSION["register-state"] = 3;
                    return false;
                }
                else {
                    $sorgu = "SELECT * FROM users ORDER BY user_id DESC LIMIT 0,1";
                    $get_lastID = mysqli_query($this->baglantiMySQLi, $sorgu);

                    if ($get_lastID) {
                        $lastID = mysqli_fetch_assoc($get_lastID)["user_id"];
                    }
                    else {
                        $lastID = 0;
                    }

                    if ($rutbe == 2) {
                        $kayit_ekle_bilgiler = mysqli_query($this->baglantiMySQLi, "INSERT INTO uyeler_bilgiler(bilgiler_user_id,bilgiler_okul,bilgiler_tel_no) VALUES('{$lastID}', '{$okul}', '{$telNo}')");
                    }
                    else {
                        $kayit_ekle_bilgiler = mysqli_query($this->baglantiMySQLi, "INSERT INTO uyeler_bilgiler(bilgiler_user_id,bilgiler_okul,bilgiler_sinif,bilgiler_tel_no) VALUES('{$lastID}', '{$okul}', '{$sinif}', '{$telNo}')");
                    }

                    if (!$kayit_ekle_bilgiler) {
                        $_SESSION["register-state"] = 3;
                        return false;
                    }
                    else {
                        $response = $this->AuthWithPass($email, $sifre1, $rutbe);

                        if ($response) {
                            return true;
                        }
                        else {
                            $_SESSION["durum"] = 4; // Yani basarisiz
                        }
                    }
                }
            }
        }
    }

    public function RegisterLess($isim, $soyisim, $email, $telNo, $hash, $rutbe)
    {
        $kadi = $email;

        $eposta_exist = mysqli_query($this->baglantiMySQLi, "SELECT * FROM users WHERE user_mail = '{$email}' LIMIT 1");
        $is_eposta_exist = mysqli_fetch_row($eposta_exist);

        if (($is_eposta_exist)) {
            $_SESSION["register-state"] = 1;
            return false;
        }
        else {
            $kayit_ekle = mysqli_query($this->baglantiMySQLi, "INSERT INTO users(user_kadi, user_name,user_surname,user_mail,user_hash, user_rutbe, user_tip,user_durum) VALUES('$kadi', '$isim', '$soyisim', '$email', '$hash', '$rutbe', 1, 0)");

            if (!$kayit_ekle) {
                $_SESSION["register-state"] = 3;
                return false;
            }
            else {
                $sorgu = "SELECT * FROM users ORDER BY user_id DESC LIMIT 0,1";
                $get_lastID = mysqli_query($this->baglantiMySQLi, $sorgu);

                if ($get_lastID) {
                    $lastID = mysqli_fetch_assoc($get_lastID)["user_id"];
                }
                else {
                    $lastID = 0;
                }

                $kayit_ekle_bilgiler = mysqli_query($this->baglantiMySQLi, "INSERT INTO uyeler_bilgiler(bilgiler_user_id,bilgiler_tel_no) VALUES('{$lastID}', '{$telNo}')");

                if (!$kayit_ekle_bilgiler) {
                    $_SESSION["register-state"] = 3;
                    return false;
                }
                else {
                    $response = $this->Auth($email, $rutbe);

                    if ($response) {
                        return true;
                    }
                    else {
                        $_SESSION["durum"] = 4; // Yani basarisiz
                    }
                }
            }
        }
    }

    public function Complete($isim, $soyisim, $okul, $telNo, $sinif, $major, $id)
    {
        $user_update = $this->SorguCalistir("UPDATE users", "SET user_name=?, user_surname=? WHERE user_id=?",
            array($isim, $soyisim, $id), 1);

        $user_bilgiler_update = $this->SorguCalistir("UPDATE uyeler_bilgiler", "SET bilgiler_okul=?, bilgiler_tel_no=?, bilgiler_sinif=?, bilgiler_major=? WHERE bilgiler_user_id=?",
            array($okul, $telNo, $sinif, $major, $id), 1);

//        echo var_dump($sinif);

        if ($user_update && $user_bilgiler_update) {
            $user_durum_update = $this->SorguCalistir("UPDATE users", "SET user_durum=? WHERE user_id=?",
                array(1, $id), 1);

            if ($user_durum_update) {
                return true;
            }

            return false;
        }

        return false;
    }

    public function IsUnique($table, $column, $value)
    {
        try {
            $sql = "SELECT * FROM {$table} WHERE {$column} = '{$value}' LIMIT 1";
            $execute = $this->baglantiMySQLi->query($sql);

            if (!$execute) {
                return true;
            }
            else {
                $is_exist = $execute->fetch_row();
                if ($is_exist) {
                    return false;
                }

                return true;
            }
        } catch (Exception $ex) {
            return false;
        }
    }
}
