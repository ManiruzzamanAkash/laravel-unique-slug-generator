<?php

namespace Akash\LaravelUniqueSlug\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Akash\LaravelUniqueSlug\UniqueSlug
 */
class UniqueSlug extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-unique-slug';
    }
}
