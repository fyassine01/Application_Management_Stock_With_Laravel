<?php

namespace Database\Factories;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProduitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Produit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'prix' => $this->faker->randomFloat(2, 10, 100), // Prix aléatoire entre 10 et 100 avec 2 décimales
            'quantité_actual' => $this->faker->numberBetween(10, 100), // Quantité aléatoire entre 10 et 100
            'quantité_initial' => $this->faker->numberBetween(50, 100), // Quantité initiale aléatoire entre 50 et 100
            'image' => 'storage/shopping-cart.png', // Chemin statique de l'image
        ];
    }
}
