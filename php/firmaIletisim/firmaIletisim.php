<?php 
require_once ('../genelPostKontrol.php');
require_once ('firmaIletisimModel.php');
require_once ('firmaIletisimVTK.php');

$returnArry = array();
$formFlag;

if(isset($_POST['iletisimGuncelleFormTipId'])){
    $formFlag = $_POST['iletisimGuncelleFormTipId'];
}
if(isset($_POST['adresGuncelleFormTipId'])){
    $formFlag = $_POST['adresGuncelleFormTipId'];
}
if(isset($_POST['kontakPersonelGuncelleFormTipId'])){
    $formFlag = $_POST['kontakPersonelGuncelleFormTipId'];
}
if(isset($_POST['iletisimEkleFormTipId'])){
    $formFlag = $_POST['iletisimEkleFormTipId'];
}

    $tempfirmaIletisimModel = new firmaIletisimModel();
    $tempFirmaIletisimVTK = new firmaIletisimVTK();

if ($formFlag == 1511) {
    $tempfirmaIletisimModel->setId($_POST['iletisimGuncelleId']);
    $tempfirmaIletisimModel->setFirmaId($_POST['iletisimGuncelleFirmaId']);
    $tempfirmaIletisimModel->setIletisimTip($_POST['iletisimGuncelleIletisimTipId']);
    $tempfirmaIletisimModel->setDeger1($_POST['iletisimGuncelleDeger1']);
    
    $returnArry[] = $tempFirmaIletisimVTK->guncelle($tempfirmaIletisimModel->getDeger1(), NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, $tempfirmaIletisimModel->getId());
    die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
}
if ($formFlag == 1512) {
    $tempfirmaIletisimModel->setId($_POST['adresGuncelleId']);
    $tempfirmaIletisimModel->setFirmaId($_POST['adresGuncelleFirmaId']);
    $tempfirmaIletisimModel->setDeger1($_POST['ilGuncelle']);
    $tempfirmaIletisimModel->setDeger2($_POST['ilceGuncelle']);
    $tempfirmaIletisimModel->setDeger3($_POST['adresGuncelle']);
    
    if($tempfirmaIletisimModel->getId()==NULL){
        $returnArry[] = $tempFirmaIletisimVTK->ekle($tempfirmaIletisimModel->getFirmaId(), 1 , $tempfirmaIletisimModel->getDeger1(), $tempfirmaIletisimModel->getDeger2(), $tempfirmaIletisimModel->getDeger3(), NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
    }
    
    $returnArry[] = $tempFirmaIletisimVTK->guncelle($tempfirmaIletisimModel->getDeger1(), $tempfirmaIletisimModel->getDeger2(), $tempfirmaIletisimModel->getDeger3(), NULL, NULL, NULL, NULL, NULL, NULL, NULL, $tempfirmaIletisimModel->getId());
    die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
    
}
if ($formFlag == 1513) {
    $tempfirmaIletisimModel->setId($_POST['kontakPersonelGuncelleId']);
    $tempfirmaIletisimModel->setFirmaId($_POST['kontakPersonelGuncelleFirmaId']);
    $tempfirmaIletisimModel->setDeger1($_POST['kontakPersonelGuncelleAdSoyad']);
    $tempfirmaIletisimModel->setDeger2($_POST['kontakPersonelGuncelleTelefon']);
    $tempfirmaIletisimModel->setDeger3($_POST['kontakPersonelGuncelleEmail']);
    
    if($tempfirmaIletisimModel->getId()==NULL){
        $returnArry[] = $tempFirmaIletisimVTK->ekle($tempfirmaIletisimModel->getFirmaId(), 5 , $tempfirmaIletisimModel->getDeger1(), $tempfirmaIletisimModel->getDeger2(), $tempfirmaIletisimModel->getDeger3(), NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
    }
    
    $returnArry[] = $tempFirmaIletisimVTK->guncelle($tempfirmaIletisimModel->getDeger1(), $tempfirmaIletisimModel->getDeger2(), $tempfirmaIletisimModel->getDeger3(), NULL, NULL, NULL, NULL, NULL, NULL, NULL, $tempfirmaIletisimModel->getId());
    die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
}
if ($formFlag == 1514) {
    $tempfirmaIletisimModel->setFirmaId($_POST['iletisimEkleFirmaId']);
    $tempfirmaIletisimModel->setIletisimTip($_POST['iletisimTipEkle']);
    $tempfirmaIletisimModel->setDeger1($_POST['iletisimDegerEkle']);
    
    $returnArry[] = $tempFirmaIletisimVTK->ekle($tempfirmaIletisimModel->getFirmaId(), $tempfirmaIletisimModel->getIletisimTip(), $tempfirmaIletisimModel->getDeger1(), NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
    die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
}
?>