<?php
use CmcEssentials\Source;
use CmcEssentials\StudyMaterial;
use CmcEssentials\TeachingUnit;
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
        return view('teachingUnits')->with('teachingUnits', TeachingUnit::all());
    }]);
    Route::get('/{slug}', ['as' => 'show', function ($slug) {
        return view('teachingUnit')->with('teachingUnit', TeachingUnit::where('slug', $slug)->firstOrFail());
    }]);
    Route::get('/{slug}/study', ['as' => 'study', function ($slug) {
        $teachingUnit = TeachingUnit::where('slug', $slug)->first();
        //dd($teachingUnit->id);
        $studyMaterial = StudyMaterial::where('teaching_unit_id', $teachingUnit->id)->paginate(1);
        //dd($studyMaterial);
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
    });
    Route::get('teaching-units/{teachingUnit}/sources', function () {
        return view('dashboard.studyMaterials');
    });
    Route::get('teaching-units/{teachingUnit}/sources/{source}', function () {
        return view('dashboard.studyMaterials');
    });
});
