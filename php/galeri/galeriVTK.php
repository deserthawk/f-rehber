<?php
require_once ('../genelFonksiyonlar.php');
require_once ('../vTabani/veriTabani.php');
require_once ('galeriVTE.php');
require_once ('../warning.php');

class galeriVTK
{
    
    function getFirmaGaleriList($pFirmaId){
        
        $warningInfo = new Warning();
        
        try {
            $tempGaleriVTE = new galeriVTE();
            
            $pdo = connectionVT();
            $sql = $pdo->prepare("select id, firma_id, dosya_adi, fotograf_durum, fotograf_not from tbl_galeri where firma_id = :firmaId");
            $sql->bindParam(':firmaId', $pFirmaId);
            $sql->execute();
            
            $result = $sql->fetchAll();
            
            return $result;
        } catch (PDOException $e) {
            $pdo->rollBack();
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm("Bir hata ile karşılaşıldı.");
            return $warningInfo;
        }
        
    }
}
?>