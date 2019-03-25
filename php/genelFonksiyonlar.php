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
?>