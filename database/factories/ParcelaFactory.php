<?php

namespace Database\Factories;

use App\Models\Parcela;
use App\Models\Despesa;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParcelaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Parcela::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //alguns dados são definidos 
        //no Seeder
        return [
            'despesa_id' => Despesa::inRandomOrder()->first(),
            'valor' => rand(100, 1000000), 
        ];
    }
}
