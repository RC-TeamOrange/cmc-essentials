<?php

namespace CmcEssentials\Http\Controllers;

use Request;

use View;

use Illuminate\Http\Response;

use CmcEssentials\Http\Requests;
use CmcEssentials\TeachingUnit;
use CmcEssentials\Quiz;
use CmcEssentials\Question;

/**
* This class contains methods processing teaching unit pages, and other general request for the entire app. 
*/
class TeachingUnitController extends Controller
{
    /**
    * Displays all teaching units page, the teaching unit selection page. 
    * 
    * @return View The teachin unit selection view. 
    */
	public function showAll(){
		return view('teachingUnits')->with('teachingUnits', TeachingUnit::orderBy('level', 'asc')->get());
	}
    
    /**
    * Displays a single teaching unit view. 
    * 
    * @param string $slug The slug of the teaching unit. 
    * 
    * @return View Teaching unit view. 
    */
    public function show($slug){
        $teachingUnit = $this->getTeachingUnit($slug, 'slug');
        return view('teachingUnit')
        ->with('teachingUnit', $teachingUnit )
        ->with('numberOfQuestions', $this->getNumberOfQuestions($teachingUnit));
    }
	
    /**
    * Displays a session login view. 
    * 
    * @return View Session login view. 
    */
	public function postSessionLogin(){
		$response = new Response(view('teachingUnits')->with('teachingUnits', TeachingUnit::orderBy('level', 'asc')->get()));
        return $response->withCookie('CmcESession', json_encode(array('username'=> Request::get('username'))), 30);
	}
	
    /**
    * Displays a session login view. 
    * 
    * @return View Session login view, uses the blade view  sessionLogin.
    */
	public function sessionLogin(){
		$sessionData = json_decode(Request::cookie('CmcESession'), true);
		if(!empty($sessionData['username'])){
			return redirect('/teaching-units');
		}
		return view('sessionLogin')->with('url', route('teaching-units::postSessionLogin'));
	}
	
    /**
    * Displays a syllabus view. 
    * 
    * @return View Syllabus view, uses the blade view  syllabus.
    */
	public function syllabus(){
		return view('syllabus');
	}
    
    /**
    * Returns a teaching unit elloquent model. 
    * 
    * @param mixed $id The value of the identifying property of the teaching unit. int id, or string slug. 
    * @param string $property The identifying property of the teaching unit, values are 'id' default or 'slug'
    * @return TeachingUnit A TeachingUnit Elloquest model .
    */
    public function getTeachingUnit($id, $property = 'id'){
        switch ($property) {
            case 'id':
                $teachingUnit = TeachingUnit::findOrFail($id);
                break;
                
            case 'slug':
                $teachingUnit =  TeachingUnit::where('slug', $id)->firstOrFail();
                break;
                
            default:
                $teachingUnit = TeachingUnit::findOrFail($id);
                break;
        }
        return $teachingUnit;
    }
    
    public function getNumberOfQuestions($teachingUnit){
        $quizzes = Quiz::with('questions')->where('teaching_unit_id', $teachingUnit->id)->get();
        $numberOfQuestions = 0;
        foreach ($quizzes as $quiz) {
            $numberOfQuestions += $quiz->questions->count();
        }
        return $numberOfQuestions;
    }
}
