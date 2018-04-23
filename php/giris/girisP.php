<?php 
require_once ('../genelPostKontrol.php');
require_once('../kullaniciAdmin/kullaniciAdminVTK.php');
require_once('../kullaniciAdminSession/kullaniciAdminSessionVTK.php');
require_once ('../warning.php');

$returnArry = array();
$tempKullaniciAdminVTK = new kullaniciAdminVTK();
$tempKullaniciAdminSessionVTK = new kullaniciAdminSessionVTK();

if(isset($_POST['pGirisId'])){
    $localPostId = $_POST['pGirisId'];
}

if($localPostId==1501){
//    print_r($tempKullaniciAdminVTK->getKullaniciVar($_POST['girisKullaniciAdi'], $_POST['girisSifre']));
    $warningInfo = $tempKullaniciAdminVTK->getKullaniciVar($_POST['girisKullaniciAdi'], $_POST['girisSifre']);
    if($warningInfo->warningId==0){
        $tempKullaniciId = $tempKullaniciAdminVTK->getKullaniciId($_POST['girisKullaniciAdi']);
        $warningSil=$tempKullaniciAdminSessionVTK->sil($tempKullaniciId[0]);
        if($warningSil->warningId==0){
            session_start();
            $tempKullaniciAdminSessionVTK->ekle($tempKullaniciId[0], $_SESSION["sessionId"]);
            $_SESSION["adminKullanici"] = $tempKullaniciId[0];
        }
    }
    
    $returnArry[] = $warningInfo;
    die(json_encode($returnArry, JSON_UNESCAPED_UNICODE));
    
    //die(json_encode($tempGaleriVTK->getFirmaGaleriList($_GET["pFirmaId"]), JSON_UNESCAPED_UNICODE));
}
?>