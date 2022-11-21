<?php

namespace App\Http\Livewire\Records;

use App\Models\Country;
use App\Models\State;
use Livewire\Component;

class AddStateRecord extends Component
{
    public $countries;
    public $country;
    public $name;

    public function mount()
    {
        $this->countries = Country::all();
    }

    protected $rules = [
        'country' => 'required|not_in:0',
        'name' => 'required|string',
    ];

    public function addRecord()
    {
        $this->resetErrorBag('name', 'country');
        $this->validate();

        $insert = State::create([
            "country_id" => $this->country,
            "name" => $this->name
        ]);

        if ($insert) {
            $this->reset('name', 'country');
            $this->emit('refreshLivewireDatatable');
        }
    }

    public function resetField()
    {
        $this->resetErrorBag('name', 'country');
        $this->reset('name', 'country');
    }

    public function refreshRecord()
    {
        $this->resetField();
        $this->mount();
    }

    public function render()
    {
        return view('livewire.records.add-state-record');
    }
}
