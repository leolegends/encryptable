<?php

namespace Corebiz\ModelEncryptable\Facades;

use Illuminate\Support\Facades\Facade;

class ModelEncryptable extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'modelencryptable';
    }
}
