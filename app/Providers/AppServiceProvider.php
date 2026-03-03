<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::component('layouts.guest', 'guest-layout');
        Blade::component('layouts.app-layout', 'app-layout');
        Blade::component('layouts.breadcrumb', 'breadcrumb');
        Blade::component('layouts.sidebar', 'sidebar');
        Blade::component('layouts.footer', 'footer');

        // Logo Image
        Blade::component('components.badge.logo', 'logo');

        // Register the icon separately
        Blade::component('components.icons.userIcon', 'userIcon');
        Blade::component('components.icons.eyeIcon', 'eyeIcon');
        Blade::component('components.icons.dashboardIcon', 'dashboardIcon');
        Blade::component('components.icons.addIcon', 'addIcon');
        Blade::component('components.icons.sortIcon', 'sortIcon');
        Blade::component('components.icons.prevIcon', 'prevIcon');

        // Label, Input and icon separately
        Blade::component('components.forms.input-with-icon', 'input-with-icon');

        // Buttons
        Blade::component('components.buttons.add-link', 'add-link');
        Blade::component('components.buttons.prev-link', 'prev-link');

        Blade::component('components.forms.input-field', 'input-field');

    }
}
