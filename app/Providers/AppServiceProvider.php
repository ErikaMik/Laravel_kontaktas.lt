<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('layouts.app', function($view){
            //get all parent categories with their subcategories
            $category = \App\Category::where('parent_id', 2)->get();
            //dd($category);
            //attach the categories to the view.
            $view->with(compact('category'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }


}
