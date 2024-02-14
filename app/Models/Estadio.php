<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadio extends Model
{
    use HasFactory;
    protected  $table = 'estadios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'direccion',
        'departamento',
        'clubs_id',
        'imagen',
        'estado',
    ];
    // relacion con la tabla club
    public function club(){
        return $this->belongsTo(Club::class,'clubs_id');
    }
    // relacion con la tabla partido
    public function partidos(){
        return $this->hasMany(Partido::class);
    }
    
    

    
    
}
