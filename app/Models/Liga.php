<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liga extends Model
{
    use HasFactory;
    protected  $table = 'ligas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'abreviatura',
        'descripcion',
        'logo',
        'estado',
        
    ];
    public function partidos()
    {
        return $this->hasMany(Partido::class,'partidos_id');
    }
    public function torneos()
    {
        return $this->hasMany(Torneo::class,'torneos_id');
    }

   
}
