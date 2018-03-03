<?php 
require_once ('firmaVTK.php');
require_once ('../warning.php');

$tempFirmaVTK = new firmaVTK();
$tempFirmaIletisimVTK = new firmaIletisimVTK();
$sonuc =array();
$sonuc[] = $tempFirmaVTK->getFirmaDetay($_GET["pFirmaId"]);
$sonuc[] = $tempFirmaIletisimVTK->getFirmaIletisimList($_GET["pFirmaId"]);
$sonuc[] = $tempFirmaIletisimVTK->getFirmaIletisim($_GET["pFirmaId"],1); //adres bilgisi getirilir.
$sonuc[] = $tempFirmaIletisimVTK->getFirmaIletisim($_GET["pFirmaId"],5); //adres bilgisi getirilir.
die(json_encode($sonuc, JSON_UNESCAPED_UNICODE));

?>