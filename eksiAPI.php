<?php
date_default_timezone_set('Europe/Istanbul');
require_once "simple_html_dom.php";

class eksi {
    public $url;
    function autoComplete($baslik) {
        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, 'https://eksisozluk.com/autocomplete/query?q='.$baslik.'&_=1576351666033');
        curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, array(
            'Referer: https://eksisozluk.com/',
            'X-Requested-With: XMLHttpRequest'
        ));
        return $Json = json_decode($GundemSonuc2 = curl_exec($ch2), true);
    }
    
    private function getBaslikID($baslik) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://eksisozluk.com/'.$baslik.'');
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $a = curl_exec($ch);
        $HTTPCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($HTTPCode == 404) {
            $Json = $this->autoComplete(substr($baslik, 0, -3));
            echo '<b> Hata Kodu: 2 </b> <br> Bilinmeyen Başlık. Böyle bir başlık yok. <i> '.$Json["Titles"][0].' </i> başlığını aratabilirsiniz.';
        } else {
            return $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        }

    }
    
    public function checkCookies ($cookies) {
        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, 'https://eksisozluk.com/');
        curl_setopt($ch2, CURLOPT_HEADER, true);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, array("Cookie: __gfp_64b=ADJ3JN5eiCcFFHzS0qms7uV6WPHWaO8Ibg3GwZ0Uxu3.57; _ga=GA1.2.1733273535.1576951415; _gid=GA1.2.1161511079.1576951415; ASP.NET_SessionId=led1i5kytz4pvl25mq2sqxtn; iq=1b32ef204ef44561991aff85ff309c89; __RequestVerificationToken=GxOECXB1FAS3pEa5fDSAtM5y-BBzXa8YbtseRcWcWd2XhERhU0XIZLm17lfi6tkMP-WVkZYNWwR0zG2do1QlPhlpLeVT6A5IC-mBmGa3NpY1; sticky_id=82a3c316ed3e3d8a1e5076a1756ad1e5; a=$cookies"));
        curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch2, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        $GirisSonuc = curl_exec($ch2);

        $Giris = str_get_html($GirisSonuc);
        $HTTPCode = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
        $NickName = $Giris->find('li[class=not-mobile]')[0]->find('a')[0]->title;


        if (isset($NickName)) {
            $this->cookie = $cookies;
            return true;
        } else {
            return false;
            echo "<b> Hata Kodu: 5 </b> <br> Giriş Başarısız. Sanırım, <i> cookiesiniz </i> süresi doldu. Yeni Cookies alınız.\n Sunucudan dönen hata: $HTTPCode";
        }
    }
    
    function sendEntry ($baslik, $entry) {

        $kuki = $this->cookie;
        $Id = explode("--", $this->getBaslikID($baslik))[1];

        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, 'https://eksisozluk.com/entry/ekle');
        curl_setopt($ch2, CURLOPT_HEADER, true);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, array("Cookie: __gfp_64b=ADJ3JN5eiCcFFHzS0qms7uV6WPHWaO8Ibg3GwZ0Uxu3.57; _ga=GA1.2.1733273535.1576951415; _gid=GA1.2.1161511079.1576951415; ASP.NET_SessionId=led1i5kytz4pvl25mq2sqxtn; iq=1b32ef204ef44561991aff85ff309c89; __RequestVerificationToken=GxOECXB1FAS3pEa5fDSAtM5y-BBzXa8YbtseRcWcWd2XhERhU0XIZLm17lfi6tkMP-WVkZYNWwR0zG2do1QlPhlpLeVT6A5IC-mBmGa3NpY1; sticky_id=82a3c316ed3e3d8a1e5076a1756ad1e5; a=$kuki"));
        curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch2, CURLOPT_POST, 1);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, "__RequestVerificationToken=xiQ8ZyP-DgTrarXdShqOTeBV4XQf333dLeEW4DZ7tp0EntWGDV3yzDimCJVzV6jlKgAe_8iDTVdhiHjwhv-2WZsKX9wj1QWY7zqH38hqRlY1&Title=$baslik&Id=$Id&ReturnUrl=&InputStartTime=22.12.2019+14%3A10%3A50&Content=$entry");     
        curl_setopt($ch2, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        $GirisSonuc = curl_exec($ch2);
        $url = curl_getinfo($ch2, CURLINFO_EFFECTIVE_URL);
        $HTTPCode = curl_getinfo($ch2, CURLINFO_HTTP_CODE);

        if (strstr($url, "/entry/")) {
            return str_replace("https://eksisozluk.com/entry/", "", $url);
        } else {
            echo "<b> Hata Kodu: 6 </b> <br> Entry Eklenemedi. Sanırım, <i> cookiesiniz </i> süresi doldu. Yeni Cookies alınız.\n Sunucudan dönen hata: $HTTPCode, $url";

        }

    }

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

    function Baslik($Baslik, $Giri = "a", $Sayfa = 1) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://eksisozluk.com/'.$Baslik.'');
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $a = curl_exec($ch);
        $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

        

        $info = curl_getinfo($ch);

        if ($info["http_code"] == "404") {
            $Json = $this->autoComplete(substr($Baslik, 0, -3));
            echo '<b> Hata Kodu: 2 </b> <br> Bilinmeyen Başlık. Böyle bir başlık yok. <i> '.$Json["Titles"][0].' </i> başlığını aratabilirsiniz.';
        } else {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, ''.$url.'?p='.$Sayfa.'');
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $BaslikSonuc = curl_exec($ch);
            
            $Basliki = str_get_html($BaslikSonuc);

            if ($Giri == "a") {
                for ($i = 0; $i <= 10; $i++) {
                    $EntryG = $Basliki->find('.content')[$i]->innertext;
                    $EntrySahibi = $Basliki->find('.entry-author')[$i]->innertext;
                    $EntryId = str_replace("/entry/", "", $Basliki->find('a[class=entry-date permalink]')[$i]->href);
                    $Unix = strtotime($Basliki->find('a[class=entry-date permalink]')[$i]->innertext);
                    $UnixAsil = $Basliki->find('a[class=entry-date permalink]')[$i]->innertext;
        
                    if (strstr($UnixAsil, "~")) {
                        $aa = explode("~", $UnixAsil);
                        $UnixSonuc = ["0" => strtotime($aa[0]), "1" => strtotime(''.substr($aa[0], 0, 10).''.$aa[1].'')];
                    } else {
                        $UnixSonuc = ["0" => $Unix, "1" => 0];
                    }
        
                    $Array[$i] = ["id" => $EntryId, "entry" => strip_tags($EntryG), "sahibi" => $EntrySahibi, "zaman" => $UnixSonuc];    
                }
            } elseif (is_numeric($Giri)) { 
                if ($Giri > 10) {
                    echo '<b> Hata Kodu: 3 </b> <br> Fazla Entry. Böyle bir entry yok. <i> < 10 </i> küçük olmalı.';
                } else {
                    $EntryG = $Basliki->find('.content')[$Giri]->innertext;
                    $EntrySahibi = $Basliki->find('.entry-author')[$Giri]->innertext;
                    $EntryId = str_replace("/entry/", "", $Basliki->find('a[class=entry-date permalink]')[$Giri]->href);
                    $Unix = strtotime($Basliki->find('a[class=entry-date permalink]')[$Giri]->innertext);
                    $UnixAsil = $Basliki->find('a[class=entry-date permalink]')[$Giri]->innertext;
        
                    if (strstr($UnixAsil, "~")) {
                        $aa = explode("~", $UnixAsil);
                        $UnixSonuc = ["0" => strtotime($aa[0]), "1" => strtotime(''.substr($aa[0], 0, 10).''.$aa[1].'')];
                    } else {
                        $UnixSonuc = ["0" => $Unix, "1" => 0];
                    }
        
                    $Array = ["id" => $EntryId, "entry" => strip_tags($EntryG), "sahibi" => $EntrySahibi, "zaman" => $UnixSonuc];    
                
                }
            } else {
                echo '<b> Hata Kodu: 4 </b> <br> Bilinmeyen değer. Başlık fonksiyonun değerleri sadece <i> a | sayi < 10 </i> olabilir.';

            }
            return $Array;

        }
    }

}
