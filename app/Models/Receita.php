<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    use HasFactory;


    /**
     * Receita belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }


    public function renda_prevista() {

    //Receita Anual prevista
        $c = Receita::whereYear('data', '=', date('2021'))
            ->get()
            ->groupBy(function($val){
                return Carbon::parse($val->data)->format('m/Y');
            });

        $renda_prev =  $c->map(function($item, $key) {
            return [$item->sum('valor')];
        });

        return $renda_prev;
    }

}
