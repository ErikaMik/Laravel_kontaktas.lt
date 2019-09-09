<?php

namespace App\Providers;

use App\Message;
use App\User;
use Illuminate\Support\Facades\Auth;
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
        view()->composer('pages.menu.categories', function($view){

            //get all parent categories with their subcategories
            $categories = \App\Category::parents()->active()->get();
            //attach the categories to the view.
            $view->with(compact('categories'));
        });

        view()->composer('layouts.app', function($view){
            $user = Auth::user();
            //dd($user);
            if($user){
                $messages = Message::active()->unread()->where('receiver_id', auth()->id())->count();
            }
            //dd($messages);
            //get all parent categories with their subcategories
            $categories = \App\Category::parents()->active()->get();
            //attach the categories to the view.
            $view->with(compact('categories', 'messages'));
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
