<?php

namespace App\Http\Livewire\Forms\Invoice;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\Vendor;
use Livewire\Component;

class Edit extends Component
{

    // branches List
    public $companies;
    public $branches;

    // Initialise an Empty Services Array to add Services to it
    public $services = [];

    // Initialise an Empty Services Array to add Services to it
    public $invoice;

    // Model Form Variables
    public $number;
    public $company_id;
    public $branch_id;
    public $date;
    public $total_discount = 0;
    public $total_tax = 0;
    public $total_amount = 0;

    protected $listeners = [
        'serviceAdded'
    ];

    public function serviceAdded($key_id, $sub_category_id, $tax_option_id, $qty, $discount, $additional_charge, $total, $unit_price, $tax, $non_trade_revenue)
    {
        $this->services[$key_id]['sub_category_id'] = $sub_category_id;
        $this->services[$key_id]['qty'] = $qty;
        $this->services[$key_id]['discount'] = $discount;
        $this->services[$key_id]['non_trade_revenue'] = $non_trade_revenue;
        $this->services[$key_id]['additional_charge'] = $additional_charge;
        $this->services[$key_id]['total'] = $total;
        $this->services[$key_id]['unit_price'] = $unit_price;
        $this->services[$key_id]['tax'] = $tax;
        $this->services[$key_id]['tax_option_id'] = $tax_option_id;
    }

    public function mount($invoice)
    {
        $this->invoice = $invoice;

        $this->branches = Branch::pluck('name', 'id');
        $this->companies = Company::pluck('name', 'id');

        $this->number = $invoice->number;
        $this->date = $invoice->date;
        $this->company_id = $invoice->branch->company_id;
        $this->branch_id = $invoice->branch_id;

        if (!is_null($invoice->items())) {
            foreach ($invoice->items as $item) {
                $this->services[] = [
                    'sub_category_id' => $item->sub_category_id,
                    'qty' => $item->qty,
                    'discount' => $item->discount,
                    'non_trade_revenue' => $item->non_trade_revenue,
                    'additional_charge' => $item->additional_charge,
                    'total' => $item->total,
                    'unit_price' => $item->unit_price,
                    'tax' => $item->tax,
                    'tax_option_id' => $item->tax_option_id,
                ];
            }
        }
    }

    public function updatedCompanyId($company)
    {
        if (!is_null($company)) {
            $this->branches = Branch::where('company_id', $company)
                ->get()
                ->pluck('name', 'id');
        }
    }

    /**
     * This function will add an empty service field
     * causing an extra row to be rendered.
     */
    public function addField()
    {
        $this->services[] = [
            'sub_category_id' => '',
            'qty' => '',
            'discount' => '',
            'additional_charge' => '',
            'total' => '',
            'unit_price' => '',
            'tax' => '',
            'tax_option_id' => '',
        ];
    }

    /**
     * Here we'll remove the item with the given key
     * from the services array, so a rendered row will
     * disappear.
     */
    public function removeField($i)
    {
        unset($this->services[$i]);
    }

    public function process()
    {
        $this->emit('validateSubCategory');

        $this->validate(
            [
                'branch_id'             => ['nullable', 'not_in:0'],
                'date'                  => ['required', 'date'],
                'services.*.sub_category_id' => ['required', 'not_in:0'],
                'services.*.qty'        => ['required', 'numeric'],
            ],
            [
                'sub_category_id.required' => 'Please, specify the service',
                'qty.required' => 'A Quantity for the specified service is missing',
            ]
        );

        $updated = $this->invoice->update([
            'branch_id'             => $this->branch_id,
            'date'                  => $this->date,
            'total_discount'        => 0,
            'total_tax'             => 0,
            'total_amount'          => collect($this->services)->sum('total'),
        ]);

        $this->invoice->items()->delete();

        if (!empty($this->services)) {
            $this->invoice->items()->createMany($this->services);
            $updated = true;
        }

        if ($updated) {
            session()->flash('message', 'Revenue Updated');

            return redirect()->route('revenue.index');
        }
    }

    public function render()
    {
        return view('livewire.forms.invoice.edit');
    }
}
