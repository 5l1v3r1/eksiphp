
<img alt="ekşi logo" aling="center" src="https://upload.wikimedia.org/wikipedia/commons/1/17/Ek%C5%9Fi_S%C3%B6zl%C3%BCk_logo.png"/>

# Eksi-PHP
Ekşi Sözlüğün unofficial API'si. Ekşi Sözlük'ten Entry/Kullanıcı/Gündem çeker. Giriş yapabilir, entry gönderebilirsiniz.

## Başlarken

Bu API resmi değildir. Tamamen Unofficaldir.

Örnek Kod: https://github.com/Quiec/Eksi-PHP/blob/master/eksi.php

## To-Do
Başında * olanlar önemli olanlardır.

- * Email:Password ile otomatik "a" cookiesi çekilcek.
- Vote, Entry Düzenleme, Entry Silme, *Özel Mesaj*, Kullanıcının Kendi Bilgileri, Takip Etme
- Baslik fonksiyonun sayfaya a getirilcek. (Tum entryler cekilcek)
- Kullanıcı entryleri ve bilgileri cekecek.
- * Bugun feedi eklenebilir.
- Entry ID'i ile entry cekmek.
- Entry düzenleme tarihinde bazı düzenlemeler.

## Fonksiyonlar

### ->autoComplete()
[![image](https://i.hizliresim.com/qArOlW.png)](https://hizliresim.com/qArOlW)

Bu fonksiyon Ekşi Sözlük otomatik tamamlamasını çeker.
	
Fonksiyon seçenekleri:

 -  ->autoComplete(string)

	Yazdığınız kelime ile alakalı yazar / başlık getirir.
	  
	   Kullanımı:
	
    `print_r($eksi->autoComplete("php"));
	//yada
	echo  $eksi->autoComplete("php")["Titles"][0];`
	
	Sonuç:
	
	  `Array ( [Titles] => Array ( [0] => php [1] => phpstorm [2] => phpbb [3] => c/c++ vs java vs c# vs php vs python [4] => r10.net'te 7500 tl değerinde php tabanlı oyun [5] => c c# php mysql java oracle css javascript bilmek [6] => php 5 [7] => yeni başlayanlar için php [8] => php hocam ) [Query] => php [Nicks] => Array ( [0] => php [1] => php benim isyanimdi [2] => phpsozluk ))`
	Json_Decode yada Print_R kullanılabilinir.
	

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

