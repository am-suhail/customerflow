<?php

namespace App\Http\Livewire\Forms\Invoice;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\Vendor;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Arr;

class Create extends Component
{
    // Company & Branches List
    public $companies;
    public $branches;

    // Initialise an Empty Services Array to add Services to it
    public $services = [];

    // Model Form Variables
    public $number;
    public $company_id;
    public $branch_id;
    public $date;
    public $total_discount = 0;
    public $total_tax = 0;
    public $total_amount = 0;

    protected $listeners = [
        'branchAdded',
        'serviceAdded'
    ];

    public function branchAdded($branch_id, $branch_name)
    {
        $this->branches = Arr::add($this->branches, $branch_id, $branch_name);
        $this->branch_id = $branch_id;
    }

    public function serviceAdded($key_id, $sub_category_id, $qty, $discount, $additional_charge, $total, $unit_price, $tax, $non_trade_revenue)
    {
        $this->services[$key_id]['sub_category_id'] = $sub_category_id;
        $this->services[$key_id]['qty'] = $qty;
        $this->services[$key_id]['discount'] = $discount;
        $this->services[$key_id]['non_trade_revenue'] = $non_trade_revenue;
        $this->services[$key_id]['additional_charge'] = $additional_charge;
        $this->services[$key_id]['total'] = $total;
        $this->services[$key_id]['unit_price'] = $unit_price;
        $this->services[$key_id]['tax'] = $tax;
    }

    public function mount()
    {
        $lastInvoice = Invoice::latest()->first();
        $lastCode = preg_replace('~\D~', '', $lastInvoice ? $lastInvoice->number : '#INV-000000');
        $code = str_pad($lastCode + 1, 6, "0", STR_PAD_LEFT);
        $this->number = '#INV-' . $code;

        // $this->date = today();
        $this->branches = [];
        $this->companies = Company::pluck('name', 'id');
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
            'non_trade_revenue' => ''
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
                'branch_id'             => ['required', 'not_in:0'],
                'date'                  => ['required', 'date'],
                'services.*.sub_category_id' => ['required', 'not_in:0'],
                'services.*.qty'        => ['required', 'numeric'],
            ],
            [
                'sub_category_id.required' => 'Please, specify the service',
                'qty.required' => 'A Quantity for the specified service is missing',
            ]
        );

        $lastInvoice = Invoice::latest()->first();
        $lastCode = preg_replace('~\D~', '', $lastInvoice ? $lastInvoice->number : '#INV-000000');
        $code = str_pad($lastCode + 1, 6, "0", STR_PAD_LEFT);
        $newNumber = '#INV-' . $code;

        $created = Invoice::create([
            'number'                => $newNumber,
            'branch_id'             => empty($this->branch_id) ? NULL : $this->branch_id,
            'date'                  => $this->date,
            'total_discount'        => collect($this->services)->sum('discount'),
            'total_tax'             => 0,
            'total_amount'          => collect($this->services)->sum('total'),
        ]);

        if (!empty($this->services)) {
            $created->items()->createMany($this->services);
            $created = true;
        }

        if ($created) {
            session()->flash('message', 'Revenue Created');

            return redirect()->route('revenue.index');
        }
    }

    public function render()
    {
        return view('livewire.forms.invoice.create');
    }
}
