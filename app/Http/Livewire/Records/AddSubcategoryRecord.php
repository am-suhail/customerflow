<?php

namespace App\Http\Livewire\Records;

use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Component;

class AddSubcategoryRecord extends Component
{
    public $categories;
    public $category;
    public $name;

    public function mount()
    {
        $this->categories = Category::all();
    }

    protected $rules = [
        'category' => 'required|not_in:0',
        'name' => 'required|string',
    ];

    public function addRecord()
    {
        $this->resetErrorBag(['name', 'category']);
        $this->validate();

        $insert = SubCategory::create([
            "category_id" => $this->category,
            "name" => $this->name
        ]);

        if ($insert) {
            $this->reset(['name', 'category']);
            $this->emit('refreshLivewireDatatable');
        }
    }

    public function resetField()
    {
        $this->resetErrorBag(['name', 'category']);
        $this->reset(['name', 'category']);
    }

    public function refreshRecord()
    {
        $this->resetField();
        $this->mount();
    }

    public function render()
    {
        return view('livewire.records.add-subcategory-record');
    }
}
