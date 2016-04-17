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

class QuizResultsController extends Controller
{
    public function getQuizResults($teachingUnitSlug, $quizSlug)
    {
        $teachingUnit = TeachingUnit::where('slug', $teachingUnitSlug)->first();
        $nextTeachingUnit = TeachingUnit::where('level', '>', $teachingUnit->level)->orderBy('level', 'asc')->first();
        $quiz = Quiz::where('slug', $quizSlug)->first();
        $questions = Question::where('quiz_id', $quiz->id)->orderBy('id', 'asc');
        foreach ($questions as $key => $question) {
            $answers = Answer::where('question_id', $question->id)->orderBy('rank', 'asc')->get();
            $question->answers = $answers;
        }
        $quizChoices = json_decode(Request::cookie('quizeChoices'), true);
        $view = view('quiz.quizResults')
        ->with('teachingUnit', $teachingUnit)
        ->with('nextTeachingUnit', $nextTeachingUnit)
        ->with('quiz', $quiz)
        ->with('questions', $questions)
        ->with('quizChoices', $quizChoices);
        $response = new Response($view);
        return $response->withCookie('quizeChoices', json_encode(array()), 60);
    }
}