<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class TransEntryTypeController extends BaseController
{
    public function index($type)
    {
        $this->setPageTitle($type == 'expense' ? 'Expense Entry Type' : 'Entry Type', '');
        return view('office.entry-type.index', compact('type'));
    }
}
