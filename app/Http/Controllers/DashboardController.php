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
	
	public function putTeachingUnit(TeachingUnit $teachingUnit){
		$teachingUnit->update(Request::all());
        return redirect('/dashboard/teaching-units/'.$teachingUnit->id)->withSuccess('Teaching unit has been updated.');
	}
	
	public function deleteTeachingUnit(TeachingUnit $teachingUnit){
		$teachingUnit->delete();
        return redirect('/dashboard/teaching-units')->withSuccess('Teaching unit has been deleted.');
	}
	
	public function showAllStudyMaterials($teachingUnitId){
		return view('dashboard.studyMaterials.index')
        	->with('studyMaterials', StudyMaterial::where('teaching_unit_id', $teachingUnitId)->get())
        	->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	public function createStudyMaterial($teachingUnitId){
		return view('dashboard.studyMaterials.create')->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	public function showStudyMaterial($teachingUnitId, $id){
		return view('dashboard.studyMaterials.show')
                ->with('studyMaterial', StudyMaterial::find($id))
                ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	public function postStudyMaterial($teachingUnitId){
		$studyMaterial = StudyMaterial::create(Request::all());
        $teachingUnit = Request::get('teaching_unit_id', '1');
        return redirect('/dashboard/teaching-units/'.$teachingUnit.'/study-materials/'.$studyMaterial->id)->withSuccess('Study material has been created.');
	}
	
	public function editStudyMaterial($teachingUnitId, $id){
		$studyMaterial = StudyMaterial::find($id);
        return view('dashboard.studyMaterials.edit')
                ->with('studyMaterial', $studyMaterial)
                ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	public function putStudyMaterial($teachingUnitId, $id){
		$studyMaterial = StudyMaterial::find($id);
        $studyMaterial->update(Request::all());
        return redirect('/dashboard/teaching-units/'.$teachingUnitId.'/study-materials/'.$studyMaterial->id)->withSuccess('Study material has been updated.');
	}
	
	public function deleteStudyMaterial($teachingUnitId, $id){
		$studyMaterial = StudyMaterial::find($id);
        $studyMaterial->delete();
        return redirect('dashboard/teaching-units/'.$teachingUnitId.'/study-materials')->withSuccess('Study material has been deleted.');
	}
}
