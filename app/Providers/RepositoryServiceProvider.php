<?php

namespace App\Providers;

use App\Repositories\CategoryRepo\CategoryRepo;
use App\Repositories\CategoryRepo\ICategoryRepo;
use App\Repositories\TaskRepo\ITaskRepo;
use App\Repositories\TaskRepo\TaskRepo;
use App\Repositories\UserRepo\IUserRepo;
use App\Repositories\UserRepo\UserRepo;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ITaskRepo::class, TaskRepo::class);
        $this->app->bind(ICategoryRepo::class, CategoryRepo::class);
        $this->app->bind(IUserRepo::class, UserRepo::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
