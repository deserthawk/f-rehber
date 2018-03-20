<?php 
require_once ('galeriEtiketVTK.php');
$tempGaleriEtiketVTK = new galeriEtiketVTK();

$localGetId = $_GET["pGetId"];
//print_r($localGetId);

if($localGetId==1501){
    die(json_encode($tempGaleriEtiketVTK->ekle($_GET["pFotografId"],$_GET["pEtiketId"]), JSON_UNESCAPED_UNICODE));
}
if($localGetId==1511){
    die(json_encode($tempGaleriEtiketVTK->sil($_GET["pId"]), JSON_UNESCAPED_UNICODE));
}

?>