<?php 
require_once ('./php/genelFonksiyonlar.php');
require_once ('./php/vTabani/veriTabani.php');
require_once ('./php/warning.php');

class genelVTK{
    
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
            $warningInfo->setWarningTnm("Bir hata ile karþýlaþýldý.");
            return $warningInfo;
        }
    }
    
}

?>