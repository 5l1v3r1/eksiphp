<?php

// Classımızı Dahil Edelim
require "eksiAPI.php";

// Classımızı başlatalım
$eksi = new eksi();

if ($_GET["entry"] == "a") {
    // Tüm Genel'i yazdıralım.
    print_r($eksi->Gundem("a")); 
} else {
    // Sayı ile özel giri çekelim.
    echo $eksi->Gundem(1)["baslik"];
}
