<?php

namespace hanbz\PassportClient\Facades;

use Illuminate\Support\Facades\Facade;
use hanbz\PassportClient\Contracts\Factory;

/**
 * @method static \hanbz\PassportClient\Contracts\Provider driver(string $driver = null)
 * @see \hanbz\PassportClient\SocialiteManager
 */
class PassportClient extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}
