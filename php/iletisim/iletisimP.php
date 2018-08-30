<?php 
require_once ('../genelPostKontrol.php');
require_once ('iletisimVTK.php');
require_once ('../warning.php');

$tempIletisimVTK = new iletisimVTK();
$returnArry = array();
$warningInfo = new Warning();

if(isset($_POST['pGetId'])){
    $localGetId = $_POST['pGetId'];
}

if($localGetId==1501){
    $warningInfo = iletisimModelKontrol('iletisimKonu',"Lütfen KONU seçiniz.");
    if($warningInfo->getWarningId()==1){
        $returnArry[]=$warningInfo;
        die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
    }
    $warningInfo = iletisimModelKontrol('adSoyad',"Lütfen AD SOYAD alanını doldurunuz.");
    if($warningInfo->getWarningId()==1){
        $returnArry[]=$warningInfo;
        die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
    }
    $warningInfo = iletisimModelKontrol('mesaj',"Lütfen MESAJ alanını doldurunuz.");
    if($warningInfo->getWarningId()==1){
        $returnArry[]=$warningInfo;
        die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
    }
    
    $returnArry[]=$tempIletisimVTK->ekle($_POST['iletisimKonu'], $_POST['adSoyad'], $_POST['ePosta'],$_POST['telefon'],$_POST['mesaj']);
    die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
}

function iletisimModelKontrol($pPostId, $pHataString){
    $tempWarningInfo = new Warning();
    $tempWarningInfo->setWarningId(0);
    if(isset($_POST[$pPostId])){
        $iletisimKonu=$_POST[$pPostId];
        if($iletisimKonu==null || $iletisimKonu==""){
            $tempWarningInfo->setWarningId(1);
            $tempWarningInfo->setWarningTnm($pHataString);
            return $tempWarningInfo;
        }
    }
    return $tempWarningInfo;
    
}

?>