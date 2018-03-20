<?php
require_once ('../genelFonksiyonlar.php');
require_once ('../vTabani/veriTabani.php');
require_once ('galeriEtiketVTE.php');
require_once ('../warning.php');

class galeriEtiketVTK
{

    function ekle($pGaleriId,$pEtiketTnmId)
    {
        try {
            $warningInfo = new Warning();
            
            $aliciIpAdres = get_client_ip_env();
            $buGun = gecerli_tarih_saat();
            
            $tempGaleriEtiketVTE = new galeriEtiketVTE();
            
            // create prepared statement
            $sql="INSERT INTO ". $tempGaleriEtiketVTE->getTabloAdi() 
                ." (". $tempGaleriEtiketVTE->getGaleriId() .", "
                . $tempGaleriEtiketVTE->getEtiketTnmId() .", "
                . $tempGaleriEtiketVTE->getEklemeIp() .", "
                . $tempGaleriEtiketVTE->getEklemeTarihi() .") 
                   VALUES (:galeriId, :etiketTnmId, :eklemeIp, :eklemeTarihi)";
            

                $pdo = connectionVT();
                $stmt = $pdo->prepare($sql);
                // $pFirmaAdi = $firmaMdl->getFirmaAdi();
                // bind parameters to statement
                $stmt->bindParam(':galeriId', $pGaleriId);
                $stmt->bindParam(':etiketTnmId', $pEtiketTnmId);
                $stmt->bindParam(':eklemeIp', $aliciIpAdres);
                $stmt->bindParam(':eklemeTarihi', $buGun);
                // execute the prepared statement
                $stmt->execute();
                //$pdo->commit();
                
                $warningInfo->setWarningId(0);
                $warningInfo->setWarningTnm("Etiket eklendi.");
                
                return $warningInfo;
        } catch (PDOException $e) {
            //$pdo->rollBack();
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm($e->getMessage());
            return $warningInfo;
        }
    }
    
    function sil($pGaleriEtiketId){
        try{
            $warningInfo = new Warning();
            
            $sql="DELETE FROM tbl_galeri_etiket WHERE id=:id";
            
            $pdo = connectionVT();
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':id', $pGaleriEtiketId);
            $stmt->execute();
            
            $warningInfo->setWarningId(0);
            $warningInfo->setWarningTnm("Etiket silindi.");
            
            return $warningInfo;
        }
        catch (PDOException $e) {
            //$pdo->rollBack();
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm($e->getMessage());
            return $warningInfo;
        }
    }
    
}
?>