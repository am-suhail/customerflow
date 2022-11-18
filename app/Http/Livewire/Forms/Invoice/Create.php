<?php

namespace App\Http\Livewire\Forms\Invoice;

use App\Models\Invoice;
use App\Models\Vendor;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Arr;

class Create extends Component
{
    // Vendors List
    public $vendors;

    // Initialise an Empty Services Array to add Services to it
    public $services = [];

    // Model Form Variables
    public $number;
    public $vendor_id;
    public $date;
    public $total_discount = 0;
    public $total_tax = 0;
    public $total_amount = 0;

    protected $listeners = [
        'vendorAdded',
        'serviceAdded'
    ];

    public function vendorAdded($vendor_id, $vendor_name)
    {
        $this->vendors = Arr::add($this->vendors, $vendor_id, $vendor_name);
        $this->vendor_id = $vendor_id;
    }

    public function serviceAdded($key_id, $sub_category_id, $qty, $discount, $additional_charge, $total, $unit_price)
    {
        $this->services[$key_id]['sub_category_id'] = $sub_category_id;
        $this->services[$key_id]['qty'] = $qty;
        $this->services[$key_id]['discount'] = $discount;
        $this->services[$key_id]['additional_charge'] = $additional_charge;
        $this->services[$key_id]['total'] = $total;
        $this->services[$key_id]['unit_price'] = $unit_price;
    }

    public function mount()
    {
        $lastInvoice = Invoice::latest()->first();
        $lastCode = preg_replace('~\D~', '', $lastInvoice ? $lastInvoice->number : '#INV-000000');
        $code = str_pad($lastCode + 1, 6, "0", STR_PAD_LEFT);
        $this->number = '#INV-' . $code;

        $this->date = Carbon::today()->format('d-m-Y');
        $this->vendors = Vendor::pluck('company_name', 'id');
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
            'unit_price' => ''
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
                'vendor_id'             => ['nullable', 'not_in:0'],
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
            'vendor_id'             => empty($this->vendor_id) ? NULL : $this->vendor_id,
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
            session()->flash('message', 'Invoice Created');

            return redirect()->route('revenue.index');
        }
    }

    public function render()
    {
        return view('livewire.forms.invoice.create');
    }
}
