<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\MarketLead;
use App\Models\Project;
use App\Models\Service;
use App\Models\User;
use App\Models\Vendor;

class DashboardController extends Controller
{
    public function index()
    {
        $vendors = Vendor::count();
        $services = Service::count();
        $employees = User::whereProfile('employee')->count();
        $leads = MarketLead::count();
        $projects = Project::count();
        $active = Project::withCurrentStatus('active')->count();
        $pending = Project::withCurrentStatus('pending')->count();
        $ongoing = Project::withCurrentStatus('ongoing')->count();
        $documented = Project::withCurrentStatus('documented')->count();
        $completed = Project::withCurrentStatus('completed')->count();

        return view('office.home.index', compact(
            'vendors',
            'services',
            'employees',
            'leads',
            'projects',
            'active',
            'ongoing',
            'pending',
            'documented',
            'completed'
        ));
    }
}
