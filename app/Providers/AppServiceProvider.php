<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use App\Models\Kontak;

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
        Paginator::useBootstrapFive();
        View::composer('*', function ($view) {
            
            if (Auth::check() && Auth::user()->hasrole(['super-admin', 'admin'])) {
                
                $unread_messages_count = Kontak::whereNull('read_at')->count();
                
                $view->with('unread_messages_count', $unread_messages_count);
            } else {
                $view->with('unread_messages_count', 0);
            }
        });
    }
}

