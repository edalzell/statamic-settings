<?php

namespace Edalzell\StatamicSettings;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Edalzell\StatamicSettings\StatamicSettings
 */
class StatamicSettingsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'statamic-settings';
    }
}
