<?php

namespace CmcEssentials\Http\Controllers;

use Request;
use Illuminate\Http\Response;

/**
 * 
 */
use CmcEssentials\Http\Requests;
use CmcEssentials\TeachingUnit;
use CmcEssentials\StudyMaterial;
use CmcEssentials\Quiz;
use CmcEssentials\Question;
use CmcEssentials\Answer;

/**
* Main Admin Dashboard Contoller Class. Wraps methods for handling and requests performed from within the admin dashboard. 
* Main CRUD operations for teaching units, study materials, quizzes, questions and answers.
*/
class DashboardController extends Controller
{
	/**
	* Displays all available/created teaching units.
	*
	* @return object Illuminate\Contracts\View\View
	*/
    public function showAllTeachingUnits(){
		return view('dashboard.index')->with('teachingUnits', TeachingUnit::all());
	}
	
	/**
	* Displays a form for creating new teachin units.
	*
	* @return object Illuminate\Contracts\View\View
	*/
	public function createTeachingUnit(){
		return view('dashboard.teachingUnits.create');
	}
	
	/**
	* Displays a single teaching unit on the dashboard, with options to edit and delete.
	*
	* @param int $id Teaching unit id.
	*
	* @return object Illuminate\Contracts\View\View
	*/
	public function showTeachingUnit($id){
		return view('dashboard.teachingUnits.show')->with('teachingUnit', TeachingUnit::findOrFail($id));
	}
	
	/**
	* Post route, which accepts post data from a create teaching unit form and persists this data in the database.
	* Redirects the user to the created teaching unit page, with a success message.
	*
	*/
	public function postTeachingUnit(){
		$teachingUnit = TeachingUnit::create(Request::all());
        return redirect('/dashboard/teaching-units/'.$teachingUnit->id)->withSuccess('Teaching unit has been created.');
	}
	
	/**
	* Displays form for editing a single teaching unit.
	*
	* @param TeachingUnit $teachingUnit The teaching unit object to be edited.
	*
	* @return object Illuminate\Contracts\View\View 
	*/
	public function editTeachingUnit(TeachingUnit $teachingUnit){
		return view('dashboard.teachingUnits.edit')->with('teachingUnit', $teachingUnit);
	}
	
	/**
	* HTTP PUT route. Persists an edited teaching unit object in the database.
	* Redirects the user to the edited teaching unit page with a success message, after persisting the data.
	*
	* @param TeachingUnit $teachingUnit The edited teaching unit object to be persisted.
	*/
	public function putTeachingUnit(TeachingUnit $teachingUnit){
		$teachingUnit->update(Request::all());
        return redirect('/dashboard/teaching-units/'.$teachingUnit->id)->withSuccess('Teaching unit has been updated.');
	}
	
	/**
	* Deletes a teaching unit object from the database.
	* Redirects the user to the teaching units page with a success message after deleting the teaching unit.
	*
	* @param TeachingUnit $teachingUnit The teaching unit object to be deleted.
	*/
	public function deleteTeachingUnit(TeachingUnit $teachingUnit){
		$teachingUnit->delete();
        return redirect('/dashboard/teaching-units')->withSuccess('Teaching unit has been deleted.');
	}
	
	/**
	* Displays all created study materials.
	* 
	* @param int $teachingUnitId The  id of the teaching unit to which the displayed study materials belongs.
	*
	* @return Illuminate\Contracts\View\View Page displaying all the study materials, uses the blade view dashboard.studyMaterials.index
	*/
	public function showAllStudyMaterials($teachingUnitId){
		return view('dashboard.studyMaterials.index')
        	->with('studyMaterials', StudyMaterial::where('teaching_unit_id', $teachingUnitId)->get())
        	->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	/**
	* Displays a form for creating new study materials.
	* 
	* @param int $teachingUnitId The  id of the teaching unit to which the study materials belongs.
	*
	* @return Illuminate\Contracts\View\View Form for creating study material, uses the blade view dashboard.studyMaterials.create
	*/
	public function createStudyMaterial($teachingUnitId){
		return view('dashboard.studyMaterials.create')->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	/**
	* Displays a single study material, with options for editing and deleting.
	* 
	* @param int $teachingUnitId The  id of the teaching unit to which the study materials belongs.
	* @param int $id The  id of the study materials.
	*
	* @return Illuminate\Contracts\View\View Study material page, uses the blade view dashboard.studyMaterials.show
	*/
	public function showStudyMaterial($teachingUnitId, $id){
		return view('dashboard.studyMaterials.show')
                ->with('studyMaterial', StudyMaterial::find($id))
                ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	/**
	* Accepts HTTP POST request for creating and persisting a new study material.
	* Redirects the user to the created study material page, with a success message.
	* 
	* @param int $teachingUnitId The  id of the teaching unit to which the study materials belongs.
	*/
	public function postStudyMaterial($teachingUnitId){
		$studyMaterial = StudyMaterial::create(Request::all());
        $teachingUnit = Request::get('teaching_unit_id', '1');
        return redirect('/dashboard/teaching-units/'.$teachingUnit.'/study-materials/'.$studyMaterial->id)->withSuccess('Study material has been created.');
	}
	
	/**
	* Displays a form for editing a study material.
	* 
	* @param int $teachingUnitId The  id of the teaching unit to which the study materials belongs.
	* @param int $id The  id of the study materials.
	*
	* @return Illuminate\Contracts\View\View Form for editing teaching unit. Uses the blade view: dashboard.studyMaterials.edit
	*/
	public function editStudyMaterial($teachingUnitId, $id){
		$studyMaterial = StudyMaterial::find($id);
        return view('dashboard.studyMaterials.edit')
                ->with('studyMaterial', $studyMaterial)
                ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	/**
	* Processes PUT requested for persisting and edited study material.
	* Redirects the user to the edited study material page, with a success message. 
	*
	* @param int $teachingUnitId The  id of the teaching unit to which the study materials belongs.
	* @param int $id The  id of the study materials.
	*/
	public function putStudyMaterial($teachingUnitId, $id){
		$studyMaterial = StudyMaterial::find($id);
        $studyMaterial->update(Request::all());
        return redirect('/dashboard/teaching-units/'.$teachingUnitId.'/study-materials/'.$studyMaterial->id)->withSuccess('Study material has been updated.');
	}
	
	/**
	* Deletes a study material from the databse.
	* Redirects the use to the study materials page with a success message. 
	*
	* @param int $teachingUnitId The  id of the teaching unit to which the study materials belongs.
	* @param int $id The  id of the study materials.
	*/
	public function deleteStudyMaterial($teachingUnitId, $id){
		$studyMaterial = StudyMaterial::find($id);
        $studyMaterial->delete();
        return redirect('dashboard/teaching-units/'.$teachingUnitId.'/study-materials')->withSuccess('Study material has been deleted.');
	}
	
	/**
	* Displays all created quizzes.
	* 
	* @param int $teachingUnitId The id of the teaching unit to which the quizzes belongs.
	*
	* @return Illuminate\Contracts\View\View Form for editing teaching unit. Uses the blade view: dashboard.quizzes.index
	*/
	public function showAllQuizzes($teachingUnitId){
		return view('dashboard.quizzes.index')
        ->with('quizzes', Quiz::where('teaching_unit_id', $teachingUnitId)->get())
        ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	/**
	* Displays form for creating a new quiz.
	* 
	* @param int $teachingUnitId The id of the teaching unit to which the quiz belongs.
	*
	* @return Illuminate\Contracts\View\View Form for creating new quiz. Uses the blade view: dashboard.create
	*/
	public function createQuiz($teachingUnitId){
		return view('dashboard.create')
                ->with('teachingUnit', TeachingUnit::find($teachingUnitId))
                ->with('title', 'Create new Quiz')
                ->with('partial', 'quiz')
                ->with('url', 'dashboard/teaching-units/'.$teachingUnitId.'/quizzes');
	}
	
	/**
	* Displays a single quiz page, with options for editing and deleting.
	* 
	* @param int $teachingUnitId The id of the teaching unit to which the quiz belongs.
	* @param int $id The quiz id.
	*
	* @return Illuminate\Contracts\View\View Quiz page. Uses the blade view: dashboard.quizzes.show
	*/
	public function showQuiz($teachingUnitId, $id){
		return view('dashboard.quizzes.show')
                ->with('quiz', Quiz::find($id))
                ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	/**
	* Accepts POST request for creating and persisting a new teaching unit in the database.
	* Redirects the user to the created quiz page, with a success message. 
	*
	* @param int $teachingUnitId The id of the teaching unit to which the quiz belongs.
	*
	*/
	public function postQuiz($teachingUnitId){
		$quiz = Quiz::create(Request::all());
                $teachingUnit = Request::get('teaching_unit_id');
                return redirect('/dashboard/teaching-units/'.$teachingUnit.'/quizzes/'.$quiz->id)->withSuccess('Quiz has been created.');
	}
	
	/**
	* Displays a form for editing a quiz.
	* 
	* @param int $teachingUnitId The id of the teaching unit to which the quiz belongs.
	* @param int $id The quiz id.
	*
	* @return Illuminate\Contracts\View\View Quiz editing form. Uses the blade view: dashboard.edit
	*/
	public function editQuiz($teachingUnitId, $id){
		$quiz = Quiz::find($id);
                return view('dashboard.edit')
                ->with('objModel', $quiz)
                ->with('title', 'Edit Quiz')
                ->with('partial', 'quiz')
                ->with('url', 'dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$id)
                ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	/**
	* Processes HTTP PUT request for persisting an edited quiz.
	* Redirects the user to the edited quiz page with a success message. 
	*
	* @param int $teachingUnitId The id of the teaching unit to which the quiz belongs.
	* @param int $id The quiz id.
	*
	*/
	public function putQuiz($teachingUnitId, $id){
		$quiz = Quiz::find($id);
                $quiz->update(Request::all());
                return redirect('/dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quiz->id)->withSuccess('Quiz has been updated.');
	}
	
	/**
	* Deletes a quiz from the database.
	* Redirects the user to the quizzzes page with a success message. 
	*
	* @param int $teachingUnitId The id of the teaching unit to which the quiz belongs.
	* @param int $id The quiz id.
	*
	*/
	public function deleteQuiz($teachingUnitId, $id){
		$quiz = Quiz::find($id);
                $quiz->delete();
                return redirect('dashboard/teaching-units/'.$teachingUnitId.'/quizzes')->withSuccess('Quiz has been deleted.');
	}
	
	/**
	* Displays all created questions. 
	*
	* @param int $teachingUnitId The id of the teaching unit to which the questions belongs.
	* @param int $quizId The id of the quiz to which the questions belong.
	*
	* @return Illuminate\Contracts\View\View Questions page. Uses the blade view: dashboard.questions.index
	*/
	public function showAllQuestions($teachingUnitId, $quizId){
		return view('dashboard.questions.index')
                    ->with('questions', Question::where('quiz_id', $quizId)->get())
                    ->with('quiz', Quiz::find($quizId))
                    ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	/**
	* Displays a form for creating a new quiz question. 
	*
	* @param int $teachingUnitId The id of the teaching unit to which the question belongs.
	* @param int $quizId The id of the quiz to which the question belong.
	*
	* @return Illuminate\Contracts\View\View Form for ccreating a quiz question. Uses the blade view: dashboard.create
	*/
	public function createQuestion($teachingUnitId, $quizId){
		return view('dashboard.create')
                    ->with('quiz', Quiz::find($quizId))
                    ->with('teachingUnit', TeachingUnit::find($teachingUnitId))
                    ->with('title', 'Create question')
                    ->with('partial', 'question')
                    ->with('url', 'dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions');
	}
	
	/**
	* Displays a single question page, with options for editing and deleting. 
	*
	* @param int $teachingUnitId The id of the teaching unit to which the question belongs.
	* @param int $quizId The id of the quiz to which the question belong.
	* @param int $questionId The question id.
	*
	* @return Illuminate\Contracts\View\View Question page. Uses the blade view: dashboard.questions.show
	*/
	public function showQuestion($teachingUnitId, $quizId, $questionId){
		 return view('dashboard.questions.show')
                    ->with('question', Question::find($questionId))
                    ->with('quiz', Quiz::find($quizId))
                    ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	/**
	* Processes HTTP POST request for creating and persisting a new question in the database. 
	* Redirects the user to the created question page, with a success message.
	*
	* @param int $teachingUnitId The id of the teaching unit to which the question belongs.
	* @param int $quizId The id of the quiz to which the question belong.
	*
	*/
	public function postQuestion($teachingUnitId, $quizId){
		$question = Question::create(Request::all());
                    $quizId = Request::get('quiz_id');
                    return redirect('/dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$question->id)->withSuccess('Question has been created.');
	}
	
	/**
	* Displays a form for editing a question. 
	*
	* @param int $teachingUnitId The id of the teaching unit to which the question belongs.
	* @param int $quizId The id of the quiz to which the question belong.
	* @param int $questionId The question id.
	*
	* @return Illuminate\Contracts\View\View Edit question form. Uses the blade view: dashboard.edit
	*/
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
	
	/**
	* Process PUT request for persisting an edited question. 
	* Rediretcs the user to the edited question page, with a success message. 
	* 
	* @param int $teachingUnitId The id of the teaching unit to which the question belongs.
	* @param int $quizId The id of the quiz to which the question belong.
	* @param int $questionId The question id.
	*
	*/
	public function putQuestion($teachingUnitId, $quizId, $questionId){
		$question = Question::find($questionId);
                    $question->update(Request::all());
                    return redirect('/dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$question->id)->withSuccess('Question has been updated.');
	}
	
	/**
	* Deletes a question from the database. 
	* Rediretcs the user to the questions page, with a success message. 
	* 
	* @param int $teachingUnitId The id of the teaching unit to which the question belongs.
	* @param int $quizId The id of the quiz to which the question belong.
	* @param int $questionId id of the question to be deleted.
	*
	*/
	public function deleteQuestion($teachingUnitId, $quizId, $questionId){
		$question = Question::find($questionId);
                    $question->delete();
                    return redirect('dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions')->withSuccess('Question has been deleted.');
	}
	
	/**
	* Displays all answer choices for a single question. 
	*
	* @param int $teachingUnitId The id of the teaching unit to which the answers belongs.
	* @param int $quizId The id of the quiz to which the answers belong.
	* @param int $questionId The id of the question to which the answers belong.
	*
	* @return Illuminate\Contracts\View\View All answers for a question. Uses the blade view: dashboard.answers.index
	*/
	public function showAllAnswers($teachingUnitId, $quizId, $questionId){
		return view('dashboard.answers.index')
                        ->with('answers', Answer::where('question_id', $questionId)->get())
                        ->with('question', Question::find($questionId))
                        ->with('quiz', Quiz::find($quizId))
                        ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	/**
	* Displays form for creating an answer choice. 
	*
	* @param int $teachingUnitId The id of the teaching unit to which the answers belongs.
	* @param int $quizId The id of the quiz to which the answers belong.
	* @param int $questionId The id of the question to which the answers belong.
	*
	* @return Illuminate\Contracts\View\View Form for creating and answer choice. Uses the blade view: dashboard.create
	*/
	public function createAnswer($teachingUnitId, $quizId, $questionId){
		return view('dashboard.create')
                        ->with('question', Question::find($questionId))
                        ->with('quiz', Quiz::find($quizId))
                        ->with('teachingUnit', TeachingUnit::find($teachingUnitId))
                        ->with('title', 'Create answer choice')
                        ->with('partial', 'answer')
                        ->with('url', 'dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$questionId.'/answers');
	}
	
	/**
	* Displays a single answer, with options for editing and deleting. 
	*
	* @param int $teachingUnitId The id of the teaching unit to which the answers belongs.
	* @param int $quizId The id of the quiz to which the answers belong.
	* @param int $questionId The id of the question to which the answers belong.
	* @param int $answerId The id of the answer choice.
	*
	* @return Illuminate\Contracts\View\View Single Answer page. Uses the blade view: dashboard.answers.show
	*/
	public function showAnswer($teachingUnitId, $quizId, $questionId, $answerId){
		return view('dashboard.answers.show')
                        ->with('answer', Answer::find($answerId))
                        ->with('question', Question::find($questionId))
                        ->with('quiz', Quiz::find($quizId))
                        ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
	}
	
	/**
	* Processes POST request to create and persist an answer choice. 
	* Redirects the user to the created answer page with a success message.
	*
	* @param int $teachingUnitId The id of the teaching unit to which the answers belongs.
	* @param int $quizId The id of the quiz to which the answers belong.
	* @param int $questionId The id of the question to which the answers belong.
	*
	*/
	public function postAnswer($teachingUnitId, $quizId, $questionId){
		$answer = Answer::create(Request::all());
                        $question = Request::get('question_id');
                        return redirect('/dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$questionId.'/answers/'.$answer->id)->withSuccess('Answer choice has been created.');
	}
	
	/**
	* Displays a form for editing an answer choice. 
	*
	* @param int $teachingUnitId The id of the teaching unit to which the answers belongs.
	* @param int $quizId The id of the quiz to which the answers belong.
	* @param int $questionId The id of the question to which the answers belong.
	* @param int $answerId The id of the answer choice.
	*
	* @return Illuminate\Contracts\View\View Answer editing form. Uses the blade view: dashboard.edit
	*/
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
	
	/**
	* Processes put request to persist an edited answer.
	* Redirects the user to the edited answer page with a success message. 
	*
	* @param int $teachingUnitId The id of the teaching unit to which the answers belongs.
	* @param int $quizId The id of the quiz to which the answers belong.
	* @param int $questionId The id of the question to which the answers belong.
	* @param int $answerId The id of the answer choice.
	*
	*/
	public function putAnswer($teachingUnitId, $quizId, $questionId, $answerId){
		$answer = Answer::find($answerId);
                        $answer->update(Request::all());
                        return redirect('/dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$questionId.'/answers/'.$answer->id)->withSuccess('Answer choice has been updated.');
	}
	
	/**
	* Deletes an answer option.
	* Redirects the user to the answers page with a success message. 
	*
	* @param int $teachingUnitId The id of the teaching unit to which the answers belongs.
	* @param int $quizId The id of the quiz to which the answers belong.
	* @param int $questionId The id of the question to which the answers belong.
	* @param int $answerId The id of the answer choice.
	*
	*/
	public function deleteAnswer($teachingUnitId, $quizId, $questionId, $answerId){
		$answer = Answer::find($answerId);
                        $answer->delete();
                        return redirect('dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$questionId.'/answers')->withSuccess('Answer choice has been deleted.');
	}
}
