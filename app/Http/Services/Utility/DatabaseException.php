<?php
//Jacob Hushaw
//CST - 323, Professor Mark Reha
//This class was created in CST - 256 
namespace App\Services\Utility;

use Exception;

class DatabaseException extends Exception
{

    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
    
    
}

