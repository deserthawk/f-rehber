<?php 
require_once ('../genelPostKontrol.php');
require_once ('galeriModel.php');
require_once ('galeriVTK.php');
require_once ('../warning.php');
require_once ('../sabit/sabitVTK.php');
$tempGaleriVTK = new galeriVTK();

$returnArry = array();
$formFlag;

if(isset($_POST['pGetId'])){
    $localGetId = $_POST['pGetId'];
}
if(isset($_POST['fotografTanimlaFormTipId'])){
    $localGetId = $_POST['fotografTanimlaFormTipId'];
}
if(isset($_POST['fotografYukleFormTipId'])){
    $localGetId = $_POST['fotografYukleFormTipId'];
}


if($localGetId==1501){
    die(json_encode($tempGaleriVTK->getFirmaGaleriList($_GET["pFirmaId"]), JSON_UNESCAPED_UNICODE));
}

if($localGetId==1511){
    $returnArry[]=$tempGaleriVTK->guncelle($_POST['fotografTanimlaFormId'], $_POST['onayGuncelle'], $_POST['fotografTanimlaFormNotHidden']);
    die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
}
if($localGetId==1521){
    
    $tempSabitVTK = new sabitVTK();
    $bfPath = $tempSabitVTK->getSabit("ADM_REAL_B_PATH");
    
    $rootPath = $bfPath[0];
    
    $warningInfo = new Warning();
    //directorynin olup olmadigi kontrol edilir.
    if (!is_dir($rootPath)) {
        $warningInfo->setWarningId(1);
        $warningInfo->setWarningTnm("Dosya yolu bulunamadı." .$rootPath);
        $returnArry[]=$warningInfo;
        die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
    }
    $fileName = uniqid();
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $rootPath . $fileName. '.jpg');
    //move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $rootPath . '/firma/galeri/kf/'. $fileName. '.jpg');
    //copy($rootPath . '/firma/galeri/bf/'. $fileName. '.jpg', $rootPath .  DIRECTORY_SEPARATOR . 'firma'. DIRECTORY_SEPARATOR . 'galeri'. DIRECTORY_SEPARATOR . 'kf'. DIRECTORY_SEPARATOR . $fileName. '.jpg');
    $returnArry[]=$tempGaleriVTK->ekle($_POST['fotografYukleFirmaId'], $fileName. '.jpg');
    die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
}

?>