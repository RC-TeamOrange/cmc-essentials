<?php
/**
* This file hooks in service providers for the CMC-Essentials web app.
*
*/

namespace CmcEssentials\Providers;
use Illuminate\Contracts\View\Factory as ViewFactory;

use Illuminate\Support\ServiceProvider;

/**
* This class provides two services for the CMC-Essentials web app.
* It provides the MasterComposer class service which is used for sharing the username of the the logged in user amongst al views. 
* It provides the TeachingUnitFormComposer class service which is used for generating helper information for the create teaching unit form.
*/
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(ViewFactory $view)
    {
        //
	$view->composer('dashboard.partials.forms.teachingUnit', 'CmcEssentials\Http\Views\Composers\TeachingUnitFormComposer');
    $view->composer('layouts.master', 'CmcEssentials\Http\Views\Composers\MasterComposer');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
