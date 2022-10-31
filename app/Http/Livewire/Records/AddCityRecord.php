<?php

namespace App\Http\Livewire\Records;

use App\Models\City;
use App\Models\State;
use Livewire\Component;

class AddCityRecord extends Component
{
    public $states;
    public $state;
    public $name;

    public function mount()
    {
        $this->states = State::all();
    }

    protected $rules = [
        'state' => 'required|not_in:0',
        'name' => 'required|string',
    ];

    public function addRecord()
    {
        $this->resetErrorBag('name', 'state');
        $this->validate();

        $insert = City::create([
            "state_id" => $this->state,
            "name" => $this->name
        ]);

        if ($insert) {
            $this->reset('name', 'state');
            $this->emit('refreshLivewireDatatable');
        }
    }

    public function resetField()
    {
        $this->resetErrorBag('name', 'state');
        $this->reset('name', 'state');
    }

    public function refreshRecord()
    {
        $this->resetField();
        $this->mount();
    }

    public function render()
    {
        return view('livewire.records.add-city-record');
    }
}
