<?php

namespace App\View\Composers;


use Illuminate\View\View;
use App\Settings\GeneralSettings;

class GeneralSettingsComposer
{
    /**
     * The general settings.
     *
     * @var \App\Settings\GeneralSettings
     */
    protected $general_settings;

    /**
     * Create a new profile composer.
     *
     * @param  \App\Models\BusinessNature  $natures
     * @return void
     */
    public function __construct(GeneralSettings $general_settings)
    {
        // Dependencies are automatically resolved by the service container...
        $this->general_settings = $general_settings;
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('general_settings', $this->general_settings);
    }
}
