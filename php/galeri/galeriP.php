<?php 
require_once ('../genelPostKontrol.php');
require_once ('galeriModel.php');
require_once ('galeriVTK.php');
$tempGaleriVTK = new galeriVTK();
$rootPath = $_SERVER['DOCUMENT_ROOT'] . "/f-rehber/img";

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
    $fileName = uniqid();
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $rootPath . '/firma/galeri/bf/'. $fileName. '.jpg');
    //move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $rootPath . '/firma/galeri/kf/'. $fileName. '.jpg');
    copy($rootPath . '/firma/galeri/bf/'. $fileName. '.jpg', $rootPath . '/firma/galeri/kf/'. $fileName. '.jpg');
    $returnArry[]=$tempGaleriVTK->ekle($_POST['fotografYukleFirmaId'], $fileName. '.jpg');
    die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
}

?>