<?php

namespace hanbz\PassportClient\Contracts;

interface Factory
{
    /**
     * Get an OAuth provider implementation.
     *
     * @param  string  $driver
     * @return \hanbz\PassportClient\Contracts\Provider
     */
    public function driver($driver = null);
}
