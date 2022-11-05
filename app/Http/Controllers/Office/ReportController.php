<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class ReportController extends BaseController
{
    public function index()
    {
        $this->setPageTitle('Business Reports', '');
        return view('office.report.index');
    }

    public function summary()
    {
        $this->setPageTitle('Daily Summary', '');
        return view('office.report.summary');
    }

    public function service_summary()
    {
        $this->setPageTitle('Service Summary', '');
        return view('office.report.service-summary');
    }

    public function user_summary()
    {
        $this->setPageTitle('Daily Summary', '');
        return view('office.report.summary');
    }
}
