<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->catchPhrase,
            'code' => 'DIT-' . $this->faker->postcode(),
            'sub_category_id' => $this->faker->numberBetween(1, 30),
            'description' => $this->faker->realText(40),
            'unit_id' => $this->faker->numberBetween(1, 6),
            'min_price' => $this->faker->numberBetween(25, 120),
            'max_price' => $this->faker->numberBetween(125, 150),
            'comment' => $this->faker->realText(20),
        ];
    }
}
