<?php

// Classımızı Dahil Edelim
require "eksiAPI.php";

// Classımızı başlatalım
$eksi = new eksi();

// Gundem yazdir.
if ($_GET["entry"] == "a") {
    // Tüm Genel'i yazdıralım.
    print_r($eksi->Gundem("a")); 
} else {
    // Sayı ile özel giri çekelim.
    echo $eksi->Gundem(1)["baslik"];
}

// Otomatik Giriş Yap ve Entry Gönder

$eksi->girisYap("foo@gmail.com", "bar");
$entryat = $eksi->sendEntry("php", "bu entry eksi-php ile gönderildi", "foo");

// https://github.com/Quiec/Eksi-PHP/wiki/Req1-%C3%87ekme

if ($entryat == true) {
  echo "entry gönderildi";
}

// Manuel Giriş Yap ve Entry Gönder

$eksi->setCookie("JXRCjouz3tW89/OQd4VBqGCARb9m0FZ+XIyTxpdw7KgN4Km2ZMDAbSkUBeqEHl8M3l0X+jpyLfb0o78AWeAbz3hhWLX4Y/+U=");
$entryat = $eksi->sendEntry("php", "bu entry eksi-php ile gönderildi", "foo");

// https://github.com/Quiec/Eksi-PHP/wiki/Req1-%C3%87ekme

if ($entryat == true) {
  echo "entry gönderildi";
}
