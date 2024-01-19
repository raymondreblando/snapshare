<?php

namespace App\Providers;

use App\Models\Snap;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('partials.sidebar', function ($view) {
            $view->with('userTotalFollowers', Auth::user()->totalFollowers());
        });

        View::composer(['partials.notifications', 'partials.nav'], function ($view) {
            $view->with('user', Auth::user());
        });

        Blade::directive('active', function ($routes) {
            return "<?php echo in_array(request()->route()->getName(), $routes) ? 'active' : '' ?>";
        });
    }
}
