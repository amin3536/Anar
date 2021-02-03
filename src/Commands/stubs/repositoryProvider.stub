<?php

namespace App\Providers;

use App;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register RepositoryServiceProvider  .
     * provide your repository and inject it, like in to your controller's app if you want to use it
     * @return void
     */
    public function register()
    {
         $names = [
               //add Begin your repository name here   like -> 'UserRepository',
            ];

            foreach ($names as $name) {
                $this->app->bind(
                    "App\\Repositories\\{$name}Imp",
                    "App\\Repositories\\{$name}");
            }


    }
}
