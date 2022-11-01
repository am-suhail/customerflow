<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
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

        return view('office.home.index', compact(
            'vendors',
            'services',
            'employees',
        ));
    }
}
