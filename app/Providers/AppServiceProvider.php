<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

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
     * 
     */
    public function boot()
    {
        error_reporting(E_ALL);

        View::composer('cyborg/partials/header', function($view)
        {
            // Bind data to view
            $view->with(
                'otherLocales',
                Arr::except(
                    Config::get('acceptlanguages')['Accept-Language'] ?? [ ],
                    \Illuminate\Support\Facades\App::getLocale()
                )
            );
        });

        Blade::directive('automath_include', function($args)
        {
            return "<?php echo \$__env->make(\App\Quiz\BladeHelper::AutomathInclude({$args}), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>";
        });
    }
}