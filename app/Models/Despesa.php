<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    use HasFactory;

 
    /**
     * Despesa belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
    	return $this->belongsTo(User::class);
    }

    /**
     * Despesa belongs to many (many-to-many) Categoria.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categorias()
    {
    	// belongsToMany(RelatedModel, pivotTable, thisKeyOnPivot = despesa_id, otherKeyOnPivot = categoria_id)
    	return $this->belongsToMany(Categoria::class, 'despesa_categoria');
    }

    /**
     * Despesa has many Parcelas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parcelas()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = despesa_id, localKey = id)
        return $this->hasMany(Parcela::class);
    }

}
