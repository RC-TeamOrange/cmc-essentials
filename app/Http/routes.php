<?php

use Illuminate\Http\Response;

use CmcEssentials\Source;
use CmcEssentials\StudyMaterial;
use CmcEssentials\TeachingUnit;
use CmcEssentials\Quiz;
use CmcEssentials\Question;
use CmcEssentials\Answer;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/** 
 *Application Front end routes
 */
 
 /** 
 * Home/Landing page route.
 */
Route::get('/', ['as' => 'home', function () {
    return view('welcome');
}]);

 /** 
 * Session login page route.
 */
Route::get('/session-login', ['as' => 'sessionLogin', 'uses' => 'TeachingUnitController@sessionLogin']);

 /** 
 * Syllabus page route.
 */
Route::get('/syllabus', ['as' => 'syllabus', 'uses' => 'TeachingUnitController@syllabus']);

 /** 
 * Teaching unit pages route group. Contains all routes within teaching units and also applies common middleware on all routes in the group.
 */
Route::group(['as'=>'teaching-units::', 'middleware'=>'sessionAuth', 'prefix' => 'teaching-units'], function () {
	
    Route::get('/', ['as' => 'showall', 'uses' => 'TeachingUnitController@showAll']);
	
    Route::post('/', ['as' => 'postSessionLogin', 'uses' => 'TeachingUnitController@postSessionLogin']);
	
    Route::get('/{slug}', ['as' => 'show', 'uses' => 'TeachingUnitController@show']);
	
    Route::get('/{slug}/study', ['as' => 'study', 'uses'=>'StudyMaterialController@showStudyMaterials']);
	
    Route::post('/{slug}/study', ['as' => 'study', 'uses'=>'StudyMaterialController@ajaxHandeller']);   
 
    Route::group(['as'=>'quizzes::', 'prefix' => '{teachingUnitSlug}/quizzes'], function ($teachingUnitSlug) {
		
        Route::get('/', ['as' => 'showall', 'uses' => 'QuizController@showAll']);
        
        Route::get('{quizSlug}/questions', ['as' => 'questions', 'uses'=>'QuizQuestionController@getQuizQuestion']);
        
        Route::post('{quizSlug}/questions', ['as' => 'questions', 'uses'=>'QuizQuestionController@saveChoice']);
        
        Route::get('{quizSlug}/results', ['as' => 'results', 'uses'=>'QuizResultsController@getQuizResults']);
        
    });
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('/login', function () {
    return redirect('auth/login');
});

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


/**Admin routes*/

/**
 * The following routes are used for administrative tasks. Creating, editing and deleting teaching units,
 * study materials, sources, quiz questions answers.
 */

Route::group(['as'=>'dashboard::', 'middleware' => 'auth', 'prefix' => 'dashboard'], function () {
	
    Route::get('/', ['as' => 'showall', 'uses' => 'DashboardController@showAllTeachingUnits']);
	
    Route::group(['as'=>'teaching-units::', 'prefix' => 'teaching-units'], function () {
        
		Route::get('/', ['as' => 'showall', 'uses' => 'DashboardController@showAllTeachingUnits']);
		
        Route::get('create', ['as' => 'create', 'uses' => 'DashboardController@createTeachingUnit']);
		
        Route::get('{id}', ['as' => 'show', 'uses' => 'DashboardController@showTeachingUnit']);
		
        Route::post('/', ['as' => 'post', 'uses' => 'DashboardController@postTeachingUnit']);
		
        Route::get('{teachingUnit}/edit', ['as' => 'edit', 'uses' => 'DashboardController@editTeachingUnit']);
		
        Route::put('{teachingUnit}', ['uses' => 'DashboardController@putTeachingUnit']);
		
        Route::get('{teachingUnit}/delete', ['as' => 'delete', 'uses' => 'DashboardController@deleteTeachingUnit']);
        
        //Study Material (study content) routes.
        Route::group(['as'=>'study-materials::', 'prefix' => '{teachingUnitId}/study-materials'], function ($teachingUnitId) {
            
            Route::get('/', ['as' => 'showall', 'uses' => 'DashboardController@showAllStudyMaterials']);
            
            Route::get('create', ['as' => 'create', 'uses' => 'DashboardController@createStudyMaterial']);
            
            Route::get('{id}', ['as' => 'show', 'uses' => 'DashboardController@showStudyMaterial']);
            
            Route::post('/', ['uses' => 'DashboardController@postStudyMaterial']);
            
            Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'DashboardController@editStudyMaterial']);
            
            Route::put('/{id}', ['uses' => 'DashboardController@putStudyMaterial']);
            
            Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'DashboardController@deleteStudyMaterial']);
        });
        
        //Quiz routes.
        Route::group(['as'=>'quizzes::', 'prefix' => '{teachingUnitId}/quizzes'], function ($teachingUnitId) {
            Route::get('/', ['as' => 'showall', function ($teachingUnitId) {
                return view('dashboard.quizzes.index')
                ->with('quizzes', Quiz::where('teaching_unit_id', $teachingUnitId)->get())
                ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
            }]);
            Route::get('create', ['as' => 'create', function ($teachingUnitId) {
                return view('dashboard.create')
                ->with('teachingUnit', TeachingUnit::find($teachingUnitId))
                ->with('title', 'Create new Quiz')
                ->with('partial', 'quiz')
                ->with('url', 'dashboard/teaching-units/'.$teachingUnitId.'/quizzes');
            }]);
            Route::get('{id}', ['as' => 'show', function ($teachingUnitId, $id) {
                return view('dashboard.quizzes.show')
                ->with('quiz', Quiz::find($id))
                ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
            }]);
            Route::post('/', function($teachingUnitId) {
                $quiz = Quiz::create(Request::all());
                $teachingUnit = Request::get('teaching_unit_id');
                return redirect('/dashboard/teaching-units/'.$teachingUnit.'/quizzes/'.$quiz->id)->withSuccess('Quiz has been created.');
            });
            Route::get('/{id}/edit', ['as' => 'edit', function ($teachingUnitId, $id) {
                $quiz = Quiz::find($id);
                return view('dashboard.edit')
                ->with('objModel', $quiz)
                ->with('title', 'Edit Quiz')
                ->with('partial', 'quiz')
                ->with('url', 'dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$id)
                ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
            }]);
            Route::put('/{id}', function($teachingUnitId, $id) {
                $quiz = Quiz::find($id);
                $quiz->update(Request::all());
                return redirect('/dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quiz->id)->withSuccess('Quiz has been updated.');
            });
            Route::get('/{id}/delete', ['as' => 'delete', function($teachingUnitId, $id) {
                $quiz = Quiz::find($id);
                $quiz->delete();
                return redirect('dashboard/teaching-units/'.$teachingUnitId.'/quizzes')->withSuccess('Quiz has been deleted.');
            }]);
            
            //Questions routes.
            Route::group(['as'=>'questions::', 'prefix' => '{quizId}/questions'], function ($quizId) {
                Route::get('/', ['as' => 'showall', function ($teachingUnitId, $quizId) {
                    return view('dashboard.questions.index')
                    ->with('questions', Question::where('quiz_id', $quizId)->get())
                    ->with('quiz', Quiz::find($quizId))
                    ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
                }]);
                Route::get('create', ['as' => 'create', function ($teachingUnitId, $quizId) {
                    return view('dashboard.create')
                    ->with('quiz', Quiz::find($quizId))
                    ->with('teachingUnit', TeachingUnit::find($teachingUnitId))
                    ->with('title', 'Create question')
                    ->with('partial', 'question')
                    ->with('url', 'dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions');
                }]);
                Route::get('{questionId}', ['as' => 'show', function ($teachingUnitId, $quizId, $questionId) {
                    return view('dashboard.questions.show')
                    ->with('question', Question::find($questionId))
                    ->with('quiz', Quiz::find($quizId))
                    ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
                }]);
                Route::post('/', function($teachingUnitId, $quizId) {
                    $question = Question::create(Request::all());
                    $quizId = Request::get('quiz_id');
                    return redirect('/dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$question->id)->withSuccess('Question has been created.');
                });
                Route::get('/{questionId}/edit', ['as' => 'edit', function ($teachingUnitId, $quizId, $questionId) {
                    $question = Question::find($questionId);
                    return view('dashboard.edit')
                    ->with('objModel', $question)
                    ->with('title', 'Edit Question')
                    ->with('partial', 'question')
                    ->with('url', 'dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$questionId)
                    ->with('quiz', Quiz::find($quizId))
                    ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
                }]);
                Route::put('/{questionId}', function($teachingUnitId, $quizId, $questionId) {
                    $question = Question::find($questionId);
                    $question->update(Request::all());
                    return redirect('/dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$question->id)->withSuccess('Question has been updated.');
                });
                Route::get('/{questionId}/delete', ['as' => 'delete', function($teachingUnitId, $quizId, $questionId) {
                    $question = Question::find($questionId);
                    $question->delete();
                    return redirect('dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions')->withSuccess('Question has been deleted.');
                }]);
                
                //Answer routes. 
                Route::group(['as'=>'answers::', 'prefix' => '{questionId}/answers'], function ($questionId) {
                    Route::get('/', ['as' => 'showall', function ($teachingUnitId, $quizId, $questionId) {
                        return view('dashboard.answers.index')
                        ->with('answers', Answer::where('question_id', $questionId)->get())
                        ->with('question', Question::find($questionId))
                        ->with('quiz', Quiz::find($quizId))
                        ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
                    }]);
                    Route::get('create', ['as' => 'create', function ($teachingUnitId, $quizId, $questionId) {
                        return view('dashboard.create')
                        ->with('question', Question::find($questionId))
                        ->with('quiz', Quiz::find($quizId))
                        ->with('teachingUnit', TeachingUnit::find($teachingUnitId))
                        ->with('title', 'Create answer choice')
                        ->with('partial', 'answer')
                        ->with('url', 'dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$questionId.'/answers');
                    }]);
                    Route::get('{answerId}', ['as' => 'show', function ($teachingUnitId, $quizId, $questionId, $answerId) {
                        return view('dashboard.answers.show')
                        ->with('answer', Answer::find($answerId))
                        ->with('question', Question::find($questionId))
                        ->with('quiz', Quiz::find($quizId))
                        ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
                    }]);
                    Route::post('/', function($teachingUnitId, $quizId, $questionId) {
                        $answer = Answer::create(Request::all());
                        $question = Request::get('question_id');
                        return redirect('/dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$questionId.'/answers/'.$answer->id)->withSuccess('Answer choice has been created.');
                    });
                    Route::get('/{answerId}/edit', ['as' => 'edit', function ($teachingUnitId, $quizId, $questionId, $answerId) {
                        $answer = Answer::find($answerId);
                        return view('dashboard.edit')
                        ->with('objModel', $answer)
                        ->with('title', 'Edit Answer Choice')
                        ->with('partial', 'answer')
                        ->with('url', 'dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$questionId.'/answers/'.$answerId)
                        ->with('question', Question::find($questionId))
                        ->with('quiz', Quiz::find($quizId))
                        ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
                    }]);
                    Route::put('/{answerId}', function($teachingUnitId, $quizId, $questionId, $answerId) {
                        $answer = Answer::find($answerId);
                        $answer->update(Request::all());
                        return redirect('/dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$questionId.'/answers/'.$answer->id)->withSuccess('Answer choice has been updated.');
                    });
                    Route::get('/{answerId}/delete', ['as' => 'delete', function($teachingUnitId, $quizId, $questionId, $answerId) {
                        $answer = Answer::find($answerId);
                        $answer->delete();
                        return redirect('dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$questionId.'/answers')->withSuccess('Answer choice has been deleted.');
                    }]);
                });
            });
        });
    });
});
