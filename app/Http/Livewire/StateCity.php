<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\City;
use App\Models\State;
use Livewire\Component;

class StateCity extends Component
{
    public $states, $cities;

    public $selectedState = null;
    public $selectedCity = null;

    /**
     * Mount method for the data
     *
     * @return response()
     */
    public function mount($selectedCity = null)
    {
        $this->states = State::all()->sortBy('name');
        $this->cities = collect();
        $this->selectedCity = $selectedCity;

        if (!is_null($selectedCity)) {
            $city = City::with('state')->find($selectedCity);
            if ($city) {
                $this->cities = City::where('state_id', $city->state_id)->get()->sortBy('name');
                $this->selectedState = $city->state_id;
            }
        }
    }

    public function render()
    {
        return view('livewire.state-city');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function updatedSelectedState($state)
    {
        if (!is_null($state)) {
            $this->cities = City::where('state_id', $state)->get()->sortBy('name');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function updatedSelectedCity($id)
    {
        if (!is_null($id)) {
            $city = City::findOrFail($id);

            $this->emit('city', $city->id);
        }
    }
}
