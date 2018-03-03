<?php 
require_once ('firmaEkleModel.php');
require_once ('firmaEkleModelInit.php');
require_once ('firmaVTK.php');
require_once ('../warning.php');

$warningInfo = new Warning();
$tempFirmaVTK = new firmaVTK();
$warningInfo = $tempFirmaVTK->ekleFirmaIletisim($firmaMdl->getFirmaAdi(),$firmaMdl->getTelefon(),$firmaMdl->getCepTelefonu(),$firmaMdl->getEmail(),$firmaMdl->getKontakKisi(),$firmaMdl->getKontakKisiTelefon(),$firmaMdl->getKontakKisiEmail(),$firmaMdl->getIl(),$firmaMdl->getIlce(),$firmaMdl->getAdres(),$firmaMdl->getWebAdresi());
//print_r($warningInfo);
$returnArry = array();

if ($warningInfo != null) {
    //     $warningInfo->setWarningId(1);
    //     $warningInfo->setWarningTnm("Firma Eklemenememiştir");
    $returnArry[] = $warningInfo;
    //    print_r(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
    die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
    return;
}

$warningInfo = new Warning();
$warningInfo->setWarningId(0);
$warningInfo->setWarningTnm("Firma Ekleme işlemi başarıyla tamamlanmıştır.");
$returnArry[] = $warningInfo;
die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
?>