<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arbitro extends Model
{
    use HasFactory;
    protected  $table = 'arbitros';
    protected $primaryKey = 'id';
    protected $fillable = [

        'dni',
        'nombre',
        'apellido_materno',
        'apellido_paterno',
        'direccion',
        'telefono',
        'tipo_arbitro',
        'estado',
        'edad',

    ];
    // relacion con la tabla partido
    public function partidos()
    {
        return $this->hasMany(Partido::class, 'arbitros_id');
    }

}
