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

    public function location($type = 'state')
    {
        $this->authorize('modify master data');

        $this->setPageTitle($type == 'state' ? 'States' : 'Cities', '');
        return view('office.master.location', compact('type'));
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

    public function category($type = 'main')
    {
        $this->authorize('modify master data');

        $this->setPageTitle($type == 'main' ? 'Category Data' : 'Sub Category Data', '');
        return view('office.master.category', compact('type'));
    }

    public function company_category($type = 'main')
    {
        $this->authorize('modify master data');

        $this->setPageTitle($type == 'main' ? 'Company Category Data' : 'Company Sub Category Data', '');
        return view('office.master.company-category', compact('type'));
    }
}
