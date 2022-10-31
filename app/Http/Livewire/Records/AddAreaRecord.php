<?php

namespace App\Http\Livewire\Records;

use App\Models\Area;
use App\Models\City;
use Livewire\Component;

class AddAreaRecord extends Component
{
    public $cities;
    public $city;
    public $name;

    public function mount()
    {
        $this->cities = City::all();
    }

    protected $rules = [
        'city' => 'required|not_in:0',
        'name' => 'required|string',
    ];

    public function addRecord()
    {
        $this->resetErrorBag('name', 'city');
        $this->validate();

        $insert = Area::create([
            "city_id" => $this->city,
            "name" => $this->name
        ]);

        if ($insert) {
            $this->reset('name', 'city');
            $this->emit('refreshLivewireDatatable');
        }
    }

    public function resetField()
    {
        $this->resetErrorBag('name', 'city');
        $this->reset('name', 'city');
    }

    public function refreshRecord()
    {
        $this->resetField();
        $this->mount();
    }

    public function render()
    {
        return view('livewire.records.add-area-record');
    }
}
