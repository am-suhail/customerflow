<?php

namespace App\Http\Livewire\Forms\Vendor;

use App\Models\Country;
use App\Models\Industry;
use App\Models\Vendor;
use LivewireUI\Modal\ModalComponent;

class AddVendorModal extends ModalComponent
{
    // datas
    public
        $industries,
        $countrie;

    // fields
    public
        $name,
        $sex,
        $country_id,
        $mobile,
        $email,
        $company_name,
        $industry_id,
        $vat,
        $url,
        // $city_id,
        $telephone,
        $remark;

    public function mount()
    {
        $this->industries = Industry::pluck('name', 'id');
        $this->countries = Country::pluck('name', 'id');
    }

    public function addVendor()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:100'],
            'sex' => ['required', 'string'],
            'country_id' => ['required', 'not_in:0'],
            'mobile' => ['required', 'phone:AE'],
            'email' => ['required', 'email'],
            'company_name' => ['required', 'string', 'max:100'],
            'industry_id' => ['required', 'not_in:0'],
            'vat' => ['nullable', 'string', 'max:20'],
            'url' => ['nullable', 'url'],
            // 'city_id' => ['nullable', 'not_in:0'],
            'telephone' => ['nullable', 'phone:AE'],
            'remark' => ['nullable', 'string']
        ]);

        $code = 'CUST-' . mt_rand(111111111, 999999999);
        $validated['code'] = $code;

        $vendor = Vendor::create($validated);

        if ($vendor) {
            $this->emit('vendorAdded', $vendor->id, $vendor->name);
            $this->emit('closeModal');
        }
    }

    public function render()
    {
        return view('livewire.forms.vendor.add-vendor-modal');
    }
}
