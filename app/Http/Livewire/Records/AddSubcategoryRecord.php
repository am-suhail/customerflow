<?php

namespace App\Http\Livewire\Records;

use App\Models\Category;
use App\Models\RevenueType;
use App\Models\SubCategory;
use Livewire\Component;

class AddSubcategoryRecord extends Component
{
    public $categories;
    public $revenue_types;
    public $category;
    public $revenue_type;
    public $name;

    public function mount($type)
    {
        $this->categories = Category::where('type', $type)
            ->get();

        $this->revenue_types = RevenueType::all();
    }

    protected $rules = [
        'category' => 'required|not_in:0',
        'revenue_type' => 'required|not_in:0',
        'name' => 'required|string',
    ];

    public function addRecord()
    {
        $this->resetErrorBag(['name', 'category']);
        $this->validate();

        $insert = SubCategory::create([
            "category_id" => $this->category,
            "revenue_type_id" => $this->revenue_type,
            "name" => $this->name
        ]);

        if ($insert) {
            $this->reset(['name', 'category', 'revenue_type']);
            $this->emit('refreshLivewireDatatable');
        }
    }

    public function resetField()
    {
        $this->resetErrorBag(['name', 'category', 'revenue_type']);
        $this->reset(['name', 'category', 'revenue_type']);
    }

    public function refreshRecord()
    {
        $this->resetField();
    }

    public function render()
    {
        return view('livewire.records.add-subcategory-record');
    }
}
