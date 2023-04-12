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
     * @var int
     */
    protected static int $counter = 0;

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
        self::$counter += 1;

        if (self::$counter >= 100) {
            self::$counter = rand(1, 100);
        }

        return [
            'author_id' => self::$counter,
            'institution_id' => rand(1, 50)
        ];
    }
}
