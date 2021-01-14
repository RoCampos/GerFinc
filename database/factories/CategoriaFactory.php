<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Categoria::class;

    protected $tags = [
        'Combustível',
        'Financiamento',
        'Educação',
        'Alimentação',
        'Feira', 
        'Construção'
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'etiqueta' => $this->tags[array_rand($this->tags, 1)],
        ];
    }
}
