<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use App\Models\Service;
use App\Models\Vendor;
use Livewire\Component;

class Edit extends Component
{
    public Project $project;

    // Vendors List
    public $vendors;

    // Initialise an Empty Services Array to add Services to it
    public $services = [];

    // Model Form Variables
    public $name;
    public $inward;
    public $vendor_id;
    public $referral_no;
    public $building_name;
    public $city_id;
    public $area;
    public $street;
    public $remarks;

    protected $listeners = [
        'city',
        'serviceAdded'
    ];

    public function city($city)
    {
        $this->city_id = $city;
    }

    public function mount()
    {

        $this->name = $this->project->name;
        $this->inward = $this->project->inward->format('Y-m-d');
        $this->vendor_id = $this->project->vendor_id;
        $this->referral_no = $this->project->referral_no;
        $this->building_name = $this->project->building_name;
        $this->city_id = $this->project->city_id;
        $this->area = $this->project->area;
        $this->street = $this->project->street;
        $this->remarks = $this->project->remarks;

        $this->vendors = Vendor::pluck('name', 'id');

        // Fetched Services
        $this->service_lists = Service::all();

        if (!is_null($this->project->services())) {
            foreach ($this->project->services as $service) {
                $this->services[] = [
                    'code' => $service->service->code,
                    'service_id' => $service->service_id,
                    'qty' => $service->qty,
                    'price' => $service->price,
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

    public function process()
    {
        $this->validate(
            [
                'name'                  => ['required', 'string', 'max:191'],
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


        $updated = $this->project->update([
            'name'                  => $this->name,
            'inward'                => $this->inward,
            'vendor_id'             => $this->vendor_id,
            'referral_no'           => $this->referral_no,
            'building_name'         => $this->building_name,
            'city_id'               => $this->city_id,
            'area'                  => $this->area,
            'street'                => $this->street,
            'remarks'               => $this->remarks,
        ]);
        $this->project->services()->delete();

        if (!empty($this->services)) {
            $this->project->services()->createMany($this->services);
            $created = true;
        }

        if ($created) {
            return redirect()->route('project.index')->with('success', 'Project Updated');
        }
    }

    public function render()
    {
        return view('livewire.project.edit')->extends('layouts.app');
    }
}
