<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'nombre' => $this->faker->words(3, true),
            'descripcion' => $this->faker->paragraph(3),
            'precio' => $this->faker->randomFloat(2, 10, 500),
            'stock' => $this->faker->numberBetween(0, 100),
            'imagen' => 'https://picsum.photos/seed/' . $this->faker->word() . '/800/600'
        ];
    }
}
