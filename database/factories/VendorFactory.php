<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\City;
use App\Models\State;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vendor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->catchPhrase(),
            'code' => $this->faker->swiftBicNumber(),
            'vat' => $this->faker->isbn10(),
            'building_name' => $this->faker->streetName(),
            'area_id' => Area::factory()->create(),
            'telephone' => $this->faker->e164PhoneNumber(),
            'email' => $this->faker->companyEmail(),
            'contact_name' => $this->faker->name(),
            'contact_number' => $this->faker->e164PhoneNumber,
            'contact_email' => $this->faker->email(),
            'remarks' => $this->faker->text(150)
        ];
    }
}
