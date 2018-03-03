<?php
class ortakExtendVT {
    private $eklemeIp = "ekleme_ip";
    private $eklemeTarihi = "ekleme_tarihi";
    private $guncellemeIp = "guncelleme_ip";
    private $guncellemeTarihi = "guncelleme_tarihi";
    private $drmKodu = "drm_kodu";
    
    public function ortakExtendVT(){
        
    }
    
    /**
     * @return string
     */
    public function getEklemeIp()
    {
        return $this->eklemeIp;
    }

    /**
     * @return string
     */
    public function getEklemeTarihi()
    {
        return $this->eklemeTarihi;
    }

    /**
     * @return string
     */
    public function getGuncellemeIp()
    {
        return $this->guncellemeIp;
    }

    /**
     * @return string
     */
    public function getGuncellemeTarihi()
    {
        return $this->guncellemeTarihi;
    }

    /**
     * @return string
     */
    public function getDrmKodu()
    {
        return $this->drmKodu;
    }
}
?>