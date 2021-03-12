<?php
//Jacob Hushaw
//CST - 323, Professor Mark Reha
//This is my own work. 
namespace App\Http\Services\DataService;
use App\Http\Models\Calculator;
use App\Http\Services\Utility\MyLogger;
use PDO;
use PDOException;
use App\Http\Services\Utility\DatabaseException;


class CalcDataService
{
    private $db;
    
    //Never create a database connection in the data service
    //created the connection in the business service
    public function __construct($db)
    {
        $this->db = $db;
    }
    /**
     * insters a calculator model into the database
     * @param Calculator $calcModel
     * @throws DatabaseException
     * @return boolean
     */
    public function create($calcModel){
        MyLogger::info("entering CalcDataService.create()");
        try {
            //retrieve all parameters from the Calculator model.
            $numOne = (double) $calcModel->getFirstnum();
            $numTwo = (double) $calcModel->getSecondnum();
            $op = $calcModel->getOporator();
            $rs = $calcModel->getResult();
        
            //create statment
            $stmt = $this->db->prepare("INSERT INTO `calcresults` (`ID`, `FIRSTNUM`, `SECONDNUM`, `OPORATOR`, `RESULT`) 
            VALUES (NULL, '$numOne', '$numTwo', '$op', '$rs');");
            $stmt->execute();
            //check if the insertion was successful.
            $result = $stmt->rowCount();
            if($result==1){
                MyLogger::info("exiting CalcDataService.create() with: true");
                return true;
            }else{
                MyLogger::info("exiting CalcDataService.create() with: false");
                return false;
            }
        } catch (PDOException $e2) {
            MyLogger::error("Exception: ", array(
                "message" => $e2->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e2->getMessage(), 0, $e2);
        }
    }
    
    /**
     * finds all rows from the database and returns them to the business service
     * @throws DatabaseException
     * @return Calculator|NULL
     */
    public function findAll(){
        MyLogger::info("entering CalcDataService.findAll()");
        try {
            //create select all statement
            $stmt = $this->db->query("SELECT * FROM `calcresults`");
            $stmt->execute();
            //check if we got results
            $result = $stmt->rowCount();
            if ($result != 0) {
                $Results = $stmt->fetchAll();
                MyLogger::info("exiting CalcDataService.findAll() with:", $Results);
                return $Results;
            } else {
                MyLogger::info("exiting CalcDataService.findAll() with: null");
                return null;
            }
        } catch (PDOException $e2) {

            MyLogger::error("Exception: ", array(
                "message" => $e2->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e2->getMessage(), 0, $e2);
        }
    }
    
}

