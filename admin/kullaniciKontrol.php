<?php 
require_once ('../php/vTabani/veriTabani.php');
session_start();
if(isset($_SESSION["adminKullanici"])){
    $pdo = connectionVT();
    
    $sql = $pdo->prepare("select count(kas.id) as kullanici_var from tbl_kullanici_admin_session kas where
                    kas.kullanici_admin_id = :kullaniciAdminId and kas.sesion_id = :sessionId AND kas.drm_kodu=1");
    
    $sql->bindParam(':kullaniciAdminId', $_SESSION["adminKullanici"]);
    $sql->bindParam(':sessionId', $_SESSION["sessionId"]);
    
    $sql->execute();
    
    $result = $sql->fetch();
    
    if($result["kullanici_var"] == 0){
        header("Location: ../admin/giris.php");
    }
    //     $tempKullaniciSession = new kullaniciAdminSessionVTK();
    //     echo $tempKullaniciSession->kullaniciKontrol($_SESSION["adminKullanici"], $_SESSION["sessionId"]);
}
else{
    header("Location: ../admin/giris.php");
}
?>