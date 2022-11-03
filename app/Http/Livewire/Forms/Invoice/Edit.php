<?php

namespace App\Http\Livewire\Forms\Invoice;

use App\Models\Invoice;
use App\Models\Vendor;
use App\Traits\FlashMessages;
use Livewire\Component;

class Edit extends Component
{
    use FlashMessages;

    // Vendors List
    public $vendors;

    // Initialise an Empty Services Array to add Services to it
    public $services = [];

    // Initialise an Empty Services Array to add Services to it
    public $invoice;

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

    public function mount($invoice)
    {
        $this->invoice = $invoice;

        $this->vendors = Vendor::pluck('name', 'id');

        $this->number = $invoice->number;
        $this->date = $invoice->date;
        $this->vendor_id = $invoice->vendor_id;

        if (!is_null($invoice->items())) {
            foreach ($invoice->items as $item) {
                $this->services[] = [
                    'service_id' => $item->service_id,
                    'qty' => $item->qty,
                    'discount' => $item->discount,
                    'total' => $item->total,
                    'unit_price' => $item->unit_price,
                ];
            }
        }
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
                'vendor_id'             => ['nullable', 'not_in:0'],
                'date'                  => ['required', 'date'],
                'services.*.service_id' => ['required', 'not_in:0'],
                'services.*.qty'        => ['required', 'numeric'],
            ],
            [
                'service_id.required' => 'Please, specify the service',
                'qty.required' => 'A Quantity for the specified service is missing',
            ]
        );

        $updated = $this->invoice->update([
            'vendor_id'             => $this->vendor_id,
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
            $this->setFlashMessage("Invoice Updated", "success");
            $this->showFlashMessages();

            return redirect()->route('invoice.index');
        }
    }

    public function render()
    {
        return view('livewire.forms.invoice.edit');
    }
}
