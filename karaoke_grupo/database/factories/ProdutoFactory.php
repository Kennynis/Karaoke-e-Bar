<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Produto>
 */
class ProdutoFactory extends Factory
{

    public function definition(): array
    {
        $produto = fake()->unique()->randomElement([
            ['nome' => 'Porção de batata frita', 'categoria' => 'Comida', 'alcoolico' => false],
            ['nome' => 'Porção de pastel', 'categoria' => 'Comida', 'alcoolico' => false],
            ['nome' => 'Hambúrguer', 'categoria' => 'Comida', 'alcoolico' => false],
            ['nome' => 'Refrigerante', 'categoria' => 'Bebida', 'alcoolico' => false],
            ['nome' => 'Suco natural', 'categoria' => 'Bebida', 'alcoolico' => false],
            ['nome' => 'Cerveja', 'categoria' => 'Bebida', 'alcoolico' => true],
            ['nome' => 'Caipirinha', 'categoria' => 'Bebida', 'alcoolico' => true],
            ['nome' => 'Margarita', 'categoria' => 'Bebida', 'alcoolico' => true],
        ]);

        return [
            'nome' => $produto['nome'],
            'preco' => fake()->randomFloat(2, 8, 45),
            'categoria' => $produto['categoria'],
            'alcoolico' => $produto['alcoolico'],
            'estoque' => fake()->numberBetween(10, 100),
        ];
    }
}
