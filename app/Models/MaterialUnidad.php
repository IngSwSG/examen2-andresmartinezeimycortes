<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaterialUnidad extends Model
{
    use HasFactory;

    protected $table = 'material_unidads';
    protected $primaryKey = 'idMaterialUnidad';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'cantidad',
        'unidad_id',
        'codigo_material',
        'codigoPresupuesto',
    ];

    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'unidad_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'codigo_material');
    }

    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class, 'codigoPresupuesto');
    }
}

