<?php 
require_once ('../genelFonksiyonlar.php');
require_once ('../vTabani/veriTabani.php');
require_once ('../warning.php');
require_once ('kullaniciAdminSessionVTE.php');

class kullaniciAdminSessionVTK
{
    function kullaniciKontrol($pKullaniciAdminId, $pSessionId){
        $warningInfo = new Warning();
        
        try{
            $tempKullaniciAdminSessionVTE = new kullaniciAdminSessionVTE();
            $pdo = connectionVT();
            
            $sql = $pdo->prepare("select count(kas.id) from tbl_kullanici_admin_session kas where
                    kas.kullanici_admin_id = :kullaniciAdminId and kas.sesion_id = :sessionId AND kas.drm_kodu=1");
            
            $sql->bindParam(':kullaniciAdminId', $pKullaniciAdminId);
            $sql->bindParam(':sessionId', $pSessionId);
            
            $sql->execute();
            
            $result = $sql->fetch();
            return $result;
            
        }
        catch (PDOException $e) {
            $pdo->rollBack();
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm("Firma Eklenememiþtir.");
            return $warningInfo;
        }
    }
    
    
    function ekle($pKullaniciAdminId,$pSesionId){
        $warningInfo = new Warning();
        
        try {
            $aliciIpAdres = get_client_ip_env();
            $buGun = gecerli_tarih_saat();
            
            $tempKullaniciAdminSessionVTE = new kullaniciAdminSessionVTE();
            
            $sql = "INSERT INTO tbl_kullanici_admin_session
                        (kullanici_admin_id, sesion_id, ekleme_ip, ekleme_tarihi)
                        VALUES (:kullaniciAdminId, :sesionId, :eklemeIp, :eklemeTarihi)";
            $pdo = connectionVT();
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':kullaniciAdminId', $pKullaniciAdminId);
            $stmt->bindParam(':sesionId', $pSesionId);
            $stmt->bindParam(':eklemeIp', $aliciIpAdres);
            $stmt->bindParam(':eklemeTarihi', $buGun);
            
            $stmt->execute();
            $warningInfo->setWarningId(0);
            $warningInfo->setWarningTnm("Fotoðraf Eklendi.");
            return $warningInfo;
            
        }
        catch (PDOException $e) {
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm($e->getMessage());
            return $warningInfo;
        }   
    }
    /**
     * silme iþlemi bu tabloda drm_kodununun update'i þeklinde yapýlýr.
     * @param unknown $pKullaniciAdminId
     * @return Warning
     */    
    function sil($pKullaniciAdminId){
        $warningInfo = new Warning();
        $sonuc =array();
        try{
            $aliciIpAdres = get_client_ip_env();
            $buGun = gecerli_tarih_saat();
            $tempKullaniciAdminSessionVTE = new kullaniciAdminSessionVTE();
            
            $sql = "UPDATE tbl_kullanici_admin_session SET drm_kodu=0, guncelleme_ip=:guncellemeIp,guncelleme_tarihi=:guncellemeTarihi WHERE kullanici_admin_id=:kullaniciAdminId";
            
            $pdo = connectionVT();
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':guncellemeIp', $aliciIpAdres);
            $stmt->bindParam(':guncellemeTarihi', $buGun);
            $stmt->bindParam(':kullaniciAdminId', $pKullaniciAdminId);
            
            $stmt->execute();
            
            //session_destroy();
            
            $warningInfo->setWarningId(0);
            return $warningInfo;
        }
        catch (PDOException $e) {
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm($e->getMessage());
            return $warningInfo;
        }
    }
}

?>