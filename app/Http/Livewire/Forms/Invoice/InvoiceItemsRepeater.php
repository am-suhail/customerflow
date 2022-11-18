<?php

namespace App\Http\Livewire\Forms\Invoice;

use Livewire\Component;
use App\Models\Service;

class InvoiceItemsRepeater extends Component
{
    public $key_id;

    public $selectedService;

    public
        $service_id,
        $selling_price,
        $qty = 1,
        $discount = 0,
        $additional_charge = 0,
        $custom_price = NULL,
        $total = 0;

    public $service_lists;

    protected $listeners = ['validateServices'];

    public function validateServices()
    {
        $validated = $this->validate([
            'service_id' => 'required|not_in:0',
        ]);
    }

    public function mount($key_id, $service = null)
    {
        //Child Key ID for the Array Index
        $this->key_id = $key_id;

        if (!is_null($service) && !empty($service['service_id'])) {
            $this->selectedService = Service::findOrFail($service['service_id']);
            $this->service_id = $this->selectedService->id;

            $this->selling_price = $service['unit_price'];
            $this->qty = $service['qty'];
            $this->discount = $service['discount'];
            $this->additional_charge = $service['additional_charge'];
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
            $this->calcAndEmitUp();
        }
    }

    public function updatedSellingPrice()
    {
        $this->validate(
            [
                'service_id'       => ['required', 'not_in:0'],
                'selling_price'    => ['required', 'numeric', 'not_in:0'],
                'qty'              => ['required', 'numeric', 'not_in:0'],
            ],
            [
                'qty.required'     => 'A Quantity for the specified service is missing',
                'qty.not_in'       => 'Provided quantity is invalid'
            ]
        );
        $this->calcAndEmitUp();
    }

    public function updatedQty()
    {
        $this->validate(
            [
                'service_id' => ['required', 'not_in:0'],
                'selling_price'    => ['required', 'numeric', 'not_in:0'],
                'qty'        => ['required', 'numeric', 'not_in:0'],
            ],
            [
                'qty.required'        => 'A Quantity for the specified service is missing',
                'qty.not_in'        => 'Provided quantity is invalid'
            ]
        );
        $this->calcAndEmitUp();
    }

    public function updatedDiscount()
    {
        $this->validate(
            [
                'service_id' => ['required', 'not_in:0'],
                'selling_price'    => ['required', 'numeric', 'not_in:0'],
                'discount'   => ['required', 'numeric', 'lt:selling_price'],
                'qty'        => ['required', 'numeric', 'not_in:0'],
            ],
            [
                'qty.required'        => 'A Quantity for the specified service is missing',
                'qty.not_in'        => 'Provided quantity is invalid'
            ]
        );
        $this->calcAndEmitUp();
    }

    public function updatedAdditionalCharge()
    {
        $this->validate(
            [
                'service_id'          => ['required', 'not_in:0'],
                'selling_price'    => ['required', 'numeric', 'not_in:0'],
                'qty'                 => ['required', 'numeric', 'not_in:0'],
            ],
            [
                'qty.required'        => 'A Quantity for the specified service is missing',
                'qty.not_in'        => 'Provided quantity is invalid'
            ]
        );
        $this->calcAndEmitUp();
    }

    private function calcAndEmitUp()
    {
        $this->total = (($this->selling_price * $this->qty) - $this->discount) + ($this->additional_charge ?? 0);
        $this->emitUp('serviceAdded', $this->key_id, $this->service_id, $this->qty, $this->discount, $this->additional_charge, $this->total, $this->selling_price);
    }
}
