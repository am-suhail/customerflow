<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateDashboardSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('dashboard.bar_chart_monthly', false);
        $this->migrator->add('dashboard.bar_chart_yearly', false);
        $this->migrator->add('dashboard.pie_chart_country', false);
        $this->migrator->add('dashboard.pie_chart_state', false);
        $this->migrator->add('dashboard.pie_chart_city', false);
        $this->migrator->add('dashboard.pie_chart_category', false);
        $this->migrator->add('dashboard.pie_chart_sub_category', false);
    }
}
