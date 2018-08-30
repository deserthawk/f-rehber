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
            $sql = "INSERT INTO test_fotograf.tbl_iletisim
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
            $warningInfo->setWarningTnm("Mesaj İletilemedi.");
            return $warningInfo;
        }
    }
}
?>