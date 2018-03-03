<?php 
class firmaEkleModel{
    
    private $firmaAdi;
    private $telefon;
    private $cepTelefonu;
    private $email;
    private $kontakKisi;
    private $kontakKisiTelefon;
    private $kontakKisiEmail;
    private $il;
    private $ilce;
    private $adres;
    private $webAdresi;
    
    public $firmaAdiEkle = "firmaAdiEkle";
    public $telefonEkle = "telefonEkle";
    public $cepTelefonuEkle = "cepTelefonuEkle";
    public $emailEkle = "emailEkle";
    public $kontakKisiEkle = "kontakKisiEkle";
    public $kontakKisiTelefonEkle = "kontakKisiTelefonEkle";
    public $kontakKisiEmailEkle = "kontakKisiEmailEkle";
    public $ilEkle = "ilEkle";
    public $ilceEkle = "ilceEkle";
    public $adresEkle = "adresEkle";
    public $webAdresiEkle = "webAdresiEkle";
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
    public function getTelefon()
    {
        return $this->telefon;
    }

    /**
     * @return mixed
     */
    public function getCepTelefonu()
    {
        return $this->cepTelefonu;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getKontakKisi()
    {
        return $this->kontakKisi;
    }

    /**
     * @return mixed
     */
    public function getKontakKisiTelefon()
    {
        return $this->kontakKisiTelefon;
    }

    /**
     * @return mixed
     */
    public function getKontakKisiEmail()
    {
        return $this->kontakKisiEmail;
    }

    /**
     * @return mixed
     */
    public function getIl()
    {
        return $this->il;
    }

    /**
     * @return mixed
     */
    public function getIlce()
    {
        return $this->ilce;
    }

    /**
     * @return mixed
     */
    public function getAdres()
    {
        return $this->adres;
    }

    /**
     * @return mixed
     */
    public function getWebAdresi()
    {
        return $this->webAdresi;
    }

    /**
     * @param mixed $firmaAdi
     */
    public function setFirmaAdi($firmaAdi)
    {
        $this->firmaAdi = $firmaAdi;
    }

    /**
     * @param mixed $telefon
     */
    public function setTelefon($telefon)
    {
        $this->telefon = $telefon;
    }

    /**
     * @param mixed $cepTelefonu
     */
    public function setCepTelefonu($cepTelefonu)
    {
        $this->cepTelefonu = $cepTelefonu;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $kontakKisi
     */
    public function setKontakKisi($kontakKisi)
    {
        $this->kontakKisi = $kontakKisi;
    }

    /**
     * @param mixed $kontakKisiTelefon
     */
    public function setKontakKisiTelefon($kontakKisiTelefon)
    {
        $this->kontakKisiTelefon = $kontakKisiTelefon;
    }

    /**
     * @param mixed $kontakKisiEmail
     */
    public function setKontakKisiEmail($kontakKisiEmail)
    {
        $this->kontakKisiEmail = $kontakKisiEmail;
    }

    /**
     * @param mixed $il
     */
    public function setIl($il)
    {
        $this->il = $il;
    }

    /**
     * @param mixed $ilce
     */
    public function setIlce($ilce)
    {
        $this->ilce = $ilce;
    }

    /**
     * @param mixed $adres
     */
    public function setAdres($adres)
    {
        $this->adres = $adres;
    }

    /**
     * @param mixed $webAdresi
     */
    public function setWebAdresi($webAdresi)
    {
        $this->webAdresi = $webAdresi;
    }

    
    
}

?>