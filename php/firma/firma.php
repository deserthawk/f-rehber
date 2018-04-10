<?php 
require_once ('../genelPostKontrol.php');
require_once ('firmaModel.php');
require_once ('firmaVTK.php');

$returnArry = array();
$formFlag;
$rootPath = "D:/wamp64/www/f-rehber/img";

if(isset($_POST['durumGuncelleFormTipId'])){
    $formFlag = $_POST['durumGuncelleFormTipId'];
}
if(isset($_POST['logoGuncelleFormTipId'])){
    $formFlag = $_POST['logoGuncelleFormTipId'];
}

$tempFirmaModel = new firmaModel(); 
$tempFirmaVTK = new firmaVTK();


if ($formFlag == 1511) {
    $tempFirmaModel->setId($_POST['durumGuncelleFirmaId']);
    $tempFirmaModel->setFirmaDrm($_POST['firmaDurumGuncelle']);
    $tempFirmaModel->setFirmaNot($_POST['durumGuncelleNot']);
    
    $returnArry[] = $tempFirmaVTK->firmaNotGuncelle($tempFirmaModel->getId(), $tempFirmaModel->getFirmaDrm(), $tempFirmaModel->getFirmaNot());
    die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
}
if($formFlag == 1512 ){
    $tempFirmaModel->setId($_POST['logoGuncelleFirmaId']);
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $rootPath . '/firma/logo/'. $tempFirmaModel->getId(). '.png');
}


?>