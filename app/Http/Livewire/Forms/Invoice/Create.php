<?php

namespace App\Http\Livewire\Forms\Invoice;

use App\Models\Invoice;
use App\Models\Vendor;
use App\Traits\FlashMessages;
use Carbon\Carbon;
use Livewire\Component;

class Create extends Component
{
    use FlashMessages;

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

    public function serviceAdded($key_id, $service_id, $qty, $discount, $total, $unit_price)
    {
        $this->services[$key_id]['service_id'] = $service_id;
        $this->services[$key_id]['qty'] = $qty;
        $this->services[$key_id]['discount'] = $discount;
        $this->services[$key_id]['total'] = $total;
        $this->services[$key_id]['unit_price'] = $unit_price;
    }

    public function mount()
    {
        $lastInvoice = Invoice::latest()->first();
        $lastCode = preg_replace('~\D~', '', $lastInvoice ? $lastInvoice->number : '#INV-000000');
        $code = str_pad($lastCode + 1, 6, "0", STR_PAD_LEFT);
        $this->number = '#INV-' . $code;

        $this->date = Carbon::today();
        $this->vendors = Vendor::pluck('name', 'id');
    }

    /**
     * This function will add an empty service field
     * causing an extra row to be rendered.
     */
    public function addField()
    {
        $this->services[] = ['service_id' => '', 'qty' => '', 'discount' => '', 'total' => '', 'unit_price' => ''];
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
        $this->emit('validateServices');

        $this->validate(
            [
                'vendor_id'             => ['required', 'not_in:0'],
                'date'                  => ['required', 'date'],
                'services.*.service_id' => ['required', 'not_in:0'],
                'services.*.qty'        => ['required', 'numeric'],
            ],
            [
                'service_id.required' => 'Please, specify the service',
                'qty.required' => 'A Quantity for the specified service is missing',
            ]
        );

        $lastInvoice = Invoice::latest()->first();
        $lastCode = preg_replace('~\D~', '', $lastInvoice ? $lastInvoice->number : '#INV-000000');
        $code = str_pad($lastCode + 1, 6, "0", STR_PAD_LEFT);
        $newNumber = '#INV-' . $code;

        $created = Invoice::create([
            'number'                => $newNumber,
            'vendor_id'             => $this->vendor_id,
            'date'                  => $this->date,
            'total_discount'        => 0,
            'total_tax'             => 0,
            'total_amount'          => collect($this->services)->sum('total'),
        ]);

        if (!empty($this->services)) {
            $created->items()->createMany($this->services);
            $created = true;
        }

        if ($created) {
            $this->setFlashMessage("Invoice Created", "success");
            $this->showFlashMessages();

            return redirect()->route('invoice.index');
        }
    }

    public function render()
    {
        return view('livewire.forms.invoice.create');
    }
}
