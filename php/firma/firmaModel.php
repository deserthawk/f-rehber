<?php 
class firmaModel {
    
    private $id;
    private $firmaAdi;
    private $firmaLogo;
    private $firmaDrm;
    private $firmaNot;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirmaAdi()
    {
        return $this->firmaAdi;
    }

    /**
     * @return mixed
     */
    public function getFirmaLogo()
    {
        return $this->firmaLogo;
    }

    /**
     * @return mixed
     */
    public function getFirmaDrm()
    {
        return $this->firmaDrm;
    }

    /**
     * @return mixed
     */
    public function getFirmaNot()
    {
        return $this->firmaNot;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $firmaAdi
     */
    public function setFirmaAdi($firmaAdi)
    {
        $this->firmaAdi = $firmaAdi;
    }

    /**
     * @param mixed $firmaLogo
     */
    public function setFirmaLogo($firmaLogo)
    {
        $this->firmaLogo = $firmaLogo;
    }

    /**
     * @param mixed $firmaDrm
     */
    public function setFirmaDrm($firmaDrm)
    {
        $this->firmaDrm = $firmaDrm;
    }

    /**
     * @param mixed $firmaNot
     */
    public function setFirmaNot($firmaNot)
    {
        $this->firmaNot = $firmaNot;
    }
}
?>