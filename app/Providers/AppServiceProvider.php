<?php

namespace App\Providers;


use App\Models\Setting;
use App\Models\ShopCategories;

use Filament\Facades\Filament;

use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\View;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
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
        $setting = Setting::first();
        $shopCategories = ShopCategories::where('sub',0)->get();
        View::share("_setting",$setting);
        View::share("_shopCategories",$shopCategories);
        View::share('defaultUser', 'https://res.cloudinary.com/atenad/image/upload/v1663920932/user.webp');
        Password::defaults(function () {
            return Password::min(8)->letters()->numbers()->symbols()->uncompromised();
        });
        Filament::serving(function () {
            Filament::registerTheme(
                app(Vite::class)('resources/css/filament.css'),
            );
        });
    }
}
