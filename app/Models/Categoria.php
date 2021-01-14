<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    /**
     * Categoria belongs to many (many-to-many) Despesa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function despesas()
    {
    	// belongsToMany(RelatedModel, pivotTable, thisKeyOnPivot = categoria_id, otherKeyOnPivot = despesa_id)
    	return $this->belongsToMany(Despesa::class, 'despesa_categoria');
    }
}
