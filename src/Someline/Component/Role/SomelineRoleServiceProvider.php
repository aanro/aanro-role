<?php

namespace Someline\Component\Role;


use Illuminate\Support\ServiceProvider;

class SomelineRoleServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../../database/migrations');
        $this->publishes([
            __DIR__ . '/../../../config/config.php' => config_path('someline-role.php'),

            // master files
            __DIR__ . '/../../../master/Api/SomelineRole.php.dist' => app_path('Models/Role/SomelineRole.php'),
            __DIR__ . '/../../../master/Api/SomelineRoleRepository.php.dist' => app_path('Repositories/Interfaces/SomelineRoleRepository.php'),
            __DIR__ . '/../../../master/Api/SomelineRoleRepositoryEloquent.php.dist' => app_path('Repositories/Eloquent/SomelineRoleRepositoryEloquent.php'),
            __DIR__ . '/../../../master/Api/SomelineRolesController.php.dist' => app_path('Api/Controllers/SomelineRolesController.php'),
            __DIR__ . '/../../../master/Api/SomelineRoleTransformer.php.dist' => app_path('Transformers/SomelineRoleTransformer.php'),
            __DIR__ . '/../../../master/Api/SomelineRoleValidator.php.dist' => app_path('Validators/SomelineRoleValidator.php'),
            __DIR__ . '/../../../master/Http/Console/SomelineRoleController.php.dist' => app_path('Http/Controllers/Console/SomelineRoleController.php'),

            // database
            __DIR__ . '/../../../database/seeds/SomelineRolesTableSeeder.php.dist' => base_path('database/seeds/SomelineRolesTableSeeder.php'),

            // resources folders
            __DIR__ . '/../../../resources/assets/js/console' => resource_path('assets/js/components/console/roles'),
            __DIR__ . '/../../../resources/views/console' => resource_path('views/console/roles'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../../config/config.php',
            'someline-role'
        );
    }
}