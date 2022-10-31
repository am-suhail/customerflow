<?php

namespace App\Http\Livewire\Records;

use App\Models\Area;
use App\Models\Street;
use Livewire\Component;

class AddStreetRecord extends Component
{
    public $areas;
    public $area;
    public $name;

    public function mount()
    {
        $this->areas = Area::all();
    }

    protected $rules = [
        'area' => 'required|not_in:0',
        'name' => 'required|string',
    ];

    public function addRecord()
    {
        $this->resetErrorBag(['name', 'area']);
        $this->validate();

        $insert = Street::create([
            "area_id" => $this->area,
            "name" => $this->name
        ]);

        if ($insert) {
            $this->reset(['name', 'area']);
            $this->emit('refreshLivewireDatatable');
        }
    }

    public function resetField()
    {
        $this->resetErrorBag(['name', 'area']);
        $this->reset(['name', 'area']);
    }

    public function refreshRecord()
    {
        $this->resetField();
        $this->mount();
    }

    public function render()
    {
        return view('livewire.records.add-street-record');
    }
}
