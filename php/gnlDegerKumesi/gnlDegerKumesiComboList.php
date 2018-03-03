<?php 
require_once ('gnlDegerKumesiVTK.php');

$tempGnlDegerKumesiVTK = new gnlDegerKumesiVTK();
die(json_encode($tempGnlDegerKumesiVTK->getComboList($_GET["degerKodu"]), JSON_UNESCAPED_UNICODE));
?>