<?php
require_once ('../genelFonksiyonlar.php');
require_once ('../vTabani/veriTabani.php');
require_once ('firmaIletisimVTE.php');
require_once ('../warning.php');

class firmaIletisimVTK
{
    
    function getFirmaIletisimList($pFirmaId){
        
        $warningInfo = new Warning();
        
        try {
            $tempFirmaIletisimVTE = new firmaIletisimVTE();
            
            $pdo = connectionVT();
            $sql = $pdo->prepare("select fi.id , dk.deger, fi.deger1,fi.deger2,fi.deger3,
                    fi.deger4,fi.deger5,fi.deger6,fi.deger7,fi.deger8,fi.deger9,fi.deger10, 
                    dk.id as tipId, fi.firma_id from tbl_firma_iletisim fi, tbl_gnl_deger_kumesi dk where 
                    fi.iletisim_tip = dk.id and fi.firma_id = :firmaId and dk.deger_kodu = 'ILTSM' and dk.id != 1 and dk.id!=5");
            $sql->bindParam(':firmaId', $pFirmaId);
            $sql->execute();
            
            $result = $sql->fetchAll();
            
            return $result;
        } catch (PDOException $e) {
            $pdo->rollBack();
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm("Firma Eklenememiştir.");
            return $warningInfo;
        }
        
    }
    
    function getFirmaIletisim($pFirmaId,$pIletisimTipId){
        
        $warningInfo = new Warning();
        
        try {
            $tempFirmaIletisimVTE = new firmaIletisimVTE();
            
            $pdo = connectionVT();
            $sql = $pdo->prepare("select fi.id , dk.deger, fi.deger1,fi.deger2,fi.deger3,
                    fi.deger4,fi.deger5,fi.deger6,fi.deger7,fi.deger8,fi.deger9,fi.deger10,
                    dk.id as tipId, fi.firma_id from tbl_firma_iletisim fi, tbl_gnl_deger_kumesi dk where
                    fi.iletisim_tip = dk.id and fi.firma_id = :firmaId and dk.deger_kodu = 'ILTSM' and dk.id = :iletisimTipId");
            $sql->bindParam(':firmaId', $pFirmaId);
            $sql->bindParam(':iletisimTipId', $pIletisimTipId);
            $sql->execute();
            
            $result = $sql->fetch();
            
            return $result;
        } catch (PDOException $e) {
            $pdo->rollBack();
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm("Firma Eklenememiştir.");
            return $warningInfo;
        }
        
    }

    function ekle($pFirmaId, $pIletisimTip, $pDeger1, $pDeger2, $pDeger3, $pDeger4, $pDeger5, $pDeger6, $pDeger7, $pDeger8, $pDeger9, $pDeger10)
    {
        $warningInfo = new Warning();
        try {
            $aliciIpAdres = get_client_ip_env();
            $buGun = gecerli_tarih_saat();
            
            $tempFirmaIletisimVTE = new firmaIletisimVTE();
            
            // create prepared statement
            $sql = "INSERT INTO `" . $tempFirmaIletisimVTE->getTabloAdi() . "`( `" . $tempFirmaIletisimVTE->getFirmaId() . "`, `" . $tempFirmaIletisimVTE->getIletisimTip() . "`, 
                `" . $tempFirmaIletisimVTE->getDeger1() . "`, `" . $tempFirmaIletisimVTE->getDeger2() . "`, `" . $tempFirmaIletisimVTE->getDeger3() . "`, `" . $tempFirmaIletisimVTE->getDeger4() . "`, `" . $tempFirmaIletisimVTE->getDeger5() . "`, `" . $tempFirmaIletisimVTE->getDeger6() . "`, `" . $tempFirmaIletisimVTE->getDeger7() . "`, 
                `" . $tempFirmaIletisimVTE->getDeger8() . "`, `" . $tempFirmaIletisimVTE->getDeger9() . "`, `" . $tempFirmaIletisimVTE->getDeger10() . "`, `" . $tempFirmaIletisimVTE->getEklemeIp() . "`, `" . $tempFirmaIletisimVTE->getEklemeTarihi() . "`, 
               `" . $tempFirmaIletisimVTE->getDrmKodu() . "`) 
                VALUES (:firmaId,:iletisimTip,:deger1,:deger2,:deger3,
                :deger4,:deger5,:deger6,:deger7,:deger8,:deger9,
                :deger10,:eklemeIp,:eklemeTarih,1)";
            $pdo = connectionVT();
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':firmaId', $pFirmaId);
            $stmt->bindParam(':iletisimTip', $pIletisimTip);
            $stmt->bindParam(':deger1', $pDeger1);
            $stmt->bindParam(':deger2', $pDeger2);
            $stmt->bindParam(':deger3', $pDeger3);
            $stmt->bindParam(':deger4', $pDeger4);
            $stmt->bindParam(':deger5', $pDeger5);
            $stmt->bindParam(':deger6', $pDeger6);
            $stmt->bindParam(':deger7', $pDeger7);
            $stmt->bindParam(':deger8', $pDeger8);
            $stmt->bindParam(':deger9', $pDeger9);
            $stmt->bindParam(':deger10', $pDeger10);
            $stmt->bindParam(':eklemeIp', $aliciIpAdres);
            $stmt->bindParam(':eklemeTarih', $buGun);
            
            // execute the prepared statement
            $stmt->execute();
            $warningInfo->setWarningId(0);
            $warningInfo->setWarningTnm("Ekleme işlemi başarıyla tamamlandı.");
            return $warningInfo;
        } catch (PDOException $e) {
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm("İletişim Bilgisi Eklenememiştir.");
            return $warningInfo;
            //die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
    }
    
    function guncelle($pDeger1, $pDeger2, $pDeger3, $pDeger4, $pDeger5, $pDeger6, $pDeger7, $pDeger8, $pDeger9, $pDeger10,$pId){
        $warningInfo = new Warning();
        $sonuc =array();
        try{
            $aliciIpAdres = get_client_ip_env();
            $buGun = gecerli_tarih_saat();
            $tempFirmaIletisimVTE = new firmaIletisimVTE();
            
            $sql = "UPDATE tbl_firma_iletisim SET deger1=:deger1,deger2=:deger2,deger3=:deger3,deger4=:deger4,deger5=:deger5,deger6=:deger6,deger7=:deger7,deger8=:deger8,deger9=:deger9,deger10=:deger10,guncelleme_ip=:guncellemeIp,guncelleme_tarihi=:guncellemeTarihi WHERE id=:id";
            
            $pdo = connectionVT();
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':deger1', $pDeger1);
            $stmt->bindParam(':deger2', $pDeger2);
            $stmt->bindParam(':deger3', $pDeger3);
            $stmt->bindParam(':deger4', $pDeger4);
            $stmt->bindParam(':deger5', $pDeger5);
            $stmt->bindParam(':deger6', $pDeger6);
            $stmt->bindParam(':deger7', $pDeger7);
            $stmt->bindParam(':deger8', $pDeger8);
            $stmt->bindParam(':deger9', $pDeger9);
            $stmt->bindParam(':deger10', $pDeger10);
            $stmt->bindParam(':guncellemeIp', $aliciIpAdres);
            $stmt->bindParam(':guncellemeTarihi', $buGun);
            $stmt->bindParam(':id', $pId);
            
            $stmt->execute();
            
            $warningInfo->setWarningId(0);
            $warningInfo->setWarningTnm("Güncelleme işlemi başarıyla tamamlandı.");
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