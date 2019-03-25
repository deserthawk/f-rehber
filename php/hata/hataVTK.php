<?php 
require_once ('../genelFonksiyonlar.php');
require_once ('../vTabani/veriTabani.php');
require_once ('../warning.php');

class hataVTK{
    function ekle($pExceptionTanim,$pExceptionMsj,$pFonksiyonTnm,$pSqlCumle){
        try{
            $aliciIpAdres = get_client_ip_env();
            $buGun = gecerli_tarih_saat();
            
            $sql = "INSERT INTO tbl_hata
            (exception_tanim, exception_msj, fonksiyon_tnm, sql_cumle, ekleme_ip, ekleme_tarihi,drm_kodu)
            VALUES (:exceptionTanim , :exceptionMsj, :fonksiyonTnm, :sqlCumle, :eklemeIp, :eklemeTarih, 1)";
            
            $pdo = connectionVT();
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':exceptionTanim', $pExceptionTanim);
            $stmt->bindParam(':exceptionMsj', $pExceptionMsj);
            $stmt->bindParam(':fonksiyonTnm', $pFonksiyonTnm);
            $stmt->bindParam(':sqlCumle', $pSqlCumle);
            $stmt->bindParam(':eklemeIp', $aliciIpAdres);
            $stmt->bindParam(':eklemeTarih', $buGun);
            
            $stmt->execute();
        }
        catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
    }
    
    function getList(){
        $warningInfo = new Warning();
        $sonuc =array();
        try{
            $sql = "SELECT id, exception_tanim, exception_msj, 
                fonksiyon_tnm, sql_cumle, ekleme_ip, ekleme_tarihi 
                FROM tbl_hata";
            
            $pdo = connectionVT();
            $stmt = $pdo->prepare($sql);
            
            $stmt->execute();
            
            $result = $stmt->fetchAll();
            
            $warningInfo->setWarningId(0);
            $sonuc[] = $warningInfo;
            $sonuc[] = $result;
            $pdo = null;
            return $sonuc;
        }
        catch (PDOException $e) {
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm("Sorguda bir hata ile karþýlaþýldý.");
            return $warningInfo;
        }
    }
}

?>