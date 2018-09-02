<?php 
require_once ('../genelPostKontrol.php');
require_once ('iletisimVTK.php');
require_once ('../warning.php');

$tempIletisimVTK = new iletisimVTK();
$returnArry = array();
$warningInfo = new Warning();

if(isset($_POST['pGetId'])){
    $localGetId = $_POST['pGetId'];
}
if(isset($_POST['theFormId'])){
    $localGetId = $_POST['theFormId'];
}

if($localGetId==1501){
    $warningInfo = recaptchaKontrol();
    if($warningInfo->getWarningId()==1){
        $returnArry[]=$warningInfo;
        die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
    }
    
    $warningInfo = iletisimModelKontrol('iletisimKonu',"Lütfen KONU seçiniz.");
    if($warningInfo->getWarningId()==1){
        $returnArry[]=$warningInfo;
        die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
    }
    $warningInfo = iletisimModelKontrol('adSoyad',"Lütfen AD SOYAD alanını doldurunuz.");
    if($warningInfo->getWarningId()==1){
        $returnArry[]=$warningInfo;
        die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
    }
    $warningInfo = iletisimModelKontrol('mesaj',"Lütfen MESAJ alanını doldurunuz.");
    if($warningInfo->getWarningId()==1){
        $returnArry[]=$warningInfo;
        die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
    }
    
    $returnArry[]=$tempIletisimVTK->ekle($_POST['iletisimKonu'], $_POST['adSoyad'], $_POST['ePosta'],$_POST['telefon'],$_POST['mesaj']);
    die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
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
}
if($localGetId==1511){
    die(json_encode($tempIletisimVTK->getIletisimList($_POST['mesaj'], $_POST['iletisimKonu'], $_POST['mesajDurum'], 0, $tempRNum), JSON_UNESCAPED_UNICODE));
}

function iletisimModelKontrol($pPostId, $pHataString){
    $tempWarningInfo = new Warning();
    $tempWarningInfo->setWarningId(0);
    if(isset($_POST[$pPostId])){
        $iletisimKonu=$_POST[$pPostId];
        if($iletisimKonu==null || $iletisimKonu==""){
            $tempWarningInfo->setWarningId(1);
            $tempWarningInfo->setWarningTnm($pHataString);
            return $tempWarningInfo;
        }
    }
    return $tempWarningInfo;
    
}

function recaptchaKontrol(){
    $tempWarningInfo = new Warning();
    $tempWarningInfo->setWarningId(0);
    
    if(!isset($_POST['g-recaptcha-response'])){
        $tempWarningInfo->setWarningId(1);
        $tempWarningInfo->setWarningTnm("Recapctha hatası alındı.");
    }
    
    $response = $_POST["g-recaptcha-response"];
    
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => '6LcATm0UAAAAAM1ruyJYkl5gc8uhBDXpM29miflc',
        'response' => $response
    );
    $options = array(
        'http' => array (
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
            "Content-Length: ".strlen(http_build_query($data))."\r\n".
            "User-Agent:MyAgent/1.0\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    $captcha_success=json_decode($verify);
    if ($captcha_success->success==false) {
        $tempWarningInfo->setWarningId(1);
        $tempWarningInfo->setWarningTnm("Recapctha hatası alındı.");
        return $tempWarningInfo;
    }    
    
    
    return $tempWarningInfo;
}

?>