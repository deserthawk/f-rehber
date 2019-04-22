<?php
require_once ('../genelFonksiyonlar.php');
require_once ('../vTabani/veriTabani.php');
require_once ('sabitVTE.php');
require_once ('../warning.php');

class sabitVTK
{
    /**
     * Array bir deger donuyor donus icin donendeger[0] olarak ulasilabilinir.
     * @param sabit tablosundaki sabit kodu $pSabitKodu
     * @return warninginfo->Bir hata ile karşılaşıldı. |Warning
     */
    function getSabit($pSabitKodu){
        
        $warningInfo = new Warning();
        
        try {
            $tempSabitVTE = new sabitVTE();
            
            $pdo = connectionVT();
            $sql = $pdo->prepare("select sabit_deger from tbl_sabit where sabit_kodu = :sabitKodu");
            $sql->bindParam(':sabitKodu', $pSabitKodu);
            $sql->execute();
            
            $result = $sql->fetch();
            
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