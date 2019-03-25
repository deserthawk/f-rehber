<?php 
require_once ('../genelPostKontrol.php');

require_once ('hataVTK.php');

$returnArry = array();
$formFlag;

if(isset($_POST['hataLogFormTipId'])){
    $formFlag = $_POST['hataLogFormTipId'];
}


    //$tempfirmaIletisimModel = new firmaIletisimModel();
    $tempHataVTK = new hataVTK();

if ($formFlag == 1511) {
    
    die(json_encode($tempHataVTK->getList(), JSON_UNESCAPED_UNICODE));
}
?>