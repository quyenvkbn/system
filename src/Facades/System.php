<?php

namespace Quyenvkbn\System\Facades;

use Illuminate\Support\Facades\Facade;

class System extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'system';
    }
}
