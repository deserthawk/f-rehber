<?php
require_once ('../genelFonksiyonlar.php');
require_once ('../vTabani/veriTabani.php');
require_once ('galeriVTE.php');
require_once ('../warning.php');
require_once ('../galeriEtiket/galeriEtiketVTK.php');
require_once ('../sabit/sabitVTK.php');

class galeriVTK
{
    
    function getDosyaAdi($pFotografId){
        
        $warningInfo = new Warning();
        
        try {
            $tempSabitVTE = new sabitVTE();
            
            $pdo = connectionVT();
            $sql = $pdo->prepare("select dosya_adi from tbl_galeri where id = :id");
            $sql->bindParam(':id', $pFotografId);
            $sql->execute();
            
            $result = $sql->fetch();
            
            return $result;
        } catch (PDOException $e) {
            //to_do log tablosuna veri yazılır.
            
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm("Veri tabanı hatası alındı.");
            return $warningInfo;
        }
        
    }

    function getFirmaGaleriList($pFirmaId)
    {
        $warningInfo = new Warning();
        
        try {
            $tempGaleriVTE = new galeriVTE();
            
            $pdo = connectionVT();
            $sql = $pdo->prepare("select id, firma_id,dosya_adi , concat((select sabit_deger from tbl_sabit where sabit_kodu = 'ADM_GLR_KF_PATH' ) , dosya_adi) k_dosya_adi,
                                concat((select sabit_deger from tbl_sabit where sabit_kodu = 'ADM_GLR_BF_PATH' ) , dosya_adi) b_dosya_adi,
                                (select deger from tbl_gnl_deger_kumesi where id = fotograf_durum) fotograf_durum_tnm, 
                                fotograf_durum, fotograf_not from tbl_galeri where firma_id = :firmaId");
            $sql->bindParam(':firmaId', $pFirmaId);
            $sql->execute();
            
            $result = $sql->fetchAll();
            
            return $result;
        } catch (PDOException $e) {
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm("Bir hata ile karşılaşıldı.");
            return $warningInfo;
        }
    }
    
    function getFotografEtiketList($pFotografId){
        $warningInfo = new Warning();
        
        try {
            $pdo = connectionVT();
            $sql = $pdo->prepare("select ge.id, gdk.deger from tbl_galeri_etiket ge, tbl_galeri g, 
                                tbl_gnl_deger_kumesi gdk where g.id = ge.galeri_id and gdk.id = ge.etiket_tnm_id 
                                and g.id = :galeriId");
            $sql->bindParam(':galeriId', $pFotografId);
            $sql->execute();
            $result = $sql->fetchAll();
            return $result;
        }
        catch (PDOException $e) {
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm("Bir hata ile karşılaşıldı.");
            return $warningInfo;
        }
    }
    
    function getFirmaFotografList($pFirmaId){
        $warningInfo = new Warning();
        
        try{
            $pdo = connectionVT();
            $sql = $pdo->prepare("select concat(ks.path, ks.dosya_adi) fotosrc
                                from (select (select ts.sabit_deger from tbl_sabit ts 
                                where ts.sabit_kodu = 'USR_GLR_BF_PATH') as path, 
                                tg.dosya_adi from tbl_galeri tg where 
                                tg.firma_id = :firmaId  ) ks");
            $sql->bindParam(':firmaId', $pFirmaId);
            $sql->execute();
            $result = $sql->fetchAll();
            return $result;
        }
        catch (PDOException $e) {
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm("Bir hata ile karşılaşıldı.");
            return $warningInfo;
        }
    }
    
    function ekle($pFirmaId,$pDosyaAdi){
        $warningInfo = new Warning();
        
        try {
            $aliciIpAdres = get_client_ip_env();
            $buGun = gecerli_tarih_saat();
            
            $tempGaleriVTE = new galeriVTE();
            
            // create prepared statement
            $sql = "INSERT INTO test_fotograf.tbl_galeri
                        (firma_id, dosya_adi, ekleme_ip, ekleme_tarihi)
                        VALUES (:firmaId, :dosyaAdi, :eklemeIp, :eklemeTarihi)";
                // print_r($sql);
                $pdo = connectionVT();
                $stmt = $pdo->prepare($sql);
                // $pFirmaAdi = $firmaMdl->getFirmaAdi();
                // bind parameters to statement
                $stmt->bindParam(':firmaId', $pFirmaId);
                $stmt->bindParam(':dosyaAdi', $pDosyaAdi);
                $stmt->bindParam(':eklemeIp', $aliciIpAdres);
                $stmt->bindParam(':eklemeTarihi', $buGun);
                // execute the prepared statement
                $stmt->execute();
                $warningInfo->setWarningId(0);
                $warningInfo->setWarningTnm("Fotoğraf Eklendi.");
                return $warningInfo;
        } catch (PDOException $e) {
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm($e->getMessage());
            return $warningInfo;
        }   
    }
    
    function guncelle($pFotografId,$pFotografDurum,$pFotografNot){
        $warningInfo = new Warning();
        
        try {
            $aliciIpAdres = get_client_ip_env();
            $buGun = gecerli_tarih_saat();
            
            $tempGaleriVTE = new galeriVTE();
            
            // create prepared statement
            $sql = "UPDATE test_fotograf.tbl_galeri SET 
                    fotograf_durum = :fotografDurum, fotograf_not = :fotografNot, 
                    guncelleme_ip = :guncellemeIp, guncelleme_tarihi = :guncellemeTarihi WHERE id = :fotografId";
            // print_r($sql);
            $pdo = connectionVT();
            $stmt = $pdo->prepare($sql);
            // $pFirmaAdi = $firmaMdl->getFirmaAdi();
            // bind parameters to statement
            $stmt->bindParam(':fotografDurum', $pFotografDurum);
            $stmt->bindParam(':fotografNot', $pFotografNot);
            $stmt->bindParam(':guncellemeIp', $aliciIpAdres);
            $stmt->bindParam(':guncellemeTarihi', $buGun);
            $stmt->bindParam(':fotografId', $pFotografId);
            // execute the prepared statement
            $stmt->execute();
            $warningInfo->setWarningId(0);
            $warningInfo->setWarningTnm("Fotoğraf Güncellendi.");
            return $warningInfo;
        } catch (PDOException $e) {
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm($e->getMessage());
            return $warningInfo;
        }   
    }
    
    function sil($pGaleriId){
        try{
            $warningInfo = new Warning();
            
            $sql="DELETE FROM tbl_galeri WHERE id=:id";
            
            $pdo = connectionVT();
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':id', $pGaleriId);
            $stmt->execute();
            
            $warningInfo->setWarningId(0);
            $warningInfo->setWarningTnm("Fotoğraf silindi.");
            
            return $warningInfo;
        }
        catch (PDOException $e) {
            //to_do log tablosuna veri yazılır.
            
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm("Veri tabanı hatası alındı.");
            return $warningInfo;
        }
    }
    
    function firmaFotografSil($pFotografId){
        $warningInfo = new Warning();
        
        try{
            //fotografa ait etiketler silinir.
            $tempGaleriEtiketVTK = new galeriEtiketVTK();
            $warningInfo = $tempGaleriEtiketVTK->fotografEtiketSil($pFotografId);            
            if($warningInfo->getWarningId()!=0){
                return $warningInfo;
            }
            
            //fotograf satiri silinir.
            $dosyaAdi = $this->getDosyaAdi($pFotografId);
            
            $warningInfo = $this->sil($pFotografId);
            if($warningInfo->getWarningId()!=0){
                return $warningInfo;
            }
            
            //fotograf bf klasor yolundan silinir.
            $tempSabitVTK = new sabitVTK();
            $bfPath = $tempSabitVTK->getSabit("ADM_REAL_B_PATH");
            if(!unlink($bfPath[0].$dosyaAdi[0])){
                $warningInfo->setWarningId(1);
                $warningInfo->setWarningTnm("Bir hata alındı.");
                return $warningInfo;
            }
            //fotograf kf klasor yolundan silinir.
            $kfPath = $tempSabitVTK->getSabit("ADM_REAL_K_PATH");
            if(!unlink($kfPath[0].$dosyaAdi[0])){
                $warningInfo->setWarningId(1);
                $warningInfo->setWarningTnm("Bir hata alındı.");
                return $warningInfo;
            }
            
            $warningInfo->setWarningId(0);
            $warningInfo->setWarningTnm("Fotoğraf Silindi.");
            return $warningInfo;
        }
        catch (PDOException $e) {
            //to_do log tablosuna veri yazılır.
            
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm("Veri tabanı hatası alındı.");
            return $warningInfo;
        }
    }
    
    
}
?>