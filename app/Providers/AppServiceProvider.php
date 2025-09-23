<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth; // <-- PERUBAHAN 1: Tambahkan ini
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
        View::composer('*', function ($view) {
            
            // PERUBAHAN 2: Ganti auth() menjadi Auth::
            if (Auth::check() && Auth::user()->hasrole(['super-admin', 'admin'])) {
                
                $unread_messages_count = Kontak::whereNull('read_at')->count();
                
                $view->with('unread_messages_count', $unread_messages_count);
            } else {
                // Opsional: Pastikan variabelnya selalu ada untuk menghindari error di view
                $view->with('unread_messages_count', 0);
            }
        });
    }
}

