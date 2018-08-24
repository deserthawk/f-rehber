<?php 
require_once ('../genelPostKontrol.php');
require_once ('firmaVTK.php');
require_once ('firmaModel.php');

$returnArry = array();
$tempFirmaVTK = new firmaVTK();

if(isset($_POST['fotografciListTipId'])){
    $localGetId = $_POST['fotografciListTipId'];
}

$tempRNum;
/**
 * rNum degeri max olarak 100'e set edilir.
 */
if (isset($_POST['rNum'])) {
    if (intval($_POST['rNum']) > 100) {
        $tempRNum = 100;
    } else {
        $tempRNum = intval($_POST['rNum']);
    }

    /**
     * fotografcilistesi.php dosyasindan gelen sorgulama ve daha fazla sonuc getir buttonu buraya gelir.
     */
    if ($localGetId == 1501) {
        die(json_encode($tempFirmaVTK->getFirmaMainList($_POST['firmaAdi'], $_POST['ilAra'], 0, $tempRNum), JSON_UNESCAPED_UNICODE));
    }
}

die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
?>