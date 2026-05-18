<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->words(2, true),
            'descripcion' => $this->faker->sentence(),
            // Providing a reliable placeholder image URL
            'imagen' => 'https://picsum.photos/seed/' . $this->faker->word() . '/400/400'
        ];
    }
}
