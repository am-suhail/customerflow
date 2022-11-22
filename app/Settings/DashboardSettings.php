<?php

namespace app\Settings;

use Spatie\LaravelSettings\Settings;

class DashboardSettings extends Settings
{
    public bool $bar_chart_monthly;
    public bool $bar_chart_yearly;
    public bool $pie_chart_country;
    public bool $pie_chart_state;
    public bool $pie_chart_city;
    public bool $pie_chart_category;
    public bool $pie_chart_sub_category;

    public static function group(): string
    {
        return 'dashboard';
    }
}
