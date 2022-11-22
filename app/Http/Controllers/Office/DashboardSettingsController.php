<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use app\Settings\DashboardSettings;
use Illuminate\Http\Request;

class DashboardSettingsController extends BaseController
{
    public function index(DashboardSettings $dashboard_settings)
    {
        $this->authorize('modify app settings');

        $this->setPageTitle('Dashboard Settings', '');
        return view('office.app-settings.dashboard', compact('dashboard_settings'));
    }

    public function update(Request $request, DashboardSettings $dashboard_settings)
    {
        $dashboard_settings->bar_chart_monthly = $request->has('bar_chart_monthly') ? true : false;
        $dashboard_settings->bar_chart_yearly = $request->has('bar_chart_yearly') ? true : false;
        $dashboard_settings->pie_chart_country = $request->has('pie_chart_country') ? true : false;
        $dashboard_settings->pie_chart_state = $request->has('pie_chart_state') ? true : false;
        $dashboard_settings->pie_chart_city = $request->has('pie_chart_city') ? true : false;
        $dashboard_settings->pie_chart_category = $request->has('pie_chart_category') ? true : false;
        $dashboard_settings->pie_chart_sub_category = $request->has('pie_chart_sub_category') ? true : false;
        $dashboard_settings->save();

        return $this->responseRedirect('app-settings.dashboard', 'Dashboard Settings Updated', 'success');
    }
}
