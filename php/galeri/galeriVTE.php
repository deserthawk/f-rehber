<?php 
require_once ('../vTabani/ortakExtendVT.php');
class galeriVTE extends ortakExtendVT{
    private $tabloAdi = "tbl_galeri";
    
    private $id="id";
    private $firmaId="firma_id";
    private $dosyaAdi="dosya_adi";
    private $fotografDurum="fotograf_durum";
    private $fotograf_not="fotograf_not";
    
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
    public function getFirmaId()
    {
        return $this->firmaId;
    }
    /**
     * @return string
     */
    public function getDosyaAdi()
    {
        return $this->dosyaAdi;
    }
    /**
     * @return string
     */
    public function getFotografDurum()
    {
        return $this->fotografDurum;
    }
    /**
     * @return string
     */
    public function getNot()
    {
        return $this->not;
    }
}
?>