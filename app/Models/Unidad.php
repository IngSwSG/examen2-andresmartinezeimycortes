<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    protected $table = 'unidades';

    protected $fillable = ['nombre'];

    /**
     * Relación con MaterialUnidad (creada por miembro 2).
     */
    public function materialUnidades()
    {
        return $this->hasMany(MaterialUnidad::class, 'unidad_id');
    }
}
