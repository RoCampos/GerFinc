<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    use HasFactory;


    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'valor', 'pago', 'data_pagamento', 'despesa_id'
    ];

    /**
     * Parcela belongs to Despesa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Despesa()
    {
    	// belongsTo(RelatedModel, foreignKey = despesa_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Despesa::class);
    }

    public function status () {
        if ($this->pago) {
            return 'Quitado';
        } else {
            return 'Não quitado';
        }
    }

}
