<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;

class ProjectServices extends Component
{
    /**
     * This array contains an array with a service_id, qty and price for
     * each services for the project.
     */
    public $services = [];
    public $service_lists;

    public function mount($services)
    {
        /**
         * We first check if there are any old values for
         * the form elements we want to render.
         *
         * When a user has submitted a form with values that
         * didn't pass validation, we display those old values.
         */
        $this->services = old('services', $services);
        $this->service_lists = Service::all();
    }

    /**
     * This function will add an empty service field
     * causing an extra row to be rendered.
     */
    public function addService()
    {
        $this->services[] = ['service_id' => '', 'qty' => '', 'price' => ''];
    }

    /**
     * Here we'll remove the item with the given key
     * from the services array, so a rendered row will
     * disappear.
     */
    public function removeService(int $i)
    {
        unset($this->services[$i]);

        $this->services = array_values($this->services);
    }

    public function render()
    {
        return view('livewire.project-services');
    }
}
