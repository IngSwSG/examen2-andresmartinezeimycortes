<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nombre'];

    /**
     * Relación: una categoría tiene muchos materiales.
     */
    public function materials()
    {
        return $this->hasMany(Material::class, 'categoria_id');
    }
}
