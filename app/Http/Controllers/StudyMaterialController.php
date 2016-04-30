<?php

namespace CmcEssentials\Http\Controllers;

use Request;
use View;
use Illuminate\Http\Response;
use CmcEssentials\Http\Requests;

use CmcEssentials\StudyMaterial;
use CmcEssentials\TeachingUnit;

/**
* This class contains methods for processing and displaying teaching materials for a teaching unit.
*/
class StudyMaterialController extends Controller
{
    /**
    * Process study material retreival requests. Returns a single study material from the paginated result. 
    * JavaScript running on the front end asynchronously invokes this method via its route definition to get study material displayed on each screen of the teaching unit study page.
    * This method initializes the timer of the teaching unit (CmcESession['timer']) when the teaching unit study page if first requested with the first study material.
    *
    * @param string $slug The slug of the teaching unit to which the study material belongs.
    *
    * @return Illuminate\Contracts\View\View The view of the teaching unit study page or a single teaching material view if it is an ajax request.
    */
    public function showStudyMaterials($slug)
    {
        // Check if this is an ajax request and return only the view of a study material.
        if(Request::ajax()){
            $teachingUnit = TeachingUnit::where('slug', $slug)->first();
            $studyMaterial = StudyMaterial::where('teaching_unit_id', $teachingUnit->id)->orderBy('level', 'asc')->paginate(1);
            return view('studyMaterials')->with('studyMaterials', $studyMaterial)->with('teachingUnit', $teachingUnit);
        }
        
        //Process and return the teaching unit study page if it is the first time the page is invoked.
        $teachingUnit = TeachingUnit::where('slug', $slug)->first();
        
        //Read and update the timer cookie if it exists or initialiaze if it does not exist. 
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
