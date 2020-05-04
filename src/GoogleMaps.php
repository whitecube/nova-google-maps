<?php

namespace Whitecube\NovaGoogleMaps;

use Laravel\Nova\Fields\Field;

class GoogleMaps extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-google-maps';

    /**
     * Set the map's default coordinates
     *
     * @param float|string $lat
     * @param float|string $lng
     * @return $this
     */
    public function defaultCoordinates($lat, $lng)
    {
        return $this->withMeta(['defaultCoordinates' => [
            'lat' => $lat,
            'lng' => $lng
        ]]);
    }

    /**
     * Set the map's zoom level
     *
     * @param int $level
     * @return $this
     */
    public function zoom($level = 15)
    {
        return $this->withMeta(['zoom' => $level]);
    }
}
