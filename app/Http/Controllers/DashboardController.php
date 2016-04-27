<?php

namespace CmcEssentials\Http\Controllers;

use Request;

use CmcEssentials\Http\Requests;
use CmcEssentials\TeachingUnit;
use CmcEssentials\StudyMaterial;
use CmcEssentials\Quiz;
use CmcEssentials\Question;
use CmcEssentials\Answer;

class DashboardController extends Controller
{
    public function showAllTeachingUnits(){
		return view('dashboard.index')->with('teachingUnits', TeachingUnit::all());
	}
	
	public function createTeachingUnit(){
		return view('dashboard.teachingUnits.create');
	}
	
	public function showTeachingUnit($id){
		return view('dashboard.teachingUnits.show')->with('teachingUnit', TeachingUnit::findOrFail($id));
	}
	
	public function postTeachingUnit(){
		$teachingUnit = TeachingUnit::create(Request::all());
        return redirect('/dashboard/teaching-units/'.$teachingUnit->id)->withSuccess('Teaching unit has been created.');
	}
	
	public function editTeachingUnit(TeachingUnit $teachingUnit){
		return view('dashboard.teachingUnits.edit')->with('teachingUnit', $teachingUnit);
	}
}
