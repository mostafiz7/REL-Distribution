<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   * @return void
   */
  public function register()
  {
    //
  }


  /**
   * Bootstrap any application services.
   * @return void
   */
  public function boot()
  {
    // database default string length
    Schema::defaultStringLength(191);

    // use view-name as class in body element
    View::composer('*', function($view){
      $viewName = str_replace('.', ' ', $view->getName());
      View::share('viewName', $viewName);
    });
  }



}
