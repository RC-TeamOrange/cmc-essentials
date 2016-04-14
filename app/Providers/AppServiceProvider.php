<?php

namespace CmcEssentials\Providers;
use Illuminate\Contracts\View\Factory as ViewFactory;

use Illuminate\Support\ServiceProvider;

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
