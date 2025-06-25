<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    /**
     * La clave primaria no es "id" sino "codigo".
     */
    protected $primaryKey = 'codigo';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'codigo',
        'unidad_medida',
        'descripcion',
        'ubicacion',
        'categoria_id',
    ];

    /**
     * Un material pertenece a una categoría.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    /**
     * Relación con MaterialUnidad (creada por el miembro 2).
     */
    public function materialUnidades()
    {
        return $this->hasMany(MaterialUnidad::class, 'codigo_material');
    }
}
