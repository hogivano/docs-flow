<?php

namespace App\Providers;

use App\Http\Controllers\ProcessRoleController as GenProcessRole;
use App\Models\Application;
use App\Models\Process;
use App\Models\ProcessAction;
use App\Models\Role;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function processService()
    {
        //delete process
        Process::saved(function($process) {
            GenProcessRole::generateByProcess($process->id);
        });

        //delete process actions
        Process::deleted(function($process) {
            ProcessAction::where('process_id', $process->id)->delete();
        });
    }

    public function applicationService() {
        Application::deleted(function($app) {
            Process::where('application_id', $app->id)->delete();
            //must delete submmission
        });
    }

    public function processActionService() {
        ProcessAction::deleted(function($process) {
        });
    }

    public function roleService() {
        Role::saved(function($role) {
            GenProcessRole::generateByRole($role->id);
        });
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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->applicationService();
        $this->processService();
        $this->roleService();
    }
}
