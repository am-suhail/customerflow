<?php

namespace App\Http\Livewire\Records;

use App\Models\Category;
use Livewire\Component;

class AddCategoryRecord extends Component
{
    public $name;
    public $type;

    public function mount($type)
    {
        $this->type = $type;
    }

    protected $rules = [
        'name' => 'required|string',
    ];

    public function addRecord()
    {
        $this->resetErrorBag('name');
        $this->validate();

        $insert = Category::create([
            'name' => $this->name,
            'type' => $this->type
        ]);

        if ($insert) {
            $this->reset('name');
            $this->emit('refreshLivewireDatatable');
        }
    }

    public function render()
    {
        return view('livewire.records.add-category-record');
    }
}
