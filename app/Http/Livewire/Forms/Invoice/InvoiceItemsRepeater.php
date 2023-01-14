<?php

namespace App\Http\Livewire\Forms\Invoice;

use App\Models\Category;
use Livewire\Component;
use App\Models\Service;
use App\Models\SubCategory;

class InvoiceItemsRepeater extends Component
{
    public $key_id;

    public $selectedSubcategory;

    public
        $sub_category_id,
        $selling_price,
        $qty = 1,
        $discount = 0,
        $tax = 1,
        $non_trade_revenue = 0,
        $additional_charge = 0,
        $custom_price = NULL,
        $total = 0;

    public $subcategory_lists;

    protected $listeners = ['validateSubCategory'];

    public function validateSubCategory()
    {
        $validated = $this->validate([
            'sub_category_id' => 'required|not_in:0',
        ]);
    }

    public function mount($key_id, $subcategory = null)
    {
        //Child Key ID for the Array Index
        $this->key_id = $key_id;

        if (!is_null($subcategory) && !empty($subcategory['sub_category_id'])) {
            $this->selectedSubcategory = SubCategory::findOrFail($subcategory['sub_category_id']);
            $this->sub_category_id = $this->selectedSubcategory->id;

            $this->selling_price = $subcategory['unit_price'];
            $this->qty = $subcategory['qty'];
            $this->discount = $subcategory['discount'];
            $this->additional_charge = $subcategory['additional_charge'];
            $this->non_trade_revenue = $subcategory['non_trade_revenue'];
            $this->tax = $subcategory['tax'];
            $this->total = $subcategory['total'];
        }

        // Fetched SubCategory
        $this->subcategory_lists = SubCategory::whereHas('category', fn ($q) => $q->where('type', Category::TYPE_PRODUCT))
            ->pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.forms.invoice.invoice-items-repeater');
    }

    public function updatedSubCategoryId($id)
    {
        if ($id) {
            $this->selectedSubcategory = SubCategory::findOrFail($id);
            $this->sub_category_id = $this->selectedSubcategory->id;

            $this->qty = 1;
            $this->discount = 0;
            $this->calcAndEmitUp();
        }
    }

    public function updatedSellingPrice()
    {
        $this->validate(
            [
                'sub_category_id'       => ['required', 'not_in:0'],
                'selling_price'    => ['required', 'numeric', 'not_in:0'],
            ]
        );
        $this->calcAndEmitUp();
    }

    public function updatedAdditionalCharge()
    {
        $this->validate(
            [
                'sub_category_id'       => ['required', 'not_in:0'],
                'selling_price'    => ['required', 'numeric', 'not_in:0'],
                'additional_charge'    => ['required', 'numeric'],
            ]
        );
        $this->calcAndEmitUp();
    }

    public function updatedNonTradeRevenue()
    {
        $this->validate(
            [
                'sub_category_id'       => ['required', 'not_in:0'],
                'selling_price'    => ['required', 'numeric', 'not_in:0'],
                'additional_charge'    => ['required', 'numeric'],
                'non_trade_revenue'    => ['required', 'numeric'],
            ]
        );
        $this->calcAndEmitUp();
    }

    public function updatedTax()
    {
        $this->validate(
            [
                'sub_category_id'       => ['required', 'not_in:0'],
                'selling_price'    => ['required', 'numeric', 'not_in:0'],
                'additional_charge'    => ['required', 'numeric'],
                'non_trade_revenue'    => ['required', 'numeric'],
            ]
        );
        $this->calcAndEmitUp();
    }

    private function calcAndEmitUp()
    {
        $this->total = (($this->selling_price * $this->qty) - $this->discount) + ($this->additional_charge ?? 0) + ($this->non_trade_revenue ?? 0);
        $this->emitUp('serviceAdded', $this->key_id, $this->sub_category_id, $this->qty, $this->discount, $this->additional_charge, $this->total, $this->selling_price, $this->tax, $this->non_trade_revenue);
    }
}
