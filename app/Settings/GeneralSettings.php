<?php

namespace app\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $company_name;

    public static function group(): string
    {
        return 'general';
    }

    //TODO
    //Financial Year Settings
}
