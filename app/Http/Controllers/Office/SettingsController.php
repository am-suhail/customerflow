<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use app\Settings\GeneralSettings;
use Illuminate\Http\Request;

class SettingsController extends BaseController
{
    public function index()
    {
        $this->authorize('modify app settings');

        $this->setPageTitle('Application Settings', '');
        return view('office.app-settings.index');
    }

    public function update(Request $request, GeneralSettings $general_settings)
    {
        $validated = $request->validate([
            'company_name' => ['required', 'string']
        ]);

        $general_settings->company_name = $validated['company_name'];
        $general_settings->save();

        return $this->responseRedirect('app-settings.general', 'Settings Updated', 'success');
    }
}
