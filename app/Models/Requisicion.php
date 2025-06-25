<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Requisicion extends Model
{
    use HasFactory;

    protected $table = 'requisicions';
    protected $primaryKey = 'idRequisicion';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['fecha', 'estado', 'idUsuario'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }

    public function items()
    {
        return $this->hasMany(ItemRequisicion::class, 'idRequisicion');
    }
}

