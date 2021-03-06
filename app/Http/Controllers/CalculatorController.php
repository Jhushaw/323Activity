<?php
//Jacob Hushaw
//CST - 323, Professor Mark Reha
//This is my own work. 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Http\Models\Calculator;
use App\Http\Services\BusinessServices\CalcBusinessService;
use App\Http\Services\Utility\MyLogger;

class CalculatorController extends Controller
{
    
    /**
     * validates form with rules from below
     * recieves input from form
     * creates new calcModel
     * calls business service
     * returns calcResult with the $result data
     */
    public function calculate(Request $request){
        MyLogger::info("Entering CalculatorController.calculate()");
        //try catch for validation
        try{
            
            $this->validateForm($request);
            
            //recieve input
        $firstnum = $request->input('firstnum');
        $secondnum = $request->input('secondnum');
        $oporator = $request->input('oporator');
        $result = null;
        
        //create calc model
        $calcModel = new Calculator($firstnum, $secondnum, $oporator,$result);
        
        //create calcbusinessService
        $cbs = new CalcBusinessService();
        
        //call doCalculation
        $result = $cbs->doCalculation($calcModel);
        
        //set models result
        $calcModel->setResult($result);
        
        //save model to db
        if ($calcModel->getResult() != "your inputs were in an incorrect format. Try again"){
            $cbs->createCalc($calcModel);
        }
        
        //return view with result
        MyLogger::info("Exiting CalculatorController.calculate()");
        return view("results")->with('result',$calcModel);
    }catch(ValidationException $e1){
        MyLogger::error("Exception: ", array(
            "message" => $e1->getMessage()
        ));
        throw $e1;
    }
    }
    
    /**
     * finds all rows from the database and returns to the view
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function findAllResults(){
        MyLogger::info("Entering CalculatorController.findAllResults()");
        //create calcbusinessService
        $cbs = new CalcBusinessService();
        //get all rows
        $results = $cbs->getAllResults();
        //checks if we recieved anything
        if ($results != null){
            MyLogger::info("Exiting CalculatorController.findAllResults() with success");
            return view('ViewAllResults')->with('results', $results);
        } else {
            MyLogger::info("Exiting CalculatorController.findAllResults() with an error,(no results in database)");
            return view('Error')->with('msg', 'There are no results in the database.');
        }
    }   
    
    /**
     * validates the inputs on the form with these rules
     */
    private function validateForm(Request $request) {
        MyLogger::info("Entering CalculatorController.validateForm()");
        $rules = ['firstnum' => 'Required | Numeric',
            'secondnum' => 'Required | Numeric', 'oporator' => 'Required | Max:1'];
        MyLogger::info("Exiting CalculatorController.validateForm()");
        $this->validate($request, $rules);
    }
}
