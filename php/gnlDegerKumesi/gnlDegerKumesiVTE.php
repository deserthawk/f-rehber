<?php 
require_once ('../vTabani/ortakExtendVT.php');
class gnlDegerKumesiVTE extends ortakExtendVT{
    private $tabloAdi = "TBL_GNL_DEGER_KUMESI";
    
    private $id = "ID";
    private $degerKodu = "DEGER_KODU";
    private $deger="DEGER";
    private $degerAciklama = "DEGER_ACIKLAMA";
    private $ustDegerId = "UST_DEGER_ID";
    private $siralama = "SIRALAMA";
    private $gorunur = "GORUNUR";
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
    public function getDegerKodu()
    {
        return $this->degerKodu;
    }

    /**
     * @return string
     */
    public function getDegerAciklama()
    {
        return $this->degerAciklama;
    }

    /**
     * @return string
     */
    public function getUstDegerId()
    {
        return $this->ustDegerId;
    }
    /**
     * @return string
     */
    public function getDeger()
    {
        return $this->deger;
    }
    /**
     * @return string
     */
    public function getSiralama()
    {
        return $this->siralama;
    }

    /**
     * @return string
     */
    public function getGorunur()
    {
        return $this->gorunur;
    }


}
?>