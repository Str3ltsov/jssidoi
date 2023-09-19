<?php

namespace App\Providers;

use App\Models\JssiMenu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $papersMenu = JssiMenu::find(1);
            $view->with('papersMenuLinks', $papersMenu->menuLinks()->where('visible', true)->orderBy('queue', 'ASC')->get());
            $mainMenu = JssiMenu::find(2);
            $view->with('mainMenuLinks', $mainMenu->menuLinks()->where('visible', true)->orderBy('queue', 'ASC')->get());
        });

    }
}
