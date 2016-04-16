<?php
use CmcEssentials\Source;
use CmcEssentials\StudyMaterial;
use CmcEssentials\TeachingUnit;
use CmcEssentials\Quiz;
use CmcEssentials\Question;
use CmcEssentials\Answer;
use CmcEssentials\Presenter;
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


/*Application Front end routes*/
Route::get('/', ['as' => 'home', function () {
    return view('welcome');
}]);
Route::get('/syllabus', ['as' => 'syllabus', function () {
    return view('syllabus');
}]);
Route::group(['as'=>'teaching-units::', 'prefix' => 'teaching-units'], function () {
    Route::get('/', ['as' => 'showall', function () {
        return view('teachingUnits')->with('teachingUnits', TeachingUnit::orderBy('level', 'asc')->get());
    }]);
    Route::get('/{slug}', ['as' => 'show', function ($slug) {
        return view('teachingUnit')->with('teachingUnit', TeachingUnit::where('slug', $slug)->firstOrFail());
    }]);
    Route::get('/{slug}/study', ['as' => 'study', function ($slug) {
        $teachingUnit = TeachingUnit::where('slug', $slug)->first();
        $studyMaterial = StudyMaterial::where('teaching_unit_id', $teachingUnit->id)->orderBy('level', 'asc')->paginate(1);
        return view('StudyContent')->with('studyMaterials', $studyMaterial);
    }]);
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
The following routes are used for administrative tasks. Creating, editing and deleting teaching units,
study materials, sources, quize questions answers.*/

Route::group(['as'=>'dashboard::', 'middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', ['as' => 'showall', function () {
        return view('dashboard.index')->with('teachingUnits', TeachingUnit::all());
    }]);
    Route::group(['as'=>'teaching-units::', 'prefix' => 'teaching-units'], function () {
        Route::get('/', ['as' => 'showall', function () {
            return view('dashboard.index')->with('teachingUnits', TeachingUnit::all());
        }]);
        Route::get('create', ['as' => 'create', function () {
            return view('dashboard.teachingUnits.create');
        }]);
        Route::get('{id}', ['as' => 'show', function ($id) {
            return view('dashboard.teachingUnits.show')->with('teachingUnit', TeachingUnit::findOrFail($id));
        }]);
        Route::post('/', ['as' => 'post', function() {
            $teachingUnit = TeachingUnit::create(Request::all());
            return redirect('/dashboard/teaching-units/'.$teachingUnit->id)->withSuccess('Teaching unit has been created.');
        }]);
        Route::get('{teachingUnit}/edit', ['as' => 'edit', function (TeachingUnit $teachingUnit) {
            return view('dashboard.teachingUnits.edit')->with('teachingUnit', $teachingUnit);
        }]);
        Route::put('{teachingUnit}', function(TeachingUnit $teachingUnit) {
            $teachingUnit->update(Request::all());
            return redirect('/dashboard/teaching-units/'.$teachingUnit->id)->withSuccess('Teaching unit has been updated.');
        });
        Route::get('{teachingUnit}/delete', ['as' => 'delete', function(TeachingUnit $teachingUnit) {
            $teachingUnit->delete();
            return redirect('/dashboard/teaching-units')->withSuccess('Teaching unit has been deleted.');
        }]);
        
        //Study Material (study content) routes.
        Route::group(['as'=>'study-materials::', 'prefix' => '{teachingUnitId}/study-materials'], function ($teachingUnitId) {
            Route::get('/', ['as' => 'showall', function ($teachingUnitId) {
                return view('dashboard.studyMaterials.index')
                ->with('studyMaterials', StudyMaterial::all())
                ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
            }]);
            Route::get('create', ['as' => 'create', function ($teachingUnitId) {
                return view('dashboard.studyMaterials.create')->with('teachingUnit', TeachingUnit::find($teachingUnitId));
            }]);
            Route::get('{id}', ['as' => 'show', function ($teachingUnitId, $id) {
                return view('dashboard.studyMaterials.show')
                ->with('studyMaterial', StudyMaterial::find($id))
                ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
            }]);
            Route::post('/', function($teachingUnitId) {
                $studyMaterial = StudyMaterial::create(Request::all());
                $teachingUnit = Request::get('teaching_unit_id', '1');
                return redirect('/dashboard/teaching-units/'.$teachingUnit.'/study-materials/'.$studyMaterial->id)->withSuccess('Study material has been created.');
            });
            Route::get('/{id}/edit', ['as' => 'edit', function ($teachingUnitId, $id) {
                $studyMaterial = StudyMaterial::find($id);
                return view('dashboard.studyMaterials.edit')
                ->with('studyMaterial', $studyMaterial)
                ->with('teachingUnit', TeachingUnit::find($teachingUnitId));
            }]);
            Route::put('/{id}', function($teachingUnitId, $id) {
                $studyMaterial = StudyMaterial::find($id);
                $studyMaterial->update(Request::all());
                return redirect('/dashboard/teaching-units/'.$teachingUnitId.'/study-materials/'.$studyMaterial->id)->withSuccess('Study material has been updated.');
            });
            Route::get('/{id}/delete', ['as' => 'delete', function($teachingUnitId, $id) {
                $studyMaterial = StudyMaterial::find($id);
                $studyMaterial->delete();
                return redirect('dashboard/teaching-units/'.$teachingUnitId.'/study-materials')->withSuccess('Study material has been deleted.');
            }]);
        });
        
        //Quize routes.
        Route::group(['as'=>'quizzes::', 'prefix' => '{teachingUnitId}/quizzes'], function ($teachingUnitId) {
            Route::get('/', ['as' => 'showall', function ($teachingUnitId) {
                return view('dashboard.quizzes.index')
                ->with('quizzes', Quiz::all())
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
                    ->with('questions', Question::all())
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
                        ->with('answers', Answer::all())
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
                        return redirect('/dashboard/teaching-units/'.$teachingUnitId.'/quizzes/'.$quizId.'/questions/'.$question.'/answers/'.$answer->id)->withSuccess('Answer choice has been created.');
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
