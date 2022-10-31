<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class MasterController extends BaseController
{

    public function index()
    {
        $this->authorize('modify master data');

        $this->setPageTitle('Master Data', '');
        return view('office.master.index');
    }

    public function location()
    {
        $this->authorize('modify master data');

        $this->setPageTitle('Location Data', '');
        return view('office.master.location');
    }

    public function qualification()
    {
        $this->authorize('modify master data');

        $this->setPageTitle('Qualification Data', '');
        return view('office.master.qualification');
    }

    public function designation()
    {
        $this->authorize('modify master data');

        $this->setPageTitle('Designation Data', '');
        return view('office.master.designation');
    }

    public function industry()
    {
        $this->authorize('modify master data');

        $this->setPageTitle('Industry Data', '');
        return view('office.master.industry');
    }

    public function category()
    {
        $this->authorize('modify master data');

        $this->setPageTitle('Category Data', '');
        return view('office.master.category');
    }

    public function unit()
    {
        $this->authorize('modify master data');

        $this->setPageTitle('Unit Data', '');
        return view('office.master.unit');
    }

    public function badge()
    {
        $this->authorize('modify master data');

        $this->setPageTitle('Status Tags', '');
        return view('office.master.badge');
    }
}
