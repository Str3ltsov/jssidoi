<?php

namespace Database\Factories;

use App\Models\JssiCountry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JssiCountry>
 */
class JssiCountryFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = JssiCountry::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->countryCode(),
            'name' => fake()->country()
        ];
    }
}
