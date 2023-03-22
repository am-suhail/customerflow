<?php

namespace App\Http\Livewire\Records;

use App\Models\TaxOption;
use Livewire\Component;

class AddTaxRecord extends Component
{
    public $name, $value;

    protected $rules = [
        'value' => 'required|numeric',
        'name' => 'required|string',
    ];

    public function addRecord()
    {
        $this->resetErrorBag(['name', 'value']);
        $this->validate();

        $insert = TaxOption::create([
            "name" => $this->name,
            "value" => $this->value,
        ]);

        if ($insert) {
            $this->reset(['name', 'value']);
            $this->emit('refreshLivewireDatatable');
        }
    }

    public function resetField()
    {
        $this->resetErrorBag(['name', 'value']);
        $this->reset(['name', 'value']);
    }

    public function render()
    {
        return view('livewire.records.add-tax-record');
    }
}
