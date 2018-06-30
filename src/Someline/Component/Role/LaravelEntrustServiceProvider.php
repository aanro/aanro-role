<?php

namespace Someline\Component\Role;


use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;
use Overtrue\LaravelWechat\ServiceProvider;
use Overtrue\Socialite\User as SocialiteUser;
use Zizaco\Entrust\EntrustServiceProvider;

class LaravelEntrustServiceProvider extends EntrustServiceProvider
{

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__ . '/../../../config/entrust.php' => config_path('entrust.php'),
        ]);

        // Register commands
        $this->commands('command.entrust.migration');

        // Register blade directives
        $this->bladeDirectives();
    }

    /**
     * Register the blade directives
     *
     * @return void
     */
    private function bladeDirectives()
    {
        // Call to Entrust::hasRole
        \Blade::directive('role', function ($expression) {
            return "<?php if (\\Entrust::hasRole({$expression})) : ?>";
        });

        \Blade::directive('endrole', function ($expression) {
            return "<?php endif; // Entrust::hasRole ?>";
        });

        // Call to Entrust::can
        \Blade::directive('permission', function ($expression) {
            return "<?php if (\\Entrust::can({$expression})) : ?>";
        });

        \Blade::directive('endpermission', function ($expression) {
            return "<?php endif; // Entrust::can ?>";
        });

        // Call to Entrust::ability
        \Blade::directive('ability', function ($expression) {
            return "<?php if (\\Entrust::ability({$expression})) : ?>";
        });

        \Blade::directive('endability', function ($expression) {
            return "<?php endif; // Entrust::ability ?>";
        });
    }
}