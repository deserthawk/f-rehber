<?php 
require_once ('../vTabani/ortakExtendVT.php');
class firmaVTE extends ortakExtendVT{
    private $tabloAdi = "tbl_firma";
    
    private $id = "id";
    private $firmaAdi = "firma_adi";
    private $firmaLogo = "firma_logo";
    private $firmaDrm= "firma_drm";
    private $firmaNote = "FIRMA_NOTE";
    
    
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
    public function getFirmaAdi()
    {
        return $this->firmaAdi;
    }
    /**
     * @return string
     */
    public function getFirmaLogo()
    {
        return $this->firmaLogo;
    }
    /**
     * @return string
     */
    public function getFirmaDrm()
    {
        return $this->firmaDrm;
    }
    /**
     * @return string
     */
    public function getFirmaNote()
    {
        return $this->firmaNote;
    }

}

?>