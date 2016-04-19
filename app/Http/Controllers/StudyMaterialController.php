<?php

namespace CmcEssentials\Http\Controllers;

use Request;
use View;
use Illuminate\Http\Response;
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
        $cookieData = json_decode(Request::cookie('CmcESession'), true);
        if(!empty($cookieData['timer'])){
            $timeer = $cookieData['timer'];
            $timeLeft = !empty($timeer[$teachingUnit->id]) ? $timeer[$teachingUnit->id] :  $teachingUnit->duration * 60;
        }else{
            $timeLeft = $teachingUnit->duration * 60;
            $cookieData['timer'] = array($teachingUnit->id => $timeLeft);
        }
        $studyMaterial = StudyMaterial::where('teaching_unit_id', $teachingUnit->id)->orderBy('level', 'asc')->paginate(1);
        $view = view('StudyContent')
        ->with('timeLeft', $timeLeft)
        ->with('studyMaterials', $studyMaterial)
        ->with('teachingUnit', $teachingUnit);
        $response = new Response($view);
        return $response->withCookie('CmcESession', json_encode($cookieData), 180);
    }
	public function ajaxHandeller($slug){
		if(Request::ajax()){
			$teachingUnit = TeachingUnit::where('slug', $slug)->first();
			$cookieData = json_decode(Request::cookie('CmcESession'), true);
                $cookieData["timer"][$teachingUnit->id] =  Request::get("timeLeft");
                $response = new Response();
                return $response->withCookie('CmcESession', json_encode($cookieData), 180);
		};
}
}
