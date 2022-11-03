<?php

namespace App\Http\Livewire\Component\Repeater;

use Livewire\Component;

class InvoiceItems extends Component
{
    /**
     * This function will add an empty service field
     * causing an extra row to be rendered.
     */
    public function addField()
    {
        $this->services[] = ['code' => '', 'service_id' => '', 'qty' => '', 'price' => ''];
    }

    public function serviceAdded($key_id, $service_id, $qty, $price)
    {
        $this->services[$key_id]['service_id'] = $service_id;
        $this->services[$key_id]['qty'] = $qty;
        $this->services[$key_id]['price'] = $price;
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

    public function render()
    {
        return view('livewire.component.repeater.invoice-items');
    }
}
