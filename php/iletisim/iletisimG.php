<?php 
require_once ('iletisimVTK.php');
$tempIletisimVTK = new iletisimVTK();

$localGetId = $_GET["pGetId"];

if($localGetId==1501){
    die(json_encode($tempIletisimVTK->guncelleOkundu($_GET["pIletisimId"]), JSON_UNESCAPED_UNICODE));
}
if($localGetId==1511){
    die(json_encode($tempIletisimVTK->sil($_GET["pIletisimId"]), JSON_UNESCAPED_UNICODE));
}
?>