<?php

namespace App\Providers;

use App\Models\StatusBadge;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Using closure based composers...
        View::composer('tables.project-actions', function ($view) {
            $view->with('statuses', StatusBadge::pluck('name', 'name'));
        });
    }
}
