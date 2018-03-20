<?php 
require_once ('../vTabani/ortakExtendVT.php');
class galeriEtiketVTE extends ortakExtendVT{
    private $tabloAdi = "tbl_galeri_etiket";
    
    private $id="id";
    private $galeriId="galeri_id";
    private $etiketTnmId="etiket_tnm_id";
    
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
    public function getGaleriId()
    {
        return $this->galeriId;
    }

    /**
     * @return string
     */
    public function getEtiketTnmId()
    {
        return $this->etiketTnmId;
    }

    
}
?>