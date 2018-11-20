<?php

namespace Homicity\MandrillMailable\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class MandrillMessage
 *
 * @package Homicity\MandrillMailable\Facades
 * @see \Mandrill
 */
class MandrillMessage extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'mandrill.message'; }
}