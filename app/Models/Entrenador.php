<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrenador extends Model
{
    use HasFactory;
    protected  $table = 'entrenadors';
    protected $primaryKey = 'id';
    protected $fillable = [
        'dni',
        'nombre',
        'apellido_materno',
        'apellido_paterno',
        'direccion',
        'firma',
       'foto',
        'estado',

    ];

    // relacion equipos
    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'entrenadors_id');
    }

    public function scopeActivos()
	{
		return $this->where('estado', true);
	}
    

    
    
}
