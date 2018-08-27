<?php 
require_once ('../genelPostKontrol.php');
require_once ('../sabit/sabitVTK.php');
require_once ('firmaModel.php');
require_once ('firmaVTK.php');

$returnArry = array();
$formFlag;
//$rootPath = "D:/wamp64/www/f-rehber/img";


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
    
    $boyutlar = getimagesize($_FILES["fileToUpload"]["tmp_name"]);    
    if($boyutlar[0] != 100 && $boyutlar[1] != 100 ){
        $warningInfo = new Warning();
        $warningInfo->setWarningId(1);
        $warningInfo->setWarningTnm("Girilen dosya boyutu " . $boyutlar[0] . " X " . $boyutlar[1].". Lütfen boyutlarý 100 X 100 þeklinde olan bir dosya yükleyiniz."  );
        $returnArry[] = $warningInfo;
        die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));        
    }
    
    $tempSabitVTK = new sabitVTK();
    $logoPath = $tempSabitVTK->getSabit("LOGO_REAL_PATH");    
    
    $tempFirmaModel->setId($_POST['logoGuncelleFirmaId']);
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $logoPath[0]. $tempFirmaModel->getId(). '.png');
    $returnArry[] = $tempFirmaVTK->firmaLogoGuncelle($tempFirmaModel->getId(),$tempFirmaModel->getId(). '.png');
 
    die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
}


?>