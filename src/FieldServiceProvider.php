<?php

namespace Whitecube\NovaGoogleMaps;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-google-maps_googlemaps', $this->gmapsScript());
            Nova::script('nova-google-maps', __DIR__.'/../dist/js/field.js');
            Nova::style('nova-google-maps', __DIR__.'/../dist/css/field.css');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/nova-google-maps.php', 'nova-google-maps');
    }

    protected function gmapsScript()
    {
        return vsprintf(
            'https://maps.googleapis.com/maps/api/js?key=%s&language=%s',
            [
                config('nova-google-maps.api_key'),
                config('nova-google-maps.language'),
            ]
        );
    }
}
