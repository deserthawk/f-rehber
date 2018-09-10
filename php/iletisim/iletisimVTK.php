<?php
require_once ('../genelFonksiyonlar.php');
require_once ('../vTabani/veriTabani.php');
require_once ('../warning.php');

class iletisimVTK
{

    function ekle($pIletisimTip, $pAdSoyad, $pEPosta, $pTelefon, $pMesaj)
    {
        $warningInfo = new Warning();
        
        try {
            $aliciIpAdres = get_client_ip_env();
            $buGun = gecerli_tarih_saat();
            
            // create prepared statement
            $sql = "INSERT INTO tbl_iletisim
                        ( iletisim_tip_id, ad_soyad, e_posta, telefon, mesaj, mesaj_durum, ekleme_ip, ekleme_tarihi)
                        VALUES (:iletisimTip , :adSoyad, :ePosta, :telefon, :mesaj, 36 ,:eklemeIp, :eklemeTarihi)";
            // print_r($sql);
            $pdo = connectionVT();
            $stmt = $pdo->prepare($sql);
            // $pFirmaAdi = $firmaMdl->getFirmaAdi();
            // bind parameters to statement
            $stmt->bindParam(':iletisimTip', $pIletisimTip);
            $stmt->bindParam(':adSoyad', $pAdSoyad);
            $stmt->bindParam(':ePosta', $pEPosta);
            $stmt->bindParam(':telefon', $pTelefon);
            $stmt->bindParam(':mesaj', $pMesaj);
            $stmt->bindParam(':eklemeIp', $aliciIpAdres);
            $stmt->bindParam(':eklemeTarihi', $buGun);
            // execute the prepared statement
            $stmt->execute();
            $warningInfo->setWarningId(0);
            $warningInfo->setWarningTnm("Mesaj İletildi.");
            return $warningInfo;
        } catch (PDOException $e) {
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
//            $warningInfo->setWarningTnm($e->getMessage());
            $warningInfo->setWarningTnm("Mesaj İletilemedi.");
            return $warningInfo;
        }
    }

    function getIletisimList($pMesaj, $pIletisimTip, $pMesajDurum, $pmin, $pmax)
    {
        $warningInfo = new Warning();
        $sonuc = array();
        try {
            $pdo = connectionVT();
            $sqlString = "SELECT TI.ID,
                              TI.ILETISIM_TIP_ID, 
                              (SELECT GDK.DEGER FROM TBL_GNL_DEGER_KUMESI GDK 
                                    WHERE GDK.ID = TI.ILETISIM_TIP_ID) AS ILETISIM_TIP_TNM,  
                              TI.AD_SOYAD, 
                              TI.E_POSTA, 
                              TI.TELEFON, 
                              TI.MESAJ,
                              SUBSTRING(TI.MESAJ, 1, 10) AS TEMP_MESAJ,
                              TI.EKLEME_TARIHI,
                              TI.MESAJ_DURUM,
                              (SELECT GDK.DEGER FROM TBL_GNL_DEGER_KUMESI GDK 
                                  WHERE GDK.ID = TI.MESAJ_DURUM) AS MESAJ_DURUM_TNM 
                             FROM TBL_ILETISIM TI 
                             WHERE 1=1 AND TI.MESAJ LIKE :mesaj";
            // iletisim tip degeri varsa sorguya eklenir.
            if ($pIletisimTip != null) {
                $sqlString = $sqlString . " AND TI.ILETISIM_TIP_ID = :iletisimtip ";
            }
            // mesaj durum degeri varsa sorguya eklenir.
            if ($pMesajDurum != null) {
                $sqlString = $sqlString . " AND TI.MESAJ_DURUM = :mesajdurum ";
            }
            $sqlString = $sqlString . " ORDER BY TI.EKLEME_TARIHI DESC ";
            $sqlString = $sqlString . " Limit :min,:max";
            
            $sql = $pdo->prepare($sqlString);
            $tempMesaj = '%' . $pMesaj . '%';
            
            // il degeri varsa deger bind edilir.
            if ($pIletisimTip != null) {
                $sql->bindParam(':iletisimtip', $pIletisimTip, PDO::PARAM_STR);
            }
            if ($pMesajDurum != null) {
                $sql->bindParam(':mesajdurum', $pMesajDurum, PDO::PARAM_STR);
            }
            
            $min = $pmin;
            $max = $pmax;
            $sql->bindParam(':min', $min, PDO::PARAM_INT);
            $sql->bindParam(':max', $max, PDO::PARAM_INT);
            $sql->bindParam(':mesaj', $tempMesaj, PDO::PARAM_STR);
            $sql->execute();
            $result = $sql->fetchAll();
            $warningInfo->setWarningId(0);
            $sonuc[] = $warningInfo;
            $sonuc[] = $result;
            
            return $sonuc;
        } catch (PDOException $e) {
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm($e->getMessage() . ' ' . $sqlString . ' mesaj:' . $tempMesaj . ' min:' . $min . ' max:' . $max);
            $sonuc[] = $warningInfo;
            return $sonuc;
        }
    }

    function guncelleOkundu($pIletisimId)
    {
        $warningInfo = new Warning();
        
        try {
            $aliciIpAdres = get_client_ip_env();
            $buGun = gecerli_tarih_saat();
            
            // create prepared statement
            $sql = "UPDATE TBL_ILETISIM SET
                        MESAJ_DURUM = :mesajDurum, 
                        guncelleme_ip=:guncellemeIp,
                        guncelleme_tarihi=:guncellemeTarihi 
                    WHERE id = :iletisimId";
            //print_r($pIletisimId);
            $pdo = connectionVT();
            $stmt = $pdo->prepare($sql);
            // $pFirmaAdi = $firmaMdl->getFirmaAdi();
            // bind parameters to statement
            $tempMesajDurum = 35;
            $stmt->bindParam(':mesajDurum', $tempMesajDurum);
            $stmt->bindParam(':guncellemeIp', $aliciIpAdres);
            $stmt->bindParam(':guncellemeTarihi', $buGun);
            $stmt->bindParam(':iletisimId', $pIletisimId);
            // execute the prepared statement
            $stmt->execute();
            $warningInfo->setWarningId(0);
            $warningInfo->setWarningTnm("Mesaj Okundu.");
            return $warningInfo;
        } catch (PDOException $e) {
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm($e->getMessage());
            return $warningInfo;
        }
    }
    function sil($pIletisimId)
    {
        $warningInfo = new Warning();
        
        try {
            // create prepared statement
            $sql = "DELETE from TBL_ILETISIM  
                    WHERE id = :iletisimId";
            //print_r($pIletisimId);
            $pdo = connectionVT();
            $stmt = $pdo->prepare($sql);
            // bind parameters to statement
            $stmt->bindParam(':iletisimId', $pIletisimId);
            // execute the prepared statement
            $stmt->execute();
            $warningInfo->setWarningId(0);
            $warningInfo->setWarningTnm("Mesaj Okundu Silindi.");
            return $warningInfo;
        } catch (PDOException $e) {
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm($e->getMessage());
            return $warningInfo;
        }
    }
}
?>