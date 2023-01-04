<?php


class Helpers
{
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

    public function uzanti($dosyaadi)
    {
        $parca = explode(".", $dosyaadi);
        $uzanti = end($parca);
        $donustur = strtolower($uzanti);

        return $donustur;
    }
}