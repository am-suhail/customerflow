<?php

namespace App\Http\Livewire\Component\Widget\Dashboard;

use App\Models\Company;
use Livewire\Component;

class CompanyProfitData extends Component
{
    public $companies;

    function mount()
    {
        $this->companies = Company::all();
    }

    public function render()
    {
        return view('livewire.component.widget.dashboard.company-profit-data');
    }
}
