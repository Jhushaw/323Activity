<?php
//Jacob Hushaw
//CST - 323, Professor Mark Reha
//This is my own work. 
namespace App\Http\Services\BusinessServices;

use App\Http\Models\Calculator;
use App\Http\Services\DataService\CalcDataService;
use PDO;


class CalcBusinessService
{

    public function __construct()
    {}
    
    /**
     * recieves a calc model and does an operation bassed on the oporator inputed
     */
    public function doCalculation(Calculator $calcModel){
        //parse to a double
        $numOne = (double) $calcModel->getFirstnum();
        $numTwo = (double) $calcModel->getSecondnum();
        
        //checks for addition
        if ($calcModel->getOporator() == "+"){
            $result = $numOne + $numTwo;
        }
        
        //checks for subtraction
        elseif ($calcModel->getOporator() == "-"){
            $result = $numOne - $numTwo;
        }
        
        //checks for multiplication
        elseif ($calcModel->getOporator() == "*"){
            $result = $numOne * $numTwo;
        }
        
        //checks for division
        elseif ($calcModel->getOporator() == "/"){
            $result = $numOne / $numTwo;
        }
        
        //if something goes wrong it will return this string.
        else{
            $result = "your inputs were in an incorrect format. Try again";
        }
        
        //return result after oporation
        return $result;
    }
    
    /**
     * Takes a calc model, creates a db connection and sends them both down to the DAO
     * @param Calculator $calcModel
     */
    public function createCalc(Calculator $calcModel){
        //azure:
        //$db = new PDO("mysql:host=localhost;port=3306;dbname=calculator;", "azure", "6#vWHD_$");
        //heroku:
        $db = new PDO("mysql:host=cis9cbtgerlk68wl.cbetxkdyhwsb.us-east-1.rds.amazonaws.com	;port=3306;dbname=mel7zwsgvgg3x2tu;", "zhvjmaf13yvhlt2a", "mjuyswzet0cs70wz");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $service = new CalcDataService($db);
        
        $service->create($calcModel);
    }
    
    /**
     * Returns a list of every row from the database
     * @return \App\Http\Models\Calculator|NULL
     */
    public function getAllResults(){
        //azure db connection string
            //$db = new PDO("mysql:host=localhost;port=3306;dbname=calculator;", "azure", "6#vWHD_$");
        //heroku db connection string
            $db = new PDO("mysql:host=cis9cbtgerlk68wl.cbetxkdyhwsb.us-east-1.rds.amazonaws.com	;port=3306;dbname=mel7zwsgvgg3x2tu;", "zhvjmaf13yvhlt2a", "mjuyswzet0cs70wz");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $pds= new CalcDataService($db);
            $result = $pds->findAll();
            return $result;
    }
    
}

