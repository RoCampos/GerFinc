<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    use HasFactory;


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
}
