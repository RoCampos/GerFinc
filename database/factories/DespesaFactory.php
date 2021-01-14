<?php

namespace Database\Factories;

use App\Models\Despesa;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DespesaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Despesa::class;

    protected $despesas = [
        'Aluguel tal',
        'Gasolina ali',
        'Carro meu',
        'Estudos de fulano',
        'Feira santa'
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'descricao'=> $this->despesas[array_rand($this->despesas, 1)],
            'fixa'=>array_rand([0,1], 1),
            'data'=>$this->faker->date,
            //+1 para evitar id = 0
            'user_id'=> array_rand(User::all()->toArray(), 1) + 1,
        ];
    }
}
