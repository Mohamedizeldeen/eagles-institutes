<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        // Share locale data with all views
        View::composer('*', function ($view) {
            $locale = app()->getLocale();
            $view->with('currentLocale', $locale);
            $view->with('isRtl', $locale === 'ar');
            $view->with('dir', $locale === 'ar' ? 'rtl' : 'ltr');
            $view->with('textAlign', $locale === 'ar' ? 'right' : 'left');
        });

        // Custom blade directive for admin-only content
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->isAdmin();
        });

        // Custom blade directive for staff content
        Blade::if('staff', function () {
            return auth()->check() && auth()->user()->isStaff();
        });
    }
}
