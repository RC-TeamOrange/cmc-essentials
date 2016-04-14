<?php
use CmcEssentials\Source;
use CmcEssentials\StudyMaterial;
use CmcEssentials\TeachingUnit;
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

Route::get('/', function () {
    return view('welcome');
});

/**Admin routes*/
/**
The following routes are used for administrative tasks. Creating, editing and deleting teaching units,
study materials, sources, quize questions answers.*/

Route::group(['as'=>'dashboard', 'middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', ['as' => 'showall', function () {
        return view('dashboard.index')->with('teachingUnits', TeachingUnit::all());
    }]);
    Route::group(['as'=>'teaching-units', 'middleware' => 'auth', 'prefix' => 'teaching-units'], function () {
        Route::get('/', ['as' => 'showall', function () {
            return view('dashboard.index')->with('teachingUnits', TeachingUnit::all());
        }]);
        Route::get('create', ['as' => 'create', function () {
            return view('dashboard.teachingUnits.create');
        }]);
        Route::get('{id}', ['as' => 'show', function ($id) {
            return view('dashboard.teachingUnits.show')->with('teachingUnit', TeachingUnit::find($id));
        }]);
        Route::post('/', function() {
            $teachingUnit = TeachingUnit::create(Request::all());
            return redirect('/dashboard/teaching-units/'.$teachingUnit->id)->withSuccess('Teaching unit has been created.');
        });
        Route::get('{teachingUnit}/edit', ['as' => 'edit', function (TeachingUnit $teachingUnit) {
            return view('dashboard.teachingUnits.edit')->with('teachingUnit', $teachingUnit);
        }]);
        Route::put('{teachingUnit}', function(TeachingUnit $teachingUnit) {
            $teachingUnit->update(Request::all());
            return redirect('/dashboard/teaching-units/'.$teachingUnit->id)->withSuccess('Teaching unit has been updated.');
        });
        Route::get('{teachingUnit}/delete', ['as' => 'delete', function(TeachingUnit $teachingUnit) {
            $teachingUnit->delete();
            return redirect('dashboard.teaching-units')->withSuccess('Teaching unit has been deleted.');
        }]);
    });
    Route::get('teaching-units/{teachingUnit}/study-materials', function () {
        return view('dashboard.studyMaterials');
    });
    Route::get('teaching-units/{teachingUnit}/study-materials/{studyMaterial}', function () {
        return view('dashboard.studyMaterials');
    });
    Route::get('teaching-units/{teachingUnit}/sources', function () {
        return view('dashboard.studyMaterials');
    });
    Route::get('teaching-units/{teachingUnit}/sources/{source}', function () {
        return view('dashboard.studyMaterials');
    });
});
