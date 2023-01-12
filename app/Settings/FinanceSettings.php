<?php

namespace app\Settings;

use Spatie\LaravelSettings\Settings;

class FinanceSettings extends Settings
{
    public string $year_start;

    public static function group(): string
    {
        return 'finance';
    }
}
