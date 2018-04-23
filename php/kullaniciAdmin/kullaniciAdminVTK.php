<?php 
require_once ('../genelFonksiyonlar.php');
require_once ('../vTabani/veriTabani.php');
require_once ('../warning.php');
require_once ('kullaniciAdminVTE.php');

class kullaniciAdminVTK
{
    function getKullaniciVar($pKullaniciAdi, $pSifre){
        $warningInfo = new Warning();
        try{
         $tempKullaniciAdminVTE = new kullaniciAdminVTE();
         
         $pdo = connectionVT();
         $sql = $pdo->prepare("select count(id) as kullanici_var from tbl_kullanici_admin where kullanici_adi = :kullaniciAdi and sifre = :sifre");
         
         $sql->bindParam(':kullaniciAdi', $pKullaniciAdi);
         $sql->bindParam(':sifre', $pSifre);
         $sql->execute();
         
         $result = $sql->fetch();
         
         if($result["kullanici_var"] == 1){
             $warningInfo->setWarningId(0);
             return $warningInfo;
         }
      //   print_r("test");
         $warningInfo->setWarningId(1);
         $warningInfo->setWarningTnm("Kullanıcı adı veya şifre hatalı");
         return $warningInfo;
        }
        catch(PDOException $e) {
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm("Bir hata ile karşılaşıldı.");
            return $warningInfo;
        }
    }
    
    function getKullaniciId($pKullaniciAdi){
        $warningInfo = new Warning();
        
        try{
            $tempKullaniciAdminVTE = new kullaniciAdminVTE();
            
            $pdo = connectionVT();
            $sql = $pdo->prepare("select id from tbl_kullanici_admin where kullanici_adi = :kullaniciAdi");
            $sql->bindParam(':kullaniciAdi', $pKullaniciAdi);
            $sql->execute();
            
            $result = $sql->fetch();
            
            return $result;
        }
        catch(PDOException $e) {
            $warningInfo = new Warning();
            $warningInfo->setWarningId(1);
            $warningInfo->setWarningTnm("Bir hata ile karşılaşıldı.");
            return $warningInfo;
        }
    }
    
    
}

?>