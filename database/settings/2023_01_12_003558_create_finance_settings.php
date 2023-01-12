<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateFinanceSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('finance.year_start', 'JAN');
    }
}
