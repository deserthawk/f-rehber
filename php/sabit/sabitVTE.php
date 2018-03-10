<?php 
require_once ('../vTabani/ortakExtendVT.php');
class sabitVTE {
    private $tabloAdi = "tbl_sabit";
    
    private $sabitKodu = "sabit_kodu";
    private $sabitDeger = "sabit_deger";
    
    /**
     * @return string
     */
    public function getTabloAdi()
    {
        return $this->tabloAdi;
    }

    /**
     * @return string
     */
    public function getSabitKodu()
    {
        return $this->sabitKodu;
    }

    /**
     * @return string
     */
    public function getSabitDeger()
    {
        return $this->sabitDeger;
    }
}
?>