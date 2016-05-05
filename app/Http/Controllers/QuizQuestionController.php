<?php

namespace CmcEssentials\Http\Controllers;

use Request;
use View;
use Illuminate\Http\Response;

use CmcEssentials\Http\Requests;

use CmcEssentials\TeachingUnit;
use CmcEssentials\Quiz;
use CmcEssentials\Question;
use CmcEssentials\Answer;

/**
* The QuizQuestionController class contains methods for processing Quiz questions, and responding to actions performed by the user of the quiz page. 
*/
class QuizQuestionController extends Controller
{
    /**
    * Process quiz question retreival requests. Returns a single question from the paginated result. 
    * JavaScript running on the front end asynchronously invokes this method via its route definition to get questions displayed on the browser one at time.
    * This method initializes both the timer of the teaching unit (CmcESession['timer']) and the selected answer choices cookie (quizeChoices), the first time the quiz questions page is requested with the first question.
    *
    * @param string $teachingUnitSlug The slug of the teaching unit to which the corresponding quiz and question belong.
    * @param string $quizSlug The slug of the quiz to which this question belongs. 
    *
    * @return Illuminate\Contracts\View\View The view of the quiz or only the question view if it is an ajax request.
    */
    public function getQuizQuestion($teachingUnitSlug, $quizSlug)
    {
        //Check if this is an ajax request and return only the question view.
        if(Request::ajax()){
            $teachingUnit = TeachingUnit::where('slug', $teachingUnitSlug)->first();
            $quiz = Quiz::where('slug', $quizSlug)->first();
            $questions = Question::where('quiz_id', $quiz->id)->orderBy('id', 'asc')->paginate(1);
            $question= $questions[0];
            $answerChoices = Answer::where('question_id', $question->id)->orderBy('rank', 'asc')->get();
            $quizChoices = json_decode(Request::cookie('quizeChoices'), true);
            
            // Create and return the question view with the timer and quizeChoices cookies.
            return view('quiz.quizQuestion')
            ->with('teachingUnit', $teachingUnit)
            ->with('quiz', $quiz)
            ->with('questions', $questions)
            ->with('quizChoices', $quizChoices)
            ->with('answerChoices', $answerChoices);
        }
        
        //Procesing quiz page for first request to the quiz questions page.
        $teachingUnit = TeachingUnit::where('slug', $teachingUnitSlug)->first();
        $quiz = Quiz::where('slug', $quizSlug)->first();
        $questions = Question::where('quiz_id', $quiz->id)->orderBy('id', 'asc')->paginate(1);
        $question= $questions[0];
        $answerChoices = Answer::where('question_id', $question->id)->orderBy('rank', 'asc')->get();
        
        // Read the timer from the cookie if it is available and update it, or initialize it if its not availabel.
        $cookieData = json_decode(Request::cookie('CmcESession'), true);
        if(!empty($cookieData['timer'])){
            $timeer = $cookieData['timer'];
            $timeLeft = !empty($timeer[$teachingUnit->id]) ? $timeer[$teachingUnit->id] :  $teachingUnit->duration * 60;
        }else{
            $timeLeft = $teachingUnit->duration * 60;
            $cookieData['timer'] = array($teachingUnit->id => $timeLeft);
        }
        
        // Create and return the quiz view with the timer and quizeChoices cookies.
        $view = view('quiz.quiz')
        ->with('teachingUnit', $teachingUnit)
        ->with('quiz', $quiz)
        ->with('timeLeft', $timeLeft)
        ->with('questions', $questions)
        ->with('answerChoices', $answerChoices);
        $response = new Response($view);
        return $response->withCookie('quizeChoices', json_encode(array()), 60)->withCookie('CmcESession', json_encode($cookieData), 180);
    }
    
    /**
    * This method saves the selected answer choices.
    * JavaScript running on the browser invokes this method through its corresponding route, each time the user selects an answer choice; 
    * It saves the selected answer choice in the cookie and returns the updated cookie to the browser. 
    *
    * @param string $teachingUnitSlug The slug of the teaching unit to which the corresponding quiz and question belong.
    * @param string $quizSlug The slug of the quiz to which this question belongs.
    * 
    * @returns  Response Response object with the updates quizeChoices cookie, containing the saved selected answer choice.
    */
    public function saveChoice($teachingUnitSlug, $quizSlug){
        if(Request::ajax()){
            $teachingUnit = TeachingUnit::where('slug', $teachingUnitSlug)->first();
            if(Request::get("action") == "updateTimer"){
                $cookieData = json_decode(Request::cookie('CmcESession'), true);
            $cookieData["timer"][$teachingUnit->id] =  Request::get("timeLeft");
            $response = new Response();
            return $response->withCookie('CmcESession', json_encode($cookieData), 180);
            }
            $quiz = Quiz::where('slug', $quizSlug)->first();
            $questions = Question::where('quiz_id', $quiz->id)->orderBy('id', 'asc')->paginate(1);
            $question= $questions[0];
            $answerChoices = Answer::where('question_id', $question->id)->orderBy('rank', 'asc')->get();
            $quizChoices = json_decode(Request::cookie('quizeChoices'), true);
            $quizChoices[Request::get('question')] = Request::get('choice');
            return Response(json_encode(Request::cookie('quizeChoices')))->withCookie('quizeChoices', json_encode($quizChoices), 60);
        }
    }
    
    /**
    * Returns a quiz elloquent model. 
    * 
    * @param mixed $id The value of the identifying property of the quiz. int id, or string slug. 
    * @param string $property The identifying property of the quiz, values are 'id' default or 'slug'
    * @return Quiz A Quiz Elloquest model .
    */
    public function getQuiz($id, $property = 'id'){
        switch ($property) {
            case 'id':
                $quiz = Quiz::findOrFail($id);
                break;
                
            case 'slug':
                $quiz =  Quiz::where('slug', $id)->firstOrFail();
                break;
                
            default:
                $quiz = Quiz::findOrFail($id);
                break;
        }
        return $quiz;
    }
    
    /**
    * Returns a Question elloquent model. 
    * 
    * @param mixed $id String or integer, the question id.
    * 
    * @return Question A Question Elloquest model .
    */
    public function getQuestion($id){
        $question = Question::findOrFail($id);
        return $question;
    }
    
    /**
    * Returns a Answer elloquent model. 
    * 
    * @param mixed $id String or integer, the answer id.
    * 
    * @return Answer A Answer Elloquest model .
    */
    public function getAnswer($id){
        $answer = Answer::findOrFail($id);
        return $answer;
    }
}
