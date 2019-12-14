

# Eksi-PHP
Ekşi Sözlüğün unofficial API'si. Ekşi Sözlük'ten Entry/Kullanıcı/Gündem çeker.

## Başlarken

Bu API resmi değildir. Tamamen Unofficaldir.

Örnek Kod: https://github.com/Quiec/Eksi-PHP/blob/master/eksi.php
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
