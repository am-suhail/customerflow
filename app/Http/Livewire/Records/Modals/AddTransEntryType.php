<?php

namespace App\Http\Livewire\Records\Modals;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\TransactionEntryType;
use LivewireUI\Modal\ModalComponent;

class AddTransEntryType extends ModalComponent
{
    public $sub_category_id, $name;

    public $subcategory_lists;

    public function mount()
    {
        $this->subcategory_lists = SubCategory::whereHas('category', fn ($q) => $q->where('type', Category::TYPE_EXPENSE))
            ->pluck('name', 'id');
    }

    public function save()
    {
        $this->validate(
            [
                'sub_category_id' => 'required|not_in:0',
                'name' => 'required|string|unique:transaction_entry_types,name'
            ],
            [
                'sub_category_id.required' => 'This Field is invalid',
                'name.required' => 'This Field cannot be blank'
            ]
        );

        $saved = TransactionEntryType::create([
            'sub_category_id' => $this->sub_category_id,
            'name' => $this->name
        ]);

        if ($saved) {
            $this->emit('transEntryAdded', $saved->id, $this->sub_category_id);
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.records.modals.add-trans-entry-type');
    }

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return '2xl';
    }
}
