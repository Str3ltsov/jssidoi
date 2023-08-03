<?php

namespace Database\Factories;

use App\Models\JssiMenu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JssiMenu>
 */
class JssiMenuFactory extends Factory
{
    /**
     * @var int
     */
    protected static int $counter = 0;

    /**
     * @var string
     */
    protected $model = JssiMenu::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titles = ['Main Nenu', 'Papers Menu'];
        $aliases = ['main', 'papers'];

        $jssiMenu = [
            'title' => $titles[self::$counter],
            'alias' => $aliases[self::$counter],
            'class' => ''
        ];

        self::$counter += 1;

        return $jssiMenu;
    }
}
