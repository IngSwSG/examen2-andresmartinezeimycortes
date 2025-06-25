<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presupuesto extends Model
{
    use HasFactory;

    protected $table = 'presupuestos';
    protected $primaryKey = 'codigoPresupuesto';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nombrePresupuesto'];

    public function materialUnidades()
    {
        return $this->hasMany(MaterialUnidad::class, 'codigoPresupuesto');
    }
}

