<?php 
require_once ('../genelPostKontrol.php');
require_once ('../genelFonksiyonlar.php');
require_once ('firmaVTK.php');
require_once ('firmaModel.php');
require_once ('../warning.php');

$returnArry = array();
$tempFirmaVTK = new firmaVTK();

if(isset($_POST['fotografciListTipId'])){
    $localGetId = $_POST['fotografciListTipId'];
}
if(isset($_POST['firmaListTipId'])){
    $localGetId = $_POST['firmaListTipId'];
}
if(isset($_POST['fotografciEkleTipId'])){
    $localGetId = $_POST['fotografciEkleTipId'];
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
    if ($localGetId == 1511) {
        die(json_encode($tempFirmaVTK->getList($_POST['firmaAdi'],$_POST['telefon'],0,$tempRNum), JSON_UNESCAPED_UNICODE));
    }
    
}
if($localGetId == 1521) {
    $warningInfo = new Warning();
    $tempFirmaVTK = new firmaVTK();
    
    $warningInfo = recaptchaKontrol();
    if($warningInfo->getWarningId()==1){
        $returnArry[]=$warningInfo;
        die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
    }
    
    $tempReturn = $tempFirmaVTK->ekleFirmaIletisim($_POST['firmaAdi'],$_POST['telefon'],null,$_POST['email'],$_POST['kisiad'].$_POST['kisisoyad'],null,null,$_POST['il'],$_POST['ilce'],null,null);
    if(!isset($tempReturn)){
        $warningInfo->setWarningId(0);
        $warningInfo->setWarningTnm("Bilgileriniz elimize ulaşmıştır. En kısa zamanda geri dönüş yapılacaktır.");
        $returnArry[] = $warningInfo;
        die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
    }
    
    $warningInfo->setWarningId(1);
    $warningInfo->setWarningTnm("Bir hata ile karşılaşıldı.");

    $returnArry[] = $warningInfo;
    die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
}
die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
?>