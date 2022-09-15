
# PHP InstaFeed

Now you can get data from public profile pages on Instagram without logging in.

## Get started

This repository requires `Composer 2.x` to install. 
You can update it using a simple command in your console: `composer self-update --preview`.
Also, you need to run on `PHP 7.2.x`. 

Composer command to install:


```bash
composer require frmontini/instafeed
```

## How to use

Just follow the example below: 

```php
include('vendor/autoload.php');

$utils = new InstaFeed\Utils();

/* TO GET INSTAGRAM CONTENT */

$username = 'cocacola';
$data = $utils->getData($username);
print_r(json_decode($data));

/* TO CLEAR CACHE */

$username = 'cocacola';
$utils->noCache($username);
```

## About cache

To prevent blocking access to the profile and redirecting to the login page, further calls to fetched profiles will return cached data.
You can clear persisted data from a specific profile using the `noCache` function (see example above).

## License

OSL-3.0
