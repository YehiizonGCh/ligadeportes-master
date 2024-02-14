<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadisticaPartido extends Model
{
    use HasFactory;
    protected $table = 'estadistica_partidos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'goles_visitante',
        'goles_local',
        'corners_visitante',
        'corners_local',
        'faltas_visitante',
        'faltas_local',
        'tarjetas_amarillas_visitante',
        'tarjetas_amarillas_local',
        'tarjetas_rojas_visitante',
        'tarjetas_rojas_local',        
        'partidos_id',

    ];
    //relacion con la tabla partido
    public function partido()
    {
        return $this->belongsTo(Partido::class, 'partidos_id');
    }
    //relacion con la tabla jugadores
    public function jugadores()
    {
        return $this->belongsTo(Jugador::class, 'jugadores_id');
    }
    //relacion con la tabla jugadores
    public function jugadorescambios()
    {
        return $this->belongsTo(JugadorCambio::class, 'jugadorescambios_id');
    }
    //relacion con la tabla jugadores

    public function jugadorencuentros()
    {
        return $this->belongsTo(JugadorEncuentro::class, 'jugadorencuentros_id');
    }
    //relacion con la tabla jugadores

    
}
