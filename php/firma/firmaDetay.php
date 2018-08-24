<?php 
require_once ('firmaVTK.php');
require_once ('../galeri/galeriVTK.php');
require_once ('../warning.php');

$tempFirmaVTK = new firmaVTK();
$tempFirmaIletisimVTK = new firmaIletisimVTK();
$tempGaleriVTK = new galeriVTK();
$sonuc =array();
$sonuc[] = $tempFirmaVTK->getFirmaDetay($_GET["pFirmaId"]);
$sonuc[] = $tempFirmaIletisimVTK->getFirmaIletisimList($_GET["pFirmaId"]);
$sonuc[] = $tempFirmaIletisimVTK->getFirmaIletisim($_GET["pFirmaId"],1); //adres bilgisi getirilir.
$sonuc[] = $tempFirmaIletisimVTK->getFirmaIletisim($_GET["pFirmaId"],5); //kontak bilgisi getirilir.
$sonuc[] = $tempFirmaIletisimVTK->getFirmaAdresText($_GET["pFirmaId"]); //firmanýn adresi tek bir satir olarak getirilir.
$sonuc[] = $tempGaleriVTK->getFirmaFotografList($_GET["pFirmaId"]);//firmaya ait olan fotograflar liste olarak getirilir.
die(json_encode($sonuc, JSON_UNESCAPED_UNICODE));

?>