<?php

namespace App\Http\Livewire\Project;

use Livewire\Component;
use App\Models\Service;

class ProductInput extends Component
{
    public $key_id;

    public $code, $service_id, $selling_price, $qty = 0, $price = 0;

    public $service_codes, $service_lists;

    public function mount($key_id, $service = null)
    {
        //Child Key ID for the Array Index
        $this->key_id = $key_id;

        if (!is_null($service) && !empty($service['service_id'])) {
            $this->selectedService = Service::findOrFail($service['service_id']);
            $this->code = $this->selectedService->code;
            $this->service_id = $this->selectedService->id;
            $this->selling_price = $this->selectedService->selling_price;

            $this->qty = $service['qty'];
            $this->price = $service['price'];
        }

        // Fetched Services
        $this->service_codes = Service::pluck('code', 'code');
        $this->service_lists = Service::pluck('name', 'id');
    }

    public function processTest()
    {
        $this->validate(
            [
                'service_id' => ['required', 'not_in:0'],
                'qty'        => ['required', 'numeric'],
                'selling_price' => ['nullable', 'numeric'],
                'price'      => ['required', 'numeric']
            ],
            [
                'service_id.required' => 'Please, specify the service',
                'qty.required' => 'A Quantity for the specified service is missing',
                'price.required' => 'Please Mention price for the specified service'
            ]
        );
    }

    public function render()
    {
        return view('livewire.project.product-input');
    }

    public function updatedCode($code)
    {
        if ($code) {
            $this->selectedService = Service::whereCode($code)->first();
            $this->service_id = $this->selectedService->id;
            $this->selling_price = $this->selectedService->selling_price;

            $this->qty = 0;
            $this->price = 0;
        }
    }

    public function updatedServiceId($id)
    {
        if ($id) {
            $this->selectedService = Service::findOrFail($id);
            $this->code = $this->selectedService->code;
            $this->service_id = $this->selectedService->id;
            $this->selling_price = $this->selectedService->selling_price;

            $this->qty = 0;
            $this->price = 0;
        }
    }

    public function updatedQty()
    {
        $this->validate(
            [
                'qty'        => ['required', 'numeric', 'not_in:0'],
                'selling_price' => ['required', 'numeric']
            ],
            [
                'selling_price.required' => 'Please Mention price for the specified service',
                'qty.required'        => 'A Quantity for the specified service is missing',
                'qty.not_in'        => 'Provided quantity is invalid'
            ]
        );
        $this->price = $this->selling_price * $this->qty;
        $this->emitUp('serviceAdded', $this->key_id, $this->service_id, $this->qty, $this->price);
    }
}
