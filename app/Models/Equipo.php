<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    protected  $table = 'equipos';
    protected $primaryKey = 'id';
    protected $fillable= [
        'nombre',
        'representante',
        'estado',
        'clubs_id',
        'categorys_id',
        'entrenadors_id',

 
    ];

    // relacion club
    public function club()
    {
        return $this->belongsTo(Club::class, 'clubs_id');
    }

    // relacion categoria
    public function categoria()
    {
        return $this->belongsTo(Category::class, 'categorys_id');
    }
    // relacion entrenador
    public function entrenador()
    {
        return $this->belongsTo(Entrenador::class, 'entrenadors_id');
    }
    
    // relacion jugadores
    public function jugadores()
    {
        return $this->hasMany(Jugador::class, 'equipos_id');
    }
    // relacion partidos
    public function partidolocal()
    {
        return $this->hasMany(Partido::class, 'equipos_id');
    }
    // relacion partidos
    public function partidovisitante()
    {
        return $this->hasMany(Partido::class, 'equipos_id1');
    }
    // relacion estadistica_partidos
    public function estadisticapartidos()
    {
        return $this->hasMany(EstadisticaPartido::class, 'equipos_id');
    }
    


}
