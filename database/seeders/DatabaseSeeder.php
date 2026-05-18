<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario administrador
        User::updateOrCreate(
            ['email' => 'admin@msi.com'],
            [
                'name' => 'Administrador MSI',
                'password' => Hash::make('password123'),
            ]
        );

        // Crear 5 categorías
        $categorias = Category::factory()->count(5)->create();

        // Crear 20 productos asegurando que pertenezcan a las categorías creadas
        foreach ($categorias as $categoria) {
            Product::factory()->count(4)->create([
                'category_id' => $categoria->id
            ]);
        }
    }
}
