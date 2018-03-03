<?php 
require_once ('firmaVTK.php');
require_once ('../warning.php');

$tempFirmaVTK = new firmaVTK();
die(json_encode($tempFirmaVTK->getList(), JSON_UNESCAPED_UNICODE));
?>