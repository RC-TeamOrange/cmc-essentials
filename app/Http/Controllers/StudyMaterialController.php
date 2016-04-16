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
        $teachingUnit = TeachingUnit::where('slug', $slug)->first();
        $studyMaterial = StudyMaterial::where('teaching_unit_id', $teachingUnit->id)->paginate(1);
        if (Request::ajax()) {
            return Response::json(View::make('studyMaterials', array('studyMaterials' => $studyMaterial))->render());
        }
        return View::make('studyMaterials', array('studyMaterials' => $studyMaterial));
    }
}
