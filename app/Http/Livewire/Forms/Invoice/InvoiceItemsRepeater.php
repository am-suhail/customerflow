<?php

namespace App\Http\Livewire\Forms\Invoice;

use Livewire\Component;
use App\Models\Service;

class InvoiceItemsRepeater extends Component
{
    public $key_id;

    public $selectedService;

    public $service_id, $selling_price, $qty = 1, $discount = 0, $total = 0;

    public $service_lists;

    protected $listeners = ['validateServices'];

    public function validateServices()
    {
        $validated = $this->validate([
            'service_id' => 'required|not_in:0',
            'qty' => 'required|not_in:0'
        ]);
    }

    public function mount($key_id, $service = null)
    {
        //Child Key ID for the Array Index
        $this->key_id = $key_id;

        if (!is_null($service) && !empty($service['service_id'])) {
            $this->selectedService = Service::findOrFail($service['service_id']);
            $this->service_id = $this->selectedService->id;
            $this->selling_price = $this->selectedService->selling_price;

            $this->qty = $service['qty'];
            $this->discount = $service['discount'];
            $this->total = $service['total'];
        }

        // Fetched Services
        $this->service_lists = Service::pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.forms.invoice.invoice-items-repeater');
    }

    public function updatedServiceId($id)
    {
        if ($id) {
            $this->selectedService = Service::findOrFail($id);
            $this->service_id = $this->selectedService->id;
            $this->selling_price = $this->selectedService->selling_price;

            $this->qty = 1;
            $this->discount = 0;
            $this->total = $this->selling_price * $this->qty;
            $this->emitUp('serviceAdded', $this->key_id, $this->service_id, $this->qty, $this->discount, $this->total, $this->selling_price);
        }
    }

    public function updatedQty()
    {
        $this->validate(
            [
                'service_id' => ['required', 'not_in:0'],
                'qty'        => ['required', 'numeric', 'not_in:0'],
            ],
            [
                'qty.required'        => 'A Quantity for the specified service is missing',
                'qty.not_in'        => 'Provided quantity is invalid'
            ]
        );
        $this->total = $this->selling_price * $this->qty;
        $this->emitUp('serviceAdded', $this->key_id, $this->service_id, $this->qty, $this->discount, $this->total, $this->selling_price);
    }

    public function updatedDiscount()
    {
        $this->validate(
            [
                'service_id' => ['required', 'not_in:0'],
                'qty'        => ['required', 'numeric', 'not_in:0'],
            ],
            [
                'qty.required'        => 'A Quantity for the specified service is missing',
                'qty.not_in'        => 'Provided quantity is invalid'
            ]
        );
        $this->total = ($this->selling_price * $this->qty) - $this->discount;
        $this->emitUp('serviceAdded', $this->key_id, $this->service_id, $this->qty, $this->discount, $this->total, $this->selling_price);
    }
}
