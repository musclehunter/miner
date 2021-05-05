<?php

namespace Database\Factories;

use App\Models\MasterMine;
use Illuminate\Database\Eloquent\Factories\Factory;

class MasterMineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MasterMine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'distance' => 10,
            'description' => $this->faker->text()
        ];
    }
}
