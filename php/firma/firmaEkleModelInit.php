<?php 
//Make sure that it is a POST request.
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
    throw new Exception('Request method must be POST!');
}

//Make sure that the content type of the POST request has been set to application/json
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
if(strcasecmp($contentType, 'application/json') != 0){
    throw new Exception('Content type must be: application/json');
}

//Receive the RAW post data.
$content = trim(file_get_contents("php://input"));

//Attempt to decode the incoming RAW post data from JSON.
$decoded = json_decode($content, true);

//If json_decode failed, the JSON is invalid.
if(!is_array($decoded)){
    throw new Exception('Received content contained invalid JSON!');
}

$firmaMdl = new firmaEkleModel();

foreach ($decoded as &$row) {
    if($row["name"] == $firmaMdl->firmaAdiEkle){
        $firmaMdl->setFirmaAdi($row["value"]);
    }
    if(($row["name"] == $firmaMdl->telefonEkle)){
        $firmaMdl->setTelefon($row["value"]);
    }
    if(($row["name"] == $firmaMdl->cepTelefonuEkle)){
        $firmaMdl->setCepTelefonu($row["value"]);
    }
    if(($row["name"] == $firmaMdl->emailEkle)){
        $firmaMdl->setEmail($row["value"]);
    }
    if(($row["name"] == $firmaMdl->kontakKisiEkle)){
        $firmaMdl->setKontakKisi($row["value"]);
    }
    if(($row["name"] == $firmaMdl->kontakKisiTelefonEkle)){
        $firmaMdl->setKontakKisiTelefon($row["value"]);
    }
    if(($row["name"] == $firmaMdl->kontakKisiEmailEkle)){
        $firmaMdl->setKontakKisiEmail($row["value"]);
    }
    if(($row["name"] == $firmaMdl->ilEkle)){
        $firmaMdl->setIl($row["value"]);
    }
    if(($row["name"] == $firmaMdl->ilceEkle)){
        $firmaMdl->setIlce($row["value"]);
    }
    if(($row["name"] == $firmaMdl->adresEkle)){
        $firmaMdl->setAdres($row["value"]);
    }
    if(($row["name"] == $firmaMdl->webAdresiEkle)){
        $firmaMdl->setWebAdresi($row["value"]);
    }
}

?>