<?php 
require_once ('../vTabani/ortakExtendVT.php');
class firmaIletisimVTE extends ortakExtendVT{
    private $tabloAdi = "tbl_firma_iletisim";
    
    private $id = "id";
    private $firmaId = "firma_id";
    private $iletisimTip = "iletisim_tip";
    private $deger1 = "deger1";
    private $deger2 = "deger2";
    private $deger3 = "deger3";
    private $deger4 = "deger4";
    private $deger5 = "deger5";
    private $deger6 = "deger6";
    private $deger7 = "deger7";
    private $deger8 = "deger8";
    private $deger9 = "deger9";
    private $deger10 = "deger10";
    
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
    public function getIletisimTip()
    {
        return $this->iletisimTip;
    }
    /**
     * @return string
     */
    public function getDeger1()
    {
        return $this->deger1;
    }
    /**
     * @return string
     */
    public function getDeger2()
    {
        return $this->deger2;
    }
    /**
     * @return string
     */
    public function getDeger3()
    {
        return $this->deger3;
    }
    /**
     * @return string
     */
    public function getDeger4()
    {
        return $this->deger4;
    }
    /**
     * @return string
     */
    public function getDeger5()
    {
        return $this->deger5;
    }
    /**
     * @return string
     */
    public function getDeger6()
    {
        return $this->deger6;
    }
    /**
     * @return string
     */
    public function getDeger7()
    {
        return $this->deger7;
    }
    /**
     * @return string
     */
    public function getDeger8()
    {
        return $this->deger8;
    }
    /**
     * @return string
     */
    public function getDeger9()
    {
        return $this->deger9;
    }
    /**
     * @return string
     */
    public function getDeger10()
    {
        return $this->deger10;
    }
}
?>