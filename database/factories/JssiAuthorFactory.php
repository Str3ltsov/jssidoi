<?php

namespace Database\Factories;

use App\Models\JssiAuthor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JssiAuthor>
 */
class JssiAuthorFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = JssiAuthor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rndBoolean = [false, true];

        return [
            'first_name' => fake()->firstName(),
            'middle_name' => $rndBoolean[rand(0, 1)] ? fake()->firstName() : null,
            'last_name' => fake()->lastName(),
            'email' => fake()->email(),
            'orcid' => '0000-'.rand(1000, 9999).'-'.rand(1000, 9999).'-'.rand(1000, 9999)
        ];
    }
}
