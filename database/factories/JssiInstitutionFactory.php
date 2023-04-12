<?php

namespace Database\Factories;

use App\Models\JssiInstitution;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JssiInstitution>
 */
class JssiInstitutionFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = JssiInstitution::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(50),
            'website' => fake()->url(),
            'city' => fake()->city(),
            'country_id' => rand(1, 100)
        ];
    }
}
