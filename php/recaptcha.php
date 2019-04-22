<?php
require_once ('/sabit/sabitVTK.php'); 

function recaptchaKontrol(){
    $tempWarningInfo = new Warning();
    $tempWarningInfo->setWarningId(0);
    
    if(!isset($_POST['g-recaptcha-response'])){
        $tempWarningInfo->setWarningId(1);
        $tempWarningInfo->setWarningTnm("Token response Recapctha hatası alındı.");
    }
    
    $response = $_POST["g-recaptcha-response"];
    
    $tempSabitVTK = new sabitVTK();
    $recaptchaKey = $tempSabitVTK->getSabit("RECAPTCHA");
    
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => $recaptchaKey[0],
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
    //    return $verify;
    $captcha_success=json_decode($verify);
    if ($captcha_success->success==false) {
        $tempWarningInfo->setWarningId(1);
        $tempWarningInfo->setWarningTnm("Recaptcha hatası alındı.");
//         $tempWarningInfo->setWarningTnm($verify);
//        $tempWarningInfo->setWarningTnm($recaptchaKey);
        return $tempWarningInfo;
    }
    
    
    return $tempWarningInfo;
}
?>