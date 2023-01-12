<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use app\Settings\FinanceSettings;
use Illuminate\Http\Request;

class FinanceSettingsController extends BaseController
{
    public function index(FinanceSettings $finance_settings)
    {
        $this->authorize('modify app settings');

        $months = [
            'JAN' => 'January',
            'FEB' => 'February',
            'MAR' => 'March',
            'APR' => 'April',
            'MAY' => 'May',
            'JUN' => 'June',
            'JUL' => 'July',
            'AUG' => 'August',
            'SEP' => 'September',
            'OCT' => 'October',
            'NOV' => 'November',
            'DEC' => 'December',
        ];

        $this->setPageTitle('Finance Settings', '');
        return view('office.app-settings.finance', compact('finance_settings', 'months'));
    }

    public function update(Request $request, FinanceSettings $finance_settings)
    {
        $validated = $request->validate([
            'year_start' => ['required', 'string']
        ]);

        $finance_settings->year_start = $validated['year_start'];
        $finance_settings->save();

        return $this->responseRedirect('app-settings.finance', 'Settings Updated', 'success');
    }
}
