<?php 
require_once('../kullaniciAdmin/kullaniciAdminVTK.php');
require_once('../kullaniciAdminSession/kullaniciAdminSessionVTK.php');

$localGetId = $_GET["pGetId"];
$tempKullaniciAdminSessionVTK = new kullaniciAdminSessionVTK();
session_start();
if($localGetId==1501){
    session_destroy();
    die(json_encode($tempKullaniciAdminSessionVTK->sil($_SESSION["adminKullanici"]), JSON_UNESCAPED_UNICODE));
}

?>