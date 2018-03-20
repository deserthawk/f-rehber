<?php
require_once ('../genelFonksiyonlar.php');
require_once ('../vTabani/veriTabani.php');
require_once ('galeriVTE.php');
require_once ('../warning.php');

class galeriVTK
{

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
}
?>