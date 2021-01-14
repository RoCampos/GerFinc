<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Receita;
use App\Models\User;
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
            \App\Models\Despesa::factory(1)
                ->hasAttached(Categoria::inRandomOrder()->first())
                ->create();
        }

    }
}
