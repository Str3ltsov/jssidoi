<?php

namespace Database\Factories;

use App\Models\JssiAuthorsInstitution;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JssiAuthorsInstitution>
 */
class JssiAuthorsInstitutionFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = JssiAuthorsInstitution::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id' => rand(1, 100),
            'institution_id' => rand(1, 100)
        ];
    }
}
