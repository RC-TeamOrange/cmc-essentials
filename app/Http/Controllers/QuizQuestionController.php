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


class QuizQuestionController extends Controller
{
    public function getQuizQuestion($teachingUnitSlug, $quizSlug)
    {
        if(Request::ajax()){
            $teachingUnit = TeachingUnit::where('slug', $teachingUnitSlug)->first();
            $quiz = Quiz::where('slug', $quizSlug)->first();
            $questions = Question::where('quiz_id', $quiz->id)->orderBy('id', 'asc')->paginate(1);
            $question= $questions[0];
            $answerChoices = Answer::where('question_id', $question->id)->orderBy('rank', 'asc')->get();
            return view('quiz.quizQuestion')
            ->with('teachingUnit', $teachingUnit)
            ->with('quiz', $quiz)
            ->with('questions', $questions)
            ->with('answerChoices', $answerChoices);
        }
        $teachingUnit = TeachingUnit::where('slug', $teachingUnitSlug)->first();
        $quiz = Quiz::where('slug', $quizSlug)->first();
        $questions = Question::where('quiz_id', $quiz->id)->orderBy('id', 'asc')->paginate(1);
        $question= $questions[0];
        $answerChoices = Answer::where('question_id', $question->id)->orderBy('rank', 'asc')->get();
        $view = view('quiz.quiz')
        ->with('teachingUnit', $teachingUnit)
        ->with('quiz', $quiz)
        ->with('questions', $questions)
        ->with('answerChoices', $answerChoices);
        $response = new Response($view);
        return $response->withCookie('quizeChoices', json_encode(array()), 60);
    }
    
    public function saveChoice($teachingUnitSlug, $quizSlug)
    {
        if(Request::ajax()){
            $teachingUnit = TeachingUnit::where('slug', $teachingUnitSlug)->first();
            $quiz = Quiz::where('slug', $quizSlug)->first();
            $questions = Question::where('quiz_id', $quiz->id)->orderBy('id', 'asc')->paginate(1);
            $question= $questions[0];
            $answerChoices = Answer::where('question_id', $question->id)->orderBy('rank', 'asc')->get();
            $quizChoices = json_decode(Request::cookie('quizeChoices'), true);
            $quizChoices[Request::get('question')] = Request::get('choice');
            return Response(json_encode(Request::cookie('quizeChoices')))->withCookie('quizeChoices', json_encode($quizChoices), 60);
        }
    }
}
