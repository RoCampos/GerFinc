<?php

namespace Database\Factories;

use App\Models\Receita;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReceitaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Receita::class;

    protected $description = [
        'Salario',
        'Serviço',
        'Aluguel',
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'descricao' => 
                $this->description[array_rand($this->description,1)],
            'fixa' => array_rand([0,1],1),
            'valor' => rand(100, 1000000),
            'data' => $this->faker->date,
            //+1 para evitar id = 0
            'user_id' => 
                array_rand(\App\Models\User::all()->toArray(), 1) + 1,
        ];
    }
}
