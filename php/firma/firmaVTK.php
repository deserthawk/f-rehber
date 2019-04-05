<?php
require_once ('../hata/hataVTK.php');
require_once ('../genelFonksiyonlar.php');
require_once ('../vTabani/veriTabani.php');
require_once ('firmaVTE.php');
require_once ('../firmaIletisim/firmaIletisimVTK.php');
require_once ('../gnlDegerKumesi/gnlDegerKumesiVTE.php');
require_once ('../warning.php');


class firmaVTK
{
    
    //eklenen sorgular start
    function getFirmaAdiById($pId){
        try{
            $tempFirmaVTE = new firmaVTE();
            
            $pdo = connectionVT();
            $sql = $pdo->prepare("SELECT " . $tempFirmaVTE->getFirmaAdi() . " FROM TBL_FIRMA where id=:id");
            $sql->bindParam(":id", $pId);
            $sql->execute();
            $result = $sql->fetch();
            return $result;
        }
        catch (PDOException $e) {
            return "";
        }
    }
    
    
    //eklenen sorgular end
    

    function ekle($pFirmaAdi)
    {
        try {
            $aliciIpAdres = get_client_ip_env();
            $buGun = gecerli_tarih_saat();
            
            $tempFirmaVTE = new firmaVTE();
            
            // create prepared statement
            $sql = "INSERT INTO `" . $tempFirmaVTE->getTabloAdi() . "`(`" . 
                $tempFirmaVTE->getFirmaAdi() . "`, `" . 
                $tempFirmaVTE->getEklemeIp() . "`, `" . 
                $tempFirmaVTE->getEklemeTarihi() . "`, `" . 
                $tempFirmaVTE->getDrmKodu() . "`)
            VALUES (:firmaAdi,:eklemeIp,:eklemeTarih,1)";
            // print_r($sql);
            $pdo = connectionVT();
            $stmt = $pdo->prepare($sql);
            // $pFirmaAdi = $firmaMdl->getFirmaAdi();
            // bind parameters to statement
            $stmt->bindParam(':firmaAdi', $pFirmaAdi);
            $stmt->bindParam(':eklemeIp', $aliciIpAdres);
            $stmt->bindParam(':eklemeTarih', $buGun);
            // execute the prepared statement
            $stmt->execute();
            return null;
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
            return ("ERROR: Could not able to execute" . $e->getMessage());
        }
    }
    
    function getList($pfirmaAdi,$ptelefon,$pmin,$pmax){
        $warningInfo = new Warning();
        $sonuc =array();
        try{
            $tempFirmaVTE = new firmaVTE();
            
            $pdo = connectionVT();
            $sqlString = "select * from (SELECT id , firma_adi, 
                            (select kk.deger from tbl_gnl_deger_kumesi kk 
                                where kk.id = tbl_firma.firma_drm) as firma_drm ,
                            firma_tel_getir(TBL_FIRMA.id) as telefon
                          FROM TBL_FIRMA where TBL_FIRMA.firma_adi like :firmaAdi) t"; 
//            $sqlString = $sqlString ." where t.telefon like :firmaTel ";
            $sqlString = $sqlString ." where CAST(t.telefon AS BINARY) like :firmaTel ";
//            $sqlString = $sqlString ." ORDER BY key COLLATE utf8_general_ci ";            
            $sqlString = $sqlString ." Limit :min,:max ";            
            
            $min = $pmin;
            $max = $pmax;
            
            $sql = $pdo->prepare($sqlString);
            
            $tempFirmaAdi = '%' . $pfirmaAdi . '%';
            $tempTelefon = '%' . $ptelefon . '%';
            
            
            $sql->bindParam(':min', $min ,PDO::PARAM_INT );
            $sql->bindParam(':max', $max ,PDO::PARAM_INT );
            $sql->bindParam(':firmaAdi', $tempFirmaAdi , PDO::PARAM_STR);
            $sql->bindParam(':firmaTel', $tempTelefon , PDO::PARAM_STR);
            
            $sql->execute();
            $result = $sql->fetchAll();
            $warningInfo->setWarningId(0);
            $sonuc[] = $warningInfo;
            $sonuc[] = $result;
            $pdo = null;
            return $sonuc;
            
        }
        catch (PDOException $e) {
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm($e->getMessage());
            $sonuc[] = $warningInfo;
            hata_yaz($e->getCode(),$e->getMessage(),__FILE__ . "->" .__FUNCTION__,replace_enter_space($sqlString));
            return $sonuc;
        }
    }
    
    function getFirmaDetay($pFirmaId){
        $warningInfo = new Warning();
        try{
            $tempFirmaVTE = new firmaVTE();
            $tempGnlDegerKumesiVTE = new gnlDegerKumesiVTE();
            $pdo = connectionVT();
            
            $sql = $pdo->prepare("select tf." . $tempFirmaVTE->getId() . ", tf." . $tempFirmaVTE->getFirmaAdi() . 
                ", tf." . $tempFirmaVTE->getFirmaLogo() . ", tf." . $tempFirmaVTE->getFirmaDrm() . 
                ", tgdk." . $tempGnlDegerKumesiVTE->getDeger() . ", tf." . $tempFirmaVTE->getFirmaNote() . " from " . $tempFirmaVTE->getTabloAdi(). 
                " tf, " . $tempGnlDegerKumesiVTE->getTabloAdi(). 
                " tgdk where tgdk." . $tempGnlDegerKumesiVTE->getId() . 
                " = tf." . $tempFirmaVTE->getFirmaDrm() . " and tf." . $tempFirmaVTE->getId() . " = :firmaId");
            $sql->bindParam(':firmaId', $pFirmaId);
            $sql->execute();
            $result = $sql->fetch();
            
            return $result;
        }
        catch (PDOException $e) {
            $pdo->rollBack();
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm("Bir hata ile karşılaşıldı.");
            return $warningInfo;
        }
    }
    
    function ekleFirmaIletisim($pFirmaAdi, $pTelefon,$pCepTelefonu,$pEmail,$pKontakKisi,$pKontakKisiTelefon,$pKontakKisiEmail,$pIl,$pIlce,$pAdres,$pWebAdresi)
    {
        $warningInfo = new Warning();
        try {
            $aliciIpAdres = get_client_ip_env();
            $buGun = gecerli_tarih_saat();
            
            $tempFirmaVTE = new firmaVTE();
            
            // create prepared statement
            $sql = "INSERT INTO `" . $tempFirmaVTE->getTabloAdi() . "`(`" . 
                $tempFirmaVTE->getFirmaAdi() . "`, `" . 
                $tempFirmaVTE->getEklemeIp() . "`, `" . 
                $tempFirmaVTE->getEklemeTarihi() . "`, `" . 
                $tempFirmaVTE->getDrmKodu() . "`)
            VALUES (:firmaAdi,:eklemeIp,:eklemeTarih,1)";
            $pdo = connectionVT();
            $pdo->beginTransaction();
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':firmaAdi', $pFirmaAdi);
            $stmt->bindParam(':eklemeIp', $aliciIpAdres);
            $stmt->bindParam(':eklemeTarih', $buGun);
            // execute the prepared statement
            $stmt->execute();
           
            $tempFirmaId = $pdo->lastInsertId();
            $tempFirmaIletisim = new firmaIletisimVTK();
            $pdo->commit();
            // adres
            if((isset($pIl) && isset($pIlce)) || isset($pAdres)){
                $warningInfo = $tempFirmaIletisim->ekle($tempFirmaId, 1, $pIl, $pIlce,$pAdres, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
                if ($warningInfo->getWarningId() != 0) {
                    $pdo->rollBack();
                    return $warningInfo;
                }
            }
             
            // telefon
            if(isset($pTelefon)){
                $warningInfo = $tempFirmaIletisim->ekle($tempFirmaId, 2, $pTelefon, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
                if ($warningInfo->getWarningId() != 0) {
                    $pdo->rollBack();
                    return $warningInfo;
                }
            }
            // cep telefonu
            if(isset($pCepTelefonu)){
                $warningInfo = $tempFirmaIletisim->ekle($tempFirmaId, 3, $pCepTelefonu, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
                if ($warningInfo->getWarningId() != 0) {
                    $pdo->rollBack();
                    return $warningInfo;
                }
            }
            // email
            if(isset($pEmail)){
                $warningInfo = $tempFirmaIletisim->ekle($tempFirmaId, 4, $pEmail, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
                if ($warningInfo->getWarningId() != 0) {
                    $pdo->rollBack();
                    return $warningInfo;
                }
            }
            // kontak kisi
            if(isset($pKontakKisi) && (isset($pKontakKisiTelefon) || isset($pKontakKisiEmail))){
                $warningInfo = $tempFirmaIletisim->ekle($tempFirmaId, 5, $pKontakKisi, $pKontakKisiTelefon, $pKontakKisiEmail, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
                if ($warningInfo->getWarningId() != 0) {
                    $pdo->rollBack();
                    return $warningInfo;
                }
            }
            // web adresi
            if(isset($pWebAdresi)){
                $warningInfo = $tempFirmaIletisim->ekle($tempFirmaId, 15, $pWebAdresi, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
                if ($warningInfo->getWarningId() != 0) {
                    $pdo->rollBack();
                    return $warningInfo;
                }
            }
            
            return NULL;
        } catch (PDOException $e) {
            $pdo->rollBack();
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm("Firma Eklenememiştir.");
            return $warningInfo;
        }
    }
    
    function firmaNotGuncelle($pId, $pFirmaDurum, $pFirmaNot)
    {
        $warningInfo = new Warning();
        try {
            $aliciIpAdres = get_client_ip_env();
            $buGun = gecerli_tarih_saat();
            
            $tempFirmaVTE = new firmaVTE();
            
            $sql = "UPDATE tbl_firma SET firma_drm=:firmaDurum,firma_note=:firmaNot,guncelleme_ip=:guncellemeIp,guncelleme_tarihi=:guncellemeTarihi WHERE id=:id";
            
            $pdo = connectionVT();
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':firmaDurum', $pFirmaDurum);
            $stmt->bindParam(':firmaNot', $pFirmaNot);
            $stmt->bindParam(':guncellemeIp', $aliciIpAdres);
            $stmt->bindParam(':guncellemeTarihi', $buGun);
            
            $stmt->bindParam(':id', $pId);
            
            $stmt->execute();
            
            $warningInfo->setWarningId(0);
            $warningInfo->setWarningTnm("Güncelleme işlemi başarıyla tamamlandı.");
            return $warningInfo;
        } catch (PDOException $e) {
            $pdo->rollBack();
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm("Firma Güncellenemedi.");
            return $warningInfo;
        }
    }
    
    function firmaLogoGuncelle($pId, $pFirmaLogo)
    {
        $warningInfo = new Warning();
        try {
            $aliciIpAdres = get_client_ip_env();
            $buGun = gecerli_tarih_saat();
            
            $tempFirmaVTE = new firmaVTE();
            
            $sql = "UPDATE tbl_firma SET firma_logo=:firmaLogo,guncelleme_ip=:guncellemeIp,guncelleme_tarihi=:guncellemeTarihi WHERE id=:id";
            
            $pdo = connectionVT();
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':firmaLogo', $pFirmaLogo);
            $stmt->bindParam(':guncellemeIp', $aliciIpAdres);
            $stmt->bindParam(':guncellemeTarihi', $buGun);
            
            $stmt->bindParam(':id', $pId);
            
            $stmt->execute();
            
            $warningInfo->setWarningId(0);
            $warningInfo->setWarningTnm("Güncelleme işlemi başarıyla tamamlandı.");
            return $warningInfo;
        } catch (PDOException $e) {
            $pdo->rollBack();
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm("Firma Güncellenemedi.");
            return $warningInfo;
        }
    }
    
    function getFirmaMainList($pfirmaAdi,$pil,$pmin,$pmax){
        $warningInfo = new Warning();
        $sonuc =array();
        try{
            $tempFirmaVTE = new firmaVTE();
            
            $pdo = connectionVT();
            $sqlString = "SELECT T.id,T.firma_adi,T.firma_logo FROM
                    (SELECT TBL_FIRMA.id,
                        firma_adi ,
                        IFNULL(TBL_FIRMA.firma_logo, 'camera-512.png') firma_logo,
                        tbl_firma_iletisim.deger1
                       FROM TBL_FIRMA
                            LEFT JOIN tbl_firma_iletisim ON tbl_firma_iletisim.iletisim_tip = 1 AND tbl_firma_iletisim.firma_id = TBL_FIRMA.id
                            where TBL_FIRMA.firma_drm = 8 ) T
                                where 1=1
                                and T.firma_adi like :firmaAdi";
            //il degeri varsa sorguya eklenir.
            if($pil!=null){
                 $sqlString=$sqlString." and T.deger1 = :il ";
            }
            $sqlString=$sqlString." Limit :min,:max";
            
            $sql = $pdo->prepare($sqlString);
            $tempFirmaAdi = '%' . $pfirmaAdi . '%';
            
            //il degeri varsa deger bind edilir.
            if($pil!=null){
                $sql->bindParam(':il', $pil , PDO::PARAM_STR);
            }
            
            $min = $pmin;
            $max = $pmax;
            $sql->bindParam(':min', $min ,PDO::PARAM_INT );
            $sql->bindParam(':max', $max ,PDO::PARAM_INT );
            $sql->bindParam(':firmaAdi', $tempFirmaAdi , PDO::PARAM_STR);
            $sql->execute();
            $result = $sql->fetchAll();
            $warningInfo->setWarningId(0);
            $sonuc[] = $warningInfo;
            $sonuc[] = $result;
            $sql = null;
            $pdo = null;
            return $sonuc;
            
        }
        catch (PDOException $e) {
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm($e->getMessage() . ' ' . $sqlString . ' il:'. $pil . ' min:' .$min . ' max:' . $max . ' firma adi:' . $tempFirmaAdi);
            $sonuc[] =$warningInfo;
            return $sonuc;
        }
    }
    
}

?>