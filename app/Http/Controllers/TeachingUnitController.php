<?php

namespace CmcEssentials\Http\Controllers;

use Request;

use View;

use CmcEssentials\Http\Requests;
use CmcEssentials\TeachingUnit;
use CmcEssentials\Quiz;
use CmcEssentials\Question;

class TeachingUnitController extends Controller
{
	public function showAll(){
		return view('teachingUnits')->with('teachingUnits', TeachingUnit::orderBy('level', 'asc')->get());
	}
    public function show($slug){
        $teachingUnit = $this->getTeachingUnit($slug, 'slug');
        return view('teachingUnit')
        ->with('teachingUnit', $teachingUnit )
        ->with('numberOfQuestions', $this->getNumberOfQuestions($teachingUnit));
    }
	
	public function postSessionLogin(){
		$response = new Response(view('teachingUnits')->with('teachingUnits', TeachingUnit::orderBy('level', 'asc')->get()));
        return $response->withCookie('CmcESession', json_encode(array('username'=> Request::get('username'))), 30);
	}
	
	public function sessionLogin(){
		$sessionData = json_decode(Request::cookie('CmcESession'), true);
		if(!empty($sessionData['username'])){
			return redirect('/teaching-units');
		}
		return view('sessionLogin')->with('url', route('teaching-units::postSessionLogin'));
	}
	
	public function syllabus(){
		return view('syllabus');
	}
    
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
    
    private function getNumberOfQuestions($teachingUnit){
        $quizzes = Quiz::with('questions')->where('teaching_unit_id', $teachingUnit->id)->get();
        $numberOfQuestions = 0;
        foreach ($quizzes as $quiz) {
            $numberOfQuestions += $quiz->questions->count();
        }
        return $numberOfQuestions;
    }
}
