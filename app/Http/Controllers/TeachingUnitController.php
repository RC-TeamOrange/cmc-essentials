<?php

namespace CmcEssentials\Http\Controllers;

use Illuminate\Http\Request;
use View;

use CmcEssentials\Http\Requests;
use CmcEssentials\TeachingUnit;
use CmcEssentials\Quiz;
use CmcEssentials\Question;

class TeachingUnitController extends Controller
{
    public function show($slug){
        $teachingUnit = $this->getTeachingUnit($slug, 'slug');
        return view('teachingUnit')
        ->with('teachingUnit', $teachingUnit )
        ->with('numberOfQuestions', $this->getNumberOfQuestions($teachingUnit));
    }
    
    private function getTeachingUnit($id, $property = 'id'){
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
