# Laravel-unique-slug-generator
A simple but beautiful unique slug generator for Laravel eloquent model.

---

## Installation

```sh
composer require akash/laravel-unique-slug
```

## Use from Controller

#### Import first the UniqueSlug facade
```php
use Akash\LaravelUniqueSlug\Facades\UniqueSlug;
```


```php
UniqueSlug::generate(App\Models\User::class, 'akash', 'name');
// akash

// After creating a new user with name akash, then again hit
UniqueSlug::generate(App\Models\User::class, 'akash', 'name');
// akash-1


// After creating a new user with name akash-1, then again hit
UniqueSlug::generate(App\Models\User::class, 'akash', 'name');
// akash-2
```


#### Publish configuration
```sh
php artisan vendor:publish akash/laravel-unique-slug
```

## Contribution
You're open to create any Pull request.
