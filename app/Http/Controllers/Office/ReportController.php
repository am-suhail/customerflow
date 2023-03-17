<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class ReportController extends BaseController
{
    public function index()
    {
        $this->authorize('view reports');

        $this->setPageTitle('Business Reports', '');
        return view('office.report.index');
    }

    public function country()
    {
        $this->setPageTitle('Country Report', '');
        return view('office.report.country');
    }

    public function category()
    {
        $this->setPageTitle('Category Report', '');
        return view('office.report.category');
    }

    public function company()
    {
        $this->setPageTitle('Company Report', '');
        return view('office.report.company');
    }

    public function branch()
    {
        $this->setPageTitle('Branch Report', '');
        return view('office.report.branch');
    }

    public function bank_summary()
    {
        $this->setPageTitle('Bank & Service Cost Report', '');
        return view('office.report.bank-summary');
    }
}
