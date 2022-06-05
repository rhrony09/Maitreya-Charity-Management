<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    public $settings;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Paginator::useBootstrap();
        foreach (Setting::get(['type', 'name']) as $setting) {
            $this->settings[$setting->type] = $setting->name;
        }
        $this->settings = json_decode(json_encode($this->settings), false);
        view()->composer('*', function ($view) {
            $view->with([
                'settings' => $this->settings,
                'user' => Auth::user(),
                'contact' => Contact::where('status', 1),
            ]);
        });
    }
}
