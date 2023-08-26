<?php

namespace App\Http\Livewire\Forms\Invoice;

use App\Models\Category;
use App\Models\RevenueType;
use Livewire\Component;
use App\Models\Service;
use App\Models\SubCategory;
use App\Models\TaxOption;

class InvoiceItemsRepeater extends Component
{
    public $key_id;

    public $selectedSubcategory;
    public $selectedRevenueType;

    public
        $sub_category_id,
        $revenue_type_id,
        $tax_option_id,
        $selling_price,
        $qty = 1,
        $discount = 0,
        $tax = 0,
        $tax_percentage = 0,
        $custom_price = NULL,
        $total = 0;

    public $subcategory_lists;
    public $revenuetype_lists;
    public $taxoption_lists;

    protected $listeners = ['validateSubCategory'];

    public function validateSubCategory()
    {
        $validated = $this->validate([
            'sub_category_id' => 'required|not_in:0',
            'revenue_type_id' => 'required|not_in:0',
        ]);
    }

    public function mount($key_id, $subcategory = null)
    {
        //Child Key ID for the Array Index
        $this->key_id = $key_id;

        if (!is_null($subcategory) && !empty($subcategory['sub_category_id'])) {
            $this->selectedSubcategory = SubCategory::find($subcategory['sub_category_id']) ?? null;
            $this->sub_category_id = $this->selectedSubcategory->id ?? null;

            $this->selectedRevenueType = RevenueType::find($subcategory['revenue_type_id']) ?? null;
            $this->revenue_type_id = $this->selectedRevenueType->id ?? null;

            $this->selling_price = $subcategory['unit_price'];
            $this->qty = $subcategory['qty'];
            $this->tax_option_id = $subcategory['tax_option_id'] ?? null;
            $this->discount = $subcategory['discount'];
            $this->tax = $subcategory['tax'];
            $this->total = $subcategory['total'];
        }

        // Fetched SubCategory
        $this->subcategory_lists = SubCategory::whereHas('category', fn ($q) => $q->where('type', Category::TYPE_PRODUCT))
            ->pluck('name', 'id');

        // Fetched RevenueType Options
        $this->revenuetype_lists = RevenueType::pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.forms.invoice.invoice-items-repeater');
    }

    public function updatedRevenueTypeId($revenue_type_id)
    {
        if (!is_null($revenue_type_id)) {
            // Fetched SubCategory
            $this->subcategory_lists = SubCategory::where('revenue_type_id', $revenue_type_id)
                ->pluck('name', 'id');
        }
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
                'revenue_type_id'       => ['required', 'not_in:0'],
                'selling_price'         => ['required', 'numeric', 'not_in:0'],
            ]
        );
        $this->calcAndEmitUp();
    }

    public function updatedDiscount()
    {
        $this->validate(
            [
                'sub_category_id'       => ['required', 'not_in:0'],
                'revenue_type_id'       => ['required', 'not_in:0'],
                'selling_price'    => ['required', 'numeric', 'not_in:0'],
                'discount'    => ['required', 'numeric']
            ]
        );
        $this->tax_percentage = round(($this->discount / $this->selling_price) * 100, 2);
        $this->calcAndEmitUp();
    }

    public function updatedTax()
    {
        $this->validate(
            [
                'sub_category_id'       => ['required', 'not_in:0'],
                'revenue_type_id'       => ['required', 'not_in:0'],
                'selling_price'    => ['required', 'numeric', 'not_in:0']
            ]
        );
        $this->calcAndEmitUp();
    }

    private function calcAndEmitUp()
    {
        $this->total = (($this->selling_price * $this->qty) + $this->discount);
        $this->emitUp('serviceAdded', $this->key_id, $this->sub_category_id, $this->revenue_type_id, $this->tax_option_id, $this->qty, $this->discount, $this->total, $this->selling_price, $this->tax);
    }
}
