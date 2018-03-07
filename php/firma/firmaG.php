<?php 
require_once ('firmaVTK.php');
$tempFirmaVTK = new firmaVTK();

$localGetId = $_GET["pGetId"];

if($localGetId==1501){
    die(json_encode($tempFirmaVTK->getFirmaAdiById($_GET["pId"]), JSON_UNESCAPED_UNICODE));
}


?>