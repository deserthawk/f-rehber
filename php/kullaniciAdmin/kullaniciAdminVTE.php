<?php 
require_once ('../vTabani/ortakExtendVT.php');
class kullaniciAdminVTE extends ortakExtendVT{
    
    private $tabloAdi = "tbl_kullanici_admin";
    
    private $id = "id";
    private $kullaniciAdi = "kullanici_adi";
    private $sifre = "sifre";
    
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
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return string
     */
    public function getKullaniciAdi()
    {
        return $this->kullaniciAdi;
    }
    /**
     * @return string
     */
    public function getSifre()
    {
        return $this->sifre;
    }
}
?>