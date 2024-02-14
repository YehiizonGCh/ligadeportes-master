<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JugadorEncuentro extends Model
{
    use HasFactory;
    protected $table = 'jugadorencuentros';
    protected $primaryKey = 'id';
    protected $fillable = [
       
        'jugadores_id',
        'partidos_id',
        'titular',
        'goles',
        'autogoles',
        'minuto_gol',
        'minuto_autogol',
        'asistencias',
        'amarillas',
        'rojas',
        'observacion_goles',
        'observacion_targeta_amarilla',
        'observacion_targeta_roja',
    ];


    protected $casts = [
        'minuto_gol' => 'array',
        'minuto_autogol' => 'array',
    ];
    //relacion con la tabla jugadores
    public function jugador()
    {
        return $this->belongsTo(Jugador::class, 'jugadores_id');
    }
    //relacion con la tabla partidos
    public function partido()
    {
        return $this->belongsTo(Partido::class, 'partidos_id');
    }
    //relacion con la tabla estadisticaspartidos
    public function estadisticaspartidos()
    {
        return $this->hasMany(EstadisticaPartido::class, 'jugadores_id');
    }
    
} 
