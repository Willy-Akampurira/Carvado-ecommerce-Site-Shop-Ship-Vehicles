<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Auth\Notifications\ResetPassword;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        // 🔐 Custom password reset link
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url') . "/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        // 🛡️ Ensure roles and permissions exist (safe for production)
        if (app()->runningInConsole() === false && \Schema::hasTable('roles')) {
            foreach (['admin', 'worker', 'client'] as $role) {
                Role::findOrCreate($role);
            }

            foreach (['view dashboard', 'manage users'] as $permission) {
                Permission::findOrCreate($permission);
            }
        }

        // 🎯 Custom Blade directives for role checks
        Blade::if('admin', fn () => auth()->check() && auth()->user()->hasRole('admin'));
        Blade::if('worker', fn () => auth()->check() && auth()->user()->hasRole('worker'));
        Blade::if('client', fn () => auth()->check() && auth()->user()->hasRole('client'));
    }
}
