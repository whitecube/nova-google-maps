# Laravel Nova Google Maps Field

A laravel nova field to easily enter an address (uses the Algolia Places API) and show a preview in a Google Map. The result is stored in a json column and contains all the data sent by Algolia.

![Preview of the nova-google-maps field](https://raw.githubusercontent.com/whitecube/nova-google-maps/master/nova-google-maps-preview.png?token=ACG6ENDBJ4QNIDZT4VOJZZC6WASDA)

## Installation

You can install the package via composer:

```bash
composer require whitecube/nova-google-maps
```

## Usage

``` php
use Whitecube\NovaGoogleMaps\GoogleMaps;

/**
 * Get the fields displayed by the resource.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return array
 */
public function fields(Request $request)
{
    return [
        // ...

        GoogleMaps::make('Map')
            ->zoom(8) // Optionally set the zoom level
            ->defaultCoordinates($lat, $lng) // Optionally set the map's default center point
    ];
}
```

## Configuration
By default, you should reference your Google Maps API key in your `.env` file:

```
NOVA_GOOGLE_MAPS_API_KEY=your-api-key
```

Optionally, you can publish the config to change the API key location and the map's language by doing: `php artisan vendor:publish --tag=nova-google-maps`.

## 💖 Sponsorships

If you are reliant on this package in your production applications, consider [sponsoring us](https://github.com/sponsors/whitecube)! It is the best way to help us keep doing what we love to do: making great open source software.

## Contributing

Feel free to suggest changes, ask for new features or fix bugs yourself. We're sure there are still a lot of improvements that could be made, and we would be very happy to merge useful pull requests.

Thanks!

## Made with ❤️ for open source

At [Whitecube](https://www.whitecube.be) we use a lot of open source software as part of our daily work.
So when we have an opportunity to give something back, we're super excited!

We hope you will enjoy this small contribution from us and would love to [hear from you](mailto:hello@whitecube.be) if you find it useful in your projects. Follow us on [Twitter](https://twitter.com/whitecube_be) for more updates!
