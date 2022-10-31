<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use App\Models\ProjectEnquiry;
use App\Models\Service as QueryService;
use App\Models\Vendor;
use Auth;
use Livewire\Component;

class Create extends Component
{
    // For converting an Enquiry to a Project. Autofill the Details of the Enquiry to make the process easier.
    public $enquiry;

    // Check whether the Project is added via an existing Enquiry form.
    public $fromEnquiry = false;

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

    public function mount($enquiry = null)
    {
        if (!is_null($enquiry)) {
            $this->enquiry = ProjectEnquiry::findOrFail($enquiry);

            $this->name = $this->enquiry->name;
            $this->inward = $this->enquiry->date->format('Y-m-d');
            $this->vendor_id = $this->enquiry->vendor_id;
            $this->building_name = $this->enquiry->building_name;
            $this->city_id = $this->enquiry->city_id;
            $this->area = $this->enquiry->area;
            $this->street = $this->enquiry->street;

            // $this->fromEnquiry = true;
        }

        $this->vendors = Vendor::pluck('name', 'id');
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

        $lastProject = Project::latest()->first();
        $lastCode = preg_replace('~\D~', '', $lastProject ? $lastProject->code : 'DITPJ-000000');
        $code = str_pad($lastCode + 1, 6, "0", STR_PAD_LEFT);
        $newCode = 'DITPJ-' . $code;

        $created = Project::create([
            'name'                  => $this->name,
            'inward'                => $this->inward,
            'code'                  => $newCode,
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
            return redirect()->route('project.index')->with('success', 'Project Added');
        }
    }

    public function render()
    {
        return view('livewire.project.create')->extends('layouts.app');
    }
}
