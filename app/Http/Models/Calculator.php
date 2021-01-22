<?php
//Jacob Hushaw
//CST - 323, Professor Mark Reha
//This is my own work. 
namespace App\Http\Models;

class Calculator
{
    private $firstnum;
    private $secondnum;
    private $oporator;
    private $result;

    public function __construct($firstnum, $secondnum, $oporator, $result)
    {
        $this->firstnum = $firstnum;
        $this->secondnum = $secondnum;
        $this->oporator = $oporator;
        $this->result = $result;
    }
    
    /**
     * @return mixed
     */
    public function getFirstnum()
    {
        return $this->firstnum;
    }

    /**
     * @return mixed
     */
    public function getSecondnum()
    {
        return $this->secondnum;
    }

    /**
     * @return mixed
     */
    public function getOporator()
    {
        return $this->oporator;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }
    
    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }
    
    
    
}

