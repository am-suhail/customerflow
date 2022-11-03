<?php

namespace App\Http\Livewire\Component\Repeater;

use Livewire\Component;

class InvoiceItems extends Component
{
    public $product_type_id;
    public $selectedProductTypes = [];

    // Component Helpers
    public $error_active = false, $error_msg;

    // Data Feeders
    public $product_types = [];

    // Listeners
    protected $listeners = ['selectedSubCategory'];

    public function selectedSubCategory($subcategory)
    {
        $this->subcategory = $subcategory;
        $this->product_types = ProductType::where('category_id', $subcategory)->get();
        $this->dispatchBrowserEvent('reApplySelect2');
    }

    public function mount($productTypes)
    {
        foreach ($productTypes as $type) {
            $this->selectedProductTypes[] = [$type->id, $type->name, $type->category->name, $type->category->parent->name];
        }
    }

    public function selectProductType()
    {

        $product_type = explode(',', $this->product_type_id);

        if (empty($product_type[0])) {
            $this->error_active = true;
            $this->error_msg = 'Please select a Product Type';

            $this->dispatchBrowserEvent('reApplySelect2');
            return;
        }

        if (in_array($product_type[0], Arr::flatten($this->selectedProductTypes))) {
            $this->error_active = true;
            $this->error_msg = 'Product Type already selected';

            $this->dispatchBrowserEvent('reApplySelect2');
            return;
        }

        $this->reset(['error_active', 'error_msg']);

        $this->selectedProductTypes[] = $product_type;


        $this->dispatchBrowserEvent('reApplySelect2');
    }

    public function removeProductType($i)
    {
        unset($this->selectedProductTypes[$i]);
    }

    public function render()
    {
        return view('livewire.component.repeater.invoice-items');
    }
}
