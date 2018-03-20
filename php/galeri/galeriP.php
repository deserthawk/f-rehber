<?php 
require_once ('../genelPostKontrol.php');
require_once ('galeriModel.php');
require_once ('galeriVTK.php');
$tempGaleriVTK = new galeriVTK();

$returnArry = array();
$formFlag;

$localGetId = $_GET["pGetId"];

if($localGetId==1501){
    die(json_encode($tempGaleriVTK->getFirmaGaleriList($_GET["pFirmaId"]), JSON_UNESCAPED_UNICODE));
}

?>