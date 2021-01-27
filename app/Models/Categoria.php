<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

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

    //retorna todas as instancias subgrupo de $this
    public function subgrupos()
    {
        $list = DB::table('categoria_categoria')
            ->where('grupo', '=', $this->id)
            ->get()->pluck('subgrupo');


        return Categoria::find($list->toArray());
    }

    /**
     * Categoria belongs to many (many-to-many) Grupo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function grupos()
    {
        $list = DB::table('categoria_categoria')
            ->where('subgrupo', '=', $this->id);
        return $list;
    }

    public function available () {
        $list = DB::table('categoria_categoria')
            ->where('grupo','=', $this->id)
            ->get()
            ->pluck(['subgrupo']);

        $list[] = $this->id;

        //remove categorias que já estão associadas
        $list_diff = Categoria::whereNotIn('id', $list->toArray()); 

        return $list_diff;
    }

    public static function diff_categorias ($despesas) {

        $models = Categoria::get();

        if (isset($despesas) && isset($models))
            return $models->diff($despesas);
        return collect();
    }
}
