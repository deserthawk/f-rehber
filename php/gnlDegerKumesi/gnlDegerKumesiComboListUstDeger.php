<?php 
require_once ('gnlDegerKumesiVTK.php');

$tempGnlDegerKumesiVTK = new gnlDegerKumesiVTK();
die(json_encode($tempGnlDegerKumesiVTK->getComboListUstDegerId($_GET["degerKodu"],$_GET["ustDegerId"]), JSON_UNESCAPED_UNICODE));
?>