<?php

require_once "simple_html_dom.php";

class eksi {
    public $url;

    function Gundem($Entry) {
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://eksisozluk.com/basliklar/gundem');
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $GundemSonuc = curl_exec($ch);

        $Gundem = str_get_html($GundemSonuc);

        if (isset($Entry)) {
            if (is_numeric($Entry)) {
                if ($Entry > 55) {
                    echo "<b> Hata Kodu: 1 </b> <br> Fazla Değer. Gundem fonksiyonu sayısı 55'ten büyük olamaz.";
                } else {
                $Link = $Gundem->find('.topic-list')[0]->find('li')[$Entry]->find('a')[0]->href;
                $Giri = $Gundem->find('.topic-list')[0]->find('li')[$Entry]->find('a')[0]->find('small')[0]->innertext;
                $Baslik = str_replace("<small>$Giri</small>", "", $Gundem->find('.topic-list')[0]->find('li')[$Entry]->find('a')[0]->innertext);        
                $Array = ["baslik" => $Baslik, "giri" => $Giri, "link" => $Link];

            }
            } elseif ($Entry == "a") {
                for ($i = 0; $i <= 55; $i++) {
                    $Link = $Gundem->find('.topic-list')[0]->find('li')[$i]->find('a')[0]->href;
                    $Giri = $Gundem->find('.topic-list')[0]->find('li')[$i]->find('small')[0]->innertext;
                    $Baslik = str_replace("<small>$Giri</small>", "", $Gundem->find('.topic-list')[0]->find('li')[$i]->find('a')[0]->innertext);    
                    $Array[$i] = ["baslik" => $Baslik, "giri" => $Giri, "link" => $Link];
                }

            } else {
                echo "<b> Hata Kodu: 0 </b> <br> Bilinmeyen Değer. Gundem fonksiyonu sadece <i> a / spesifik sayı ( < 55 ) </i> ile kullanılabilir.";
            }
        }
        
        $Gundem->clear();

        return $Array;
    }

}
