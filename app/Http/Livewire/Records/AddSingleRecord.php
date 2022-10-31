<?php

namespace App\Http\Livewire\Records;

use Livewire\Component;

class AddSingleRecord extends Component
{
    public $name;
    public $model;
    public $recordLabel;

    public function mount($model)
    {
        $this->model = $model;
    }

    protected $rules = [
        'name' => 'required|string',
    ];

    public function addRecord()
    {
        $this->resetErrorBag('name');
        $this->validate();

        $insert = $this->model::create([
            "name" => $this->name
        ]);

        if ($insert) {
            $this->reset('name');
            $this->emit('refreshLivewireDatatable');
        }
    }

    public function resetField()
    {
        $this->resetErrorBag('name');
        $this->reset('name');
    }

    public function render()
    {
        return view('livewire.records.add-single-record');
    }
}
