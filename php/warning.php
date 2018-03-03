<?php 
class Warning{
    public $warningId;
    public $warningTnm;
    
    /**
     * @return mixed
     */
    public function getWarningId()
    {
        return $this->warningId;
    }

    /**
     * @return mixed
     */
    public function getWarningTnm()
    {
        return $this->warningTnm;
    }

    /**
     * @param mixed $warningId
     */
    public function setWarningId($warningId)
    {
        $this->warningId = $warningId;
    }

    /**
     * @param mixed $warningTnm
     */
    public function setWarningTnm($warningTnm)
    {
        $this->warningTnm = $warningTnm;
    }
}

?>