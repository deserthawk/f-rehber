<?php 
require_once ('galeriVTK.php');
$tempGaleriVTK = new galeriVTK();

$localGetId = $_GET["pGetId"];
//print_r($localGetId);

if($localGetId==1501){
    die(json_encode($tempGaleriVTK->getFirmaGaleriList($_GET["pFirmaId"]), JSON_UNESCAPED_UNICODE));
}
if($localGetId==1511){
    die(json_encode($tempGaleriVTK->getFotografEtiketList($_GET["pId"]), JSON_UNESCAPED_UNICODE));
}
if($localGetId==1521){
    die(json_encode($tempGaleriVTK->firmaFotografSil($_GET["pId"]), JSON_UNESCAPED_UNICODE));
}

?>