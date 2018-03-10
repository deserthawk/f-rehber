<?php
require_once ('../genelFonksiyonlar.php');
require_once ('../vTabani/veriTabani.php');
require_once ('sabitVTE.php');
require_once ('../warning.php');

class sabitVTK
{
    
    function getFirmaIletisimList($pSabitKodu){
        
        $warningInfo = new Warning();
        
        try {
            $tempSabitVTE = new sabitVTE();
            
            $pdo = connectionVT();
            $sql = $pdo->prepare("select sabit_deger from tbl_sabit where sabit_kodu = :sabitKodu");
            $sql->bindParam(':sabitKodu', $pSabitKodu);
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