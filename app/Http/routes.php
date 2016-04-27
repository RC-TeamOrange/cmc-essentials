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
            
            Route::get('/', ['as' => 'showall', 'uses' => 'DashboardController@showAllQuizzes']);
            
            Route::get('create', ['as' => 'create', 'uses' => 'DashboardController@createQuiz']);
            
            Route::get('{id}', ['as' => 'show', 'uses' => 'DashboardController@showQuiz']);
            
            Route::post('/', ['uses' => 'DashboardController@postQuiz']);
            
            Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'DashboardController@editQuiz']);
            
            Route::put('/{id}', ['uses' => 'DashboardController@putQuiz']);
            
            Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'DashboardController@deleteQuiz']);
            
            //Questions routes.
            Route::group(['as'=>'questions::', 'prefix' => '{quizId}/questions'], function ($quizId) {
                
                Route::get('/', ['as' => 'showall', 'uses' => 'DashboardController@showAllQuestions']);
                
                Route::get('create', ['as' => 'create', 'uses' => 'DashboardController@createQuestion']);
                
                Route::get('{questionId}', ['as' => 'show', 'uses' => 'DashboardController@showQuestion']);
                
                Route::post('/', ['uses' => 'DashboardController@postQuestion']);
                
                Route::get('/{questionId}/edit', ['as' => 'edit', 'uses' => 'DashboardController@editQuestion']);
                
                Route::put('/{questionId}', ['uses' => 'DashboardController@putQuestion']);
                
                Route::get('/{questionId}/delete', ['as' => 'delete', 'uses' => 'DashboardController@deleteQuestion']);
                
                //Answer routes. 
                Route::group(['as'=>'answers::', 'prefix' => '{questionId}/answers'], function ($questionId) {
                    
                    Route::get('/', ['as' => 'showall', 'uses' => 'DashboardController@showAllAnswers']);
                    
                    Route::get('create', ['as' => 'create', 'uses' => 'DashboardController@createAnswer']);
                    
                    Route::get('{answerId}', ['as' => 'show', 'uses' => 'DashboardController@showAnswer']);
                    
                    Route::post('/', ['uses' => 'DashboardController@postAnswer']);
                    
                    Route::get('/{answerId}/edit', ['as' => 'edit', 'uses' => 'DashboardController@editAnswer']);
                    
                    Route::put('/{answerId}', ['uses' => 'DashboardController@putAnswer']);
                    
                    Route::get('/{answerId}/delete', ['as' => 'delete', 'uses' => 'DashboardController@deleteAnswer']);
                });
            });
        });
    });
});
