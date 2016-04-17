<?php

namespace CmcEssentials\Http\Controllers;

use Request;
use View;

use CmcEssentials\Http\Requests;

use CmcEssentials\StudyMaterial;
use CmcEssentials\TeachingUnit;

class StudyMaterialController extends Controller
{
    /**
     * Study materials
     *
     * @return void
     */
    public function showStudyMaterials($slug)
    {
        if(Request::ajax()){
            $teachingUnit = TeachingUnit::where('slug', $slug)->first();
            $studyMaterial = StudyMaterial::where('teaching_unit_id', $teachingUnit->id)->orderBy('level', 'asc')->paginate(1);
            return view('studyMaterials')->with('studyMaterials', $studyMaterial)->with('teachingUnit', $teachingUnit);
        }
        $teachingUnit = TeachingUnit::where('slug', $slug)->first();
        $studyMaterial = StudyMaterial::where('teaching_unit_id', $teachingUnit->id)->orderBy('level', 'asc')->paginate(1);
        return view('StudyContent')
        ->with('studyMaterials', $studyMaterial)
        ->with('teachingUnit', $teachingUnit);
    }
}
