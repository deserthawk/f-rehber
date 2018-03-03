<?php
require_once ('../genelFonksiyonlar.php');
require_once ('../vTabani/veriTabani.php');
require_once ('gnlDegerKumesiVTE.php');
require_once ('../warning.php');

class gnlDegerKumesiVTK
{

    function getList()
    {
        $warningInfo = new Warning();
        try {
            $tempGnlDegerKumesiVTE = new gnlDegerKumesiVTE();
            
            $pdo = connectionVT();
            $sql = $pdo->prepare("SELECT ID, DEGER_KODU, DEGER, DEGER_ACIKLAMA,UST_DEGER_ID,EKLEME_IP,EKLEME_TARIHI,GUNCELLEME_IP,GUNCELLEME_TARIHI,DRM_KODU FROM TBL_GNL_DEGER_KUMESI");
            $sql->execute();
            
            $result = $sql->fetchAll();
            
            return $result;
        } catch (PDOException $e) {
            $pdo->rollBack();
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm("Firma Eklenememiþtir.");
            return $warningInfo;
        }
    }

    function getComboList($pDegerKodu)
    {
        //print_r($pDegerKodu);
        $warningInfo = new Warning();
        try {
            $tempGnlDegerKumesiVTE = new gnlDegerKumesiVTE();
            
            $pdo = connectionVT();
            $sql = $pdo->prepare("SELECT " . $tempGnlDegerKumesiVTE->getId() 
                . " ," . $tempGnlDegerKumesiVTE->getDeger() . " FROM " 
                . $tempGnlDegerKumesiVTE->getTabloAdi() . " WHERE "
                . $tempGnlDegerKumesiVTE->getDegerKodu() ."=:degerKodu and "
                . $tempGnlDegerKumesiVTE->getGorunur() ." = 1 order by "
                . $tempGnlDegerKumesiVTE->getSiralama());
            $sql->bindParam(':degerKodu', $pDegerKodu);
            $sql->execute();
            
            $result = $sql->fetchAll();
            
            return $result;
        } catch (PDOException $e) {
            $pdo->rollBack();
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm("Firma Eklenememiþtir.");
            return $warningInfo;
        }
    }
    function getComboListUstDegerId($pDegerKodu,$pUstDegerId)
    {
        $warningInfo = new Warning();
        try {
            $tempGnlDegerKumesiVTE = new gnlDegerKumesiVTE();
            
            $pdo = connectionVT();
            $sql = $pdo->prepare("SELECT " . $tempGnlDegerKumesiVTE->getId() . " ," . $tempGnlDegerKumesiVTE->getDeger() . " FROM " . $tempGnlDegerKumesiVTE->getTabloAdi() . " WHERE ". $tempGnlDegerKumesiVTE->getDegerKodu() ."=:degerKodu AND ". $tempGnlDegerKumesiVTE->getUstDegerId() ."=:ustDegerId");
            $sql->bindParam(':degerKodu', $pDegerKodu);
            $sql->bindParam(':ustDegerId', $pUstDegerId);
            $sql->execute();
            
            $result = $sql->fetchAll();
            
            return $result;
        } catch (PDOException $e) {
            $pdo->rollBack();
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm("Firma Eklenememiþtir.");
            return $warningInfo;
        }
    }
}

?>