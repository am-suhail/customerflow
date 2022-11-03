<?php

namespace App\Http\Livewire\Forms\Invoice;

use App\Models\Invoice;
use App\Models\Vendor;
use Livewire\Component;

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
        'serviceAdded'
    ];

    public function serviceAdded($key_id, $service_id, $qty, $discount, $total)
    {
        $this->services[$key_id]['service_id'] = $service_id;
        $this->services[$key_id]['qty'] = $qty;
        $this->services[$key_id]['discount'] = $discount;
        $this->services[$key_id]['total'] = $total;
    }

    public function mount()
    {
        $lastInvoice = Invoice::latest()->first();
        $lastCode = preg_replace('~\D~', '', $lastInvoice ? $lastInvoice->number : '#INV-000000');
        $code = str_pad($lastCode + 1, 6, "0", STR_PAD_LEFT);
        $this->number = '#INV-' . $code;

        $this->vendors = Vendor::pluck('name', 'id');
    }

    /**
     * This function will add an empty service field
     * causing an extra row to be rendered.
     */
    public function addField()
    {
        $this->services[] = ['service_id' => '', 'qty' => '', 'discount' => '', 'total' => ''];
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
        $this->validate(
            [
                'inward'                => ['required', 'date'],
                'vendor_id'             => ['required', 'not_in:0'],
                'referral_no'           => ['required', 'string'],
                'building_name'         => ['required', 'string'],
                'city_id'               => ['required', 'not_in:0'],
                'area'                  => ['nullable', 'string', 'max:45'],
                'street'                => ['nullable', 'string', 'max:45'],
                'remarks'               => ['nullable', 'string', 'max:191'],
                'services.*.service_id' => ['required', 'not_in:0'],
                'services.*.qty'        => ['required', 'numeric'],
                'services.*.price'      => ['required', 'numeric']
            ],
            [
                'service_id.required' => 'Please, specify the service',
                'qty.required' => 'A Quantity for the specified service is missing',
                'price.required' => 'Please Mention price for the specified service'
            ]
        );

        $lastInvoice = Invoice::latest()->first();
        $lastCode = preg_replace('~\D~', '', $lastInvoice ? $lastInvoice->number : '#INV-000000');
        $code = str_pad($lastCode + 1, 6, "0", STR_PAD_LEFT);
        $newNumber = '#INV-' . $code;

        $created = Project::create([
            'number'                => $newNumber,
            'inward'                => $this->inward,
            'vendor_id'             => $this->vendor_id,
            'referral_no'           => $this->referral_no,
            'building_name'         => $this->building_name,
            'city_id'               => $this->city_id,
            'area'                  => $this->area,
            'street'                => $this->street,
            'remarks'               => $this->remarks,
        ]);

        $created->status()->create([
            'badge' => 'active',
            'user_id' => Auth::id(),
            'comment' => 'Initial Status - Project Created'
        ]);

        if (!empty($this->services)) {
            $created->services()->createMany($this->services);
            $created = true;
        }

        if ($this->fromEnquiry) {
            $this->enquiry->status = ProjectEnquiry::ENQUIRY_COMPLETE;
            $this->enquiry->save();
        }

        if ($created) {
            return redirect()->route('invoice.index')->with('success', 'Project Added');
        }
    }

    public function render()
    {
        return view('livewire.forms.invoice.create');
    }
}
