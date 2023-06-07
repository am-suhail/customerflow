<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BranchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'company_id' => ['required', 'not_in:0'],
            'name' => ['required', 'string', 'max:100'],
            'telephone' => ['required', Rule::unique('branches')->ignore($this->branch)],
            'inc_date' => ['required', 'date'],
            'building_size' => ['nullable'],
            'rent' => ['nullable'],
            'total_accomodation' => ['nullable'],
            'accomodation_rent' => ['nullable'],
            'total_warehouse' => ['nullable'],
            'warehouse_rent' => ['nullable'],
            'country_id' => ['required', 'not_in:0'],
            'city_id' => ['required', 'not_in:0'],
            'emp_male' => ['required', 'numeric'],
            'emp_female' => ['required', 'numeric'],
            'capital' => ['required', 'numeric'],
            'share_value' => ['required', 'numeric'],
            'total_shares' => ['required', 'numeric'],
            'investment_amount' => ['required', 'numeric', 'lte:capital'],
            'investment_percentage' => ['required', 'numeric'],
            'investment_shares' => ['required', 'numeric'],
            'remark' => ['nullable', 'string'],
            'type' => ['required', 'numeric']
        ];
    }
}
