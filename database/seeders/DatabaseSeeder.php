<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Receita;
use App\Models\Despesa;
use App\Models\Parcela;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *12
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Receita::factory(10)->create();

        $i = 0;
        while (true) {
            try {
                Categoria::factory(1)->create();
                $i++;
            } catch (\Illuminate\Database\QueryException $e) {
                
            }
            if ($i == 6) break;
        }
        
        for ($i = 0; $i < 50; $i++) {
            Despesa::factory(1)
                ->hasAttached(Categoria::inRandomOrder()->first())
                ->create();
        }

        for ($i = 0; $i < 20; $i++) {
            
            $despesa = Despesa::inRandomOrder()->first();
            $data = Carbon::create($despesa->data);

            if (rand(0,1)) {
                //parcelado
                $parcelas = rand(5, 10);
                for ($i = 0; $i < $parcelas; $i++) {
                    $parc = Parcela::factory(1)
                        ->make();

                    $parc[0]->despesa_id = $despesa->id;
                    $parc[0]->data_pagamento = $data;
                    $parc[0]->save();

                    $data->addMonth(1);
                }
                
            }

        }


    }
}
