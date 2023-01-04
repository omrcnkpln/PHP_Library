<?php

/**
 * Class DB             --> veritabanı işlemleri için pdo cümleciklerini otomatize eder
 */
class DB
{
    public $sunucu;
    public $user;
    public $password;
    public $dbname;
    public $baglantiPDO;

    function __construct()
    {
        $this->sunucu = "localhost";
        $this->user = "root";
        $this->password = "";
        $this->dbname = "yazlab_1_3_2021";

        try {
            $this->baglantiPDO = new PDO("mysql:host=" . $this->sunucu . ";dbname=" . $this->dbname . ";charset=utf8;", $this->user, $this->password);

        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }

    /**
     * @param $param                --> alınan değeri yazdırır
     */
    public function pr($param)
    {
        echo '</br><pre>';
        print_r($param);
        echo '</br></pre>';
    }

    /**
     * @param $tablo                --> tablo ismi
     * @param array $column         --> güncellenecek sütun adları
     * @param array $columnValue    --> güncellenecek veriler
     * @param $uniqueCell           --> tabloda işlem yaptıracak benzersiz sütun adı
     * @param $cellValue            --> güncellenecek benzersiz satır kimlikleri
     * @return bool
     * @warning tablo veri tiplerine dikkat edilmeli
     */
    public function update($tablo, $column = [], $columnValue = [], $uniqueCell, $cellValue)
    {
        $this->baglantiPDO->query("SET CHARACTER SET utf8");
        $sql = "UPDATE " . $tablo;
        $sql .= " SET ";

        foreach ($column as $row1 => $value1) {
            $sql .= $value1 . " =?, ";
        }
        //sağdan bir boşluk ve virgülü sil
        $sql = rtrim($sql, ", ");
        $sql .= " WHERE " . $uniqueCell . " =?";

        $hazirla = $this->baglantiPDO->prepare($sql);

        //foreach ile yapamadık
        $i = 0;
        $arrSize = count($columnValue);
        while ($i < $arrSize) {
            $hazirla->bindParam($i + 1, $columnValue[$i], PDO::PARAM_STR);
            $i++;
        }

        $hazirla->bindParam($i + 1, $cellValue, PDO::PARAM_STR);
        $sonuc = $hazirla->execute();

        if ($sonuc) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param $table                    --> tablo ismi
     * @param string $columnArray       --> tablodaki sütun adları
     * @param string $columnValueArray  --> sütunlara yazılacak veriler
     * @return bool                     --> geriye true, false döndürür
     */
    public function insert($table, $columnArray = "", $columnValueArray = "")
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
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param $tablo
     * @param string $whereColumn
     * @param string $whereValue
     * @param string $orderby
     * @param string $limit
     * @return array|false
     */
    public function select($tablo, $whereColumn = "", $whereValue = "", $orderby = "", $limit = "")
    {
        $this->baglantiPDO->query("SET CHARACTER SET utf8");
        $sql = "SELECT * FROM " . $tablo;

        if (!empty($whereColumn) && !empty($whereValue)) {
            $sql .= " WHERE";

            foreach ($whereColumn as $row => $value){
                $sql .= " " . $value."=? AND";
            }

            $sql = rtrim($sql, "AND");

            if (!empty($orderby)) {
                $sql .= "ORDER BY " . $orderby;
            }
            if (!empty($limit)) {
                $sql .= " LIMIT " . $limit;
            }

            $calistir = $this->baglantiPDO->prepare($sql);
            $sonuc = $calistir->execute($whereValue);
            $veri = $calistir->fetchAll(PDO::FETCH_ASSOC);
        }
        else {
            if (!empty($orderby)) {
                $sql .= " ORDER BY " . $orderby;
            }

            if (!empty($limit)) {
                $sql .= " LIMIT " . $limit;
            }

            $calistir = $this->baglantiPDO->prepare($sql);
            $sonuc = $calistir->execute();
            $veri = $calistir->fetchAll(PDO::FETCH_ASSOC);
        }

        return $veri;
    }

    /**
     * @param $tablo                --> tablo ismi
     * @param $uniqueCell           --> tabloda işlem yaptıracak benzersiz sütun adı
     * @param array $uniqueValue    --> silinecek benzersiz id ler
     * @return int                  --> geriye etkilenen satır sayısını döndürür
     */
    public function delete($tablo, $uniqueCell, $uniqueValue = [])
    {
        $affectedRows = 0;
        $sql = "DELETE FROM " . $tablo;
        $sql .= " WHERE " . $uniqueCell . " = :id";

        $calistir = $this->baglantiPDO->prepare($sql);

        foreach ($uniqueValue as $row => $value) {
            $delete = $calistir->execute(array(
                'id' => $value
            ));

            if ($calistir->rowCount() > 0){
//                $this->pr($value . " numaralı veri silindi :)");
                $affectedRows++;
            }else{
//                $this->pr($value . " numaralı veri silinemedi :/");
            }
        }

        return $affectedRows;
    }

    /**
     * @param $val                      --> string ifadeyi güvenli filtreler
     * @param false $tag                --> html kullanma izni
     * @return string                   --> dize döndürür
     */
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
}
