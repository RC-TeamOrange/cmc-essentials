<?php

namespace CmcEssentials\Http\Controllers;

use Request;
use Illuminate\Http\Response;

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
	
	public function showAllQuizzes($teachingUnitId){
		return view('dashboard.quizzes.index')
        ->with('quizzes', Quiz::where('teaching_unit_id', $teachingUnitId)->get())
        ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	public function createQuiz($teachingUnitId){
		return view('dashboard.create')
                ->with('teachingUnit', TeachingUnit::find($teachingUnitId))
                ->with('title', 'Create new Quiz')
                ->with('partial', 'quiz')
                ->with('url', 'dashboard/teaching-units/'.$teachingUnitId.'/quizzes');
	}
	
	public function showQuiz($teachingUnitId, $id){
		return view('dashboard.quizzes.show')
                ->with('quiz', Quiz::find($id))
                ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	public function postQuiz($teachingUnitId){
		$quiz = Quiz::create(Request::all());
                $teachingUnit = Request::get('teaching_unit_id');
                return redirect('/dashboard/teaching-units/'.$teachingUnit.'/quizzes/'.$quiz->id)->withSuccess('Quiz has been created.');
	}
	
	public function editQuiz($teachingUnitId, $id){
		$quiz = Quiz::find($id);
                return view('dashboard.edit')
                ->with('objModel', $quiz)
                ->with('title', 'Edit Quiz')
                ->with('partial', 'quiz')
                ->with('url', 'dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$id)
                ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	public function putQuiz($teachingUnitId, $id){
		$quiz = Quiz::find($id);
                $quiz->update(Request::all());
                return redirect('/dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quiz->id)->withSuccess('Quiz has been updated.');
	}
	
	public function deleteQuiz($teachingUnitId, $id){
		$quiz = Quiz::find($id);
                $quiz->delete();
                return redirect('dashboard/teaching-units/'.$teachingUnitId.'/quizzes')->withSuccess('Quiz has been deleted.');
	}
	
	public function showAllQuestions($teachingUnitId, $quizId){
		return view('dashboard.questions.index')
                    ->with('questions', Question::where('quiz_id', $quizId)->get())
                    ->with('quiz', Quiz::find($quizId))
                    ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	public function createQuestion($teachingUnitId, $quizId){
		return view('dashboard.create')
                    ->with('quiz', Quiz::find($quizId))
                    ->with('teachingUnit', TeachingUnit::find($teachingUnitId))
                    ->with('title', 'Create question')
                    ->with('partial', 'question')
                    ->with('url', 'dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions');
	}
	
	public function showQuestion($teachingUnitId, $quizId, $questionId){
		 return view('dashboard.questions.show')
                    ->with('question', Question::find($questionId))
                    ->with('quiz', Quiz::find($quizId))
                    ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	public function postQuestion($teachingUnitId, $quizId){
		$question = Question::create(Request::all());
                    $quizId = Request::get('quiz_id');
                    return redirect('/dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$question->id)->withSuccess('Question has been created.');
	}
	
	public function editQuestion($teachingUnitId, $quizId, $questionId){
		$question = Question::find($questionId);
                    return view('dashboard.edit')
                    ->with('objModel', $question)
                    ->with('title', 'Edit Question')
                    ->with('partial', 'question')
                    ->with('url', 'dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$questionId)
                    ->with('quiz', Quiz::find($quizId))
                    ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	public function putQuestion($teachingUnitId, $quizId, $questionId){
		$question = Question::find($questionId);
                    $question->update(Request::all());
                    return redirect('/dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$question->id)->withSuccess('Question has been updated.');
	}
	
	public function deleteQuestion($teachingUnitId, $quizId, $questionId){
		$question = Question::find($questionId);
                    $question->delete();
                    return redirect('dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions')->withSuccess('Question has been deleted.');
	}
	
	public function showAllAnswers($teachingUnitId, $quizId, $questionId){
		return view('dashboard.answers.index')
                        ->with('answers', Answer::where('question_id', $questionId)->get())
                        ->with('question', Question::find($questionId))
                        ->with('quiz', Quiz::find($quizId))
                        ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	public function createAnswer($teachingUnitId, $quizId, $questionId){
		return view('dashboard.create')
                        ->with('question', Question::find($questionId))
                        ->with('quiz', Quiz::find($quizId))
                        ->with('teachingUnit', TeachingUnit::find($teachingUnitId))
                        ->with('title', 'Create answer choice')
                        ->with('partial', 'answer')
                        ->with('url', 'dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$questionId.'/answers');
	}
	
	public function showAnswer($teachingUnitId, $quizId, $questionId, $answerId){
		return view('dashboard.answers.show')
                        ->with('answer', Answer::find($answerId))
                        ->with('question', Question::find($questionId))
                        ->with('quiz', Quiz::find($quizId))
                        ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	public function postAnswer($teachingUnitId, $quizId, $questionId){
		$answer = Answer::create(Request::all());
                        $question = Request::get('question_id');
                        return redirect('/dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$questionId.'/answers/'.$answer->id)->withSuccess('Answer choice has been created.');
	}
	
	public function editAnswer($teachingUnitId, $quizId, $questionId, $answerId){
		$answer = Answer::find($answerId);
                        return view('dashboard.edit')
                        ->with('objModel', $answer)
                        ->with('title', 'Edit Answer Choice')
                        ->with('partial', 'answer')
                        ->with('url', 'dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$questionId.'/answers/'.$answerId)
                        ->with('question', Question::find($questionId))
                        ->with('quiz', Quiz::find($quizId))
                        ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	public function putAnswer($teachingUnitId, $quizId, $questionId, $answerId){
		$answer = Answer::find($answerId);
                        $answer->update(Request::all());
                        return redirect('/dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$questionId.'/answers/'.$answer->id)->withSuccess('Answer choice has been updated.');
	}
	
	public function deleteAnswer($teachingUnitId, $quizId, $questionId, $answerId){
		$answer = Answer::find($answerId);
                        $answer->delete();
                        return redirect('dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$questionId.'/answers')->withSuccess('Answer choice has been deleted.');
	}
}
