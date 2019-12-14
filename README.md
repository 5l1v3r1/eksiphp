

# Eksi-PHP
Ekşi Sözlüğün unofficial API'si. Ekşi Sözlük'ten Entry/Kullanıcı/Gündem çeker.

## Başlarken

Bu API resmi değildir. Tamamen Unofficaldir.

Örnek Kod: https://github.com/Quiec/Eksi-PHP/blob/master/eksi.php

## To-Do
- Baslik fonksiyonun sayfaya a getirilcek. (Tum sayfadaki entryler cekilcek)
- Kullanıcı entryleri ve bilgileri cekecek.
- Bugun feedi eklenebilir.
- Entry ID'i ile entry cekmek.
- Entry düzenleme tarihinde bazı düzenlemeler.

## Fonksiyonlar

### ->Gundem()

Bu fonksiyon Ekşi Sözlük gündemini çeker.
	
Fonksiyon seçenekleri:
	

 -  ->Gundem(spesifik sayı)

	Bu fonksiyon Gundem'den belirli başlığı seçer. Sayı 55'ten az olmalıdır.
	  
	   Kullanımı:
	
    `print_r($eksi->Gundem(1));
	//yada
	echo  $eksi->Gundem(1)["baslik"];`
	
	Sonuç:
	
	  `Array ( [baslik] => kanal istanbul bütçesinin 76 milyar dolar olması [giri] => 146 [link] => /kanal-istanbul-butcesinin-76-milyar-dolar-olmasi--6281679?a=popular )`
		
 -  ->Gundem(a)

	Bu fonksiyon Gundemi tamamen döndürür. Toplam 55 tane başlık getirir.
	  
	   Kullanımı:
	
    `$eksi->Gundem("a");`
	Json_Decode yada Print_R kullanılabilinir.
	
### ->Baslik()

Bu fonksiyon bir başlıktaki tüm entryleri çeker.
	
Fonksiyon seçenekleri:
	

 -  ->Baslik("Başlık Adı", Spesifik Sayı(entry), Spesifik Sayı (sayfa))

	Bu fonksiyon belirli entry ve sayfayı seçer. Sayfa fazla olunca hata verebilir (herhangi bir hata eklemedim, not yet). Entry 10'dan az olmalı
	  
	   Kullanımı:
	
    `print_r($eksi->Baslik("php", 1, 1));
	//yada
	echo  $eksi->Baslik("php", 1, 1)["entry"];`
	
	Sonuç:
	
	  `Array ( [id] => 36400 [entry] => sonbahar 1994'de rasmus lerdorf tarafindan geli$tirilen preprocessing language.. http://www.php.net/ [sahibi] => disq [zaman] => Array ( [0] => 938120400 [1] => ) )`
		
 -  ->Baslik("Başlık Adı", a, Spesifik Sayı)

	Bu fonksiyon Başlığı tamamen döndürür. Toplam 10 tane entry getirir. Sayfa sizin tercihinizdir (a desteği gelmedi).
	  
	   Kullanımı:
	
    `$eksi->Baslik("php", a, 1);`
	Json_Decode yada Print_R kullanılabilinir.

