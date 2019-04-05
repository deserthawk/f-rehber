<?php
function get_client_ip_env()
{
    $ipaddress = '';
    try {
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
    }
    catch(Exception $e){
        $ipaddress = $e->getMessage();
        die("ERROR:" . $e->getMessage());
    }
    return $ipaddress;
}

function gecerli_tarih_saat(){
    return date("Y/m/d h:i:s");
}
function hata_yaz($pExceptionTanim,$pExceptionMsj,$pFonksiyonTnm,$pSqlCumle){
    $hataVTK = new hataVTK();
    $hataVTK->ekle($pExceptionTanim, $pExceptionMsj,$pFonksiyonTnm,$pSqlCumle);
}
function replace_enter_space($str){
    $str = str_replace('\n', '', $str);
    $str = str_replace('\r', '', $str);
    return $str;
}
function recaptchaKontrol(){
    $tempWarningInfo = new Warning();
    $tempWarningInfo->setWarningId(0);
    
    if(!isset($_POST['g-recaptcha-response'])){
        $tempWarningInfo->setWarningId(1);
        $tempWarningInfo->setWarningTnm("Token response Recapctha hatası alındı.");
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
    //    return $verify;
    $captcha_success=json_decode($verify);
    if ($captcha_success->success==false) {
        $tempWarningInfo->setWarningId(1);
        $tempWarningInfo->setWarningTnm("Recaptcha hatası alındı.");
//         $tempWarningInfo->setWarningTnm($verify);
        return $tempWarningInfo;
    }
    
    
    return $tempWarningInfo;
}
?>