<?php
//Jacob Hushaw
//CST - 323, Professor Mark Reha
//This is my own work. 
namespace App\Http\Services\BusinessServices;

use App\Http\Models\Calculator;
use App\Http\Services\DataService\CalcDataService;
use App\Http\Services\Utility\MyLogger;
use PDO;


class CalcBusinessService
{

    public function __construct()
    {}
    
    /**
     * recieves a calc model and does an operation bassed on the oporator inputed
     */
    public function doCalculation(Calculator $calcModel){
        MyLogger::info("Entering CalcBusinessService.doCalculation()");
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
            MyLogger::info("In CalcBusinessService.doCalculation() inputs were in an incorrect format");
            $result = "your inputs were in an incorrect format. Try again";
        }
        
        //return result after oporation
        MyLogger::info("Exiting CalcBusinessService.doCalculation()");
        return $result;
    }
    
    /**
     * Takes a calc model, creates a db connection and sends them both down to the DAO
     * @param Calculator $calcModel
     */
    public function createCalc(Calculator $calcModel){
        MyLogger::info("Entering CalcBusinessService.createCalc()");
        //azure:
        //$db = new PDO("mysql:host=localhost;port=3306;dbname=calculator;", "root", "root");
        //heroku:
        $db = new PDO("mysql:host=cis9cbtgerlk68wl.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;port=3306;dbname=mel7zwsgvgg3x2tu;", "zhvjmaf13yvhlt2a", "mjuyswzet0cs70wz");
        //Amazon AWS db connection string
        //$db = new PDO("mysql:host=calculatordbinstance.cz53qmput2sy.us-east-2.rds.amazonaws.com;port=3306;dbname=calculator;", "root", "rootuser");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $service = new CalcDataService($db);
        
        
        $service->create($calcModel);
        MyLogger::info("Exiting CalcBusinessService.createCalc()");
    }
    
    /**
     * Returns a list of every row from the database
     * @return \App\Http\Models\Calculator|NULL
     */
    public function getAllResults(){
        MyLogger::info("Entering CalcBusinessService.getAllResults()");
        //azure db connection string
            //$db = new PDO("mysql:host=localhost;port=3306;dbname=calculator;", "root", "root");
        //heroku db connection string
            $db = new PDO("mysql:host=cis9cbtgerlk68wl.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;port=3306;dbname=mel7zwsgvgg3x2tu;", "zhvjmaf13yvhlt2a", "mjuyswzet0cs70wz");
        //Amazon AWS db connection string
            //$db = new PDO("mysql:host=calculatordbinstance.cz53qmput2sy.us-east-2.rds.amazonaws.com;port=3306;dbname=calculator;", "root", "rootuser");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $pds= new CalcDataService($db);
            $result = $pds->findAll();
            MyLogger::info("Exiting CalcBusinessService.getAllResults()");
            return $result;
    }
    
}

