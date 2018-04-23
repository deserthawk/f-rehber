<?php 
require_once ('../vTabani/ortakExtendVT.php');
class kullaniciAdminSessionVTE extends ortakExtendVT{
    
    private $tabloAdi = "tbl_kullanici_admin_session";
    
    private $id = "id";
    private $kullaniciAdminId = "kullanici_admin_id";
    private $sesionId = "sesion_id";
    
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
    public function getKullaniciAdminId()
    {
        return $this->kullaniciAdminId;
    }

    /**
     * @return string
     */
    public function getSesionId()
    {
        return $this->sesionId;
    }
}
?>