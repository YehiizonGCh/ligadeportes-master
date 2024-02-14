<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;
    protected  $table = 'partidos';
    protected $primaryKey = 'id';
    protected $fillable = [

        'fecha_partido',
        'hora_partido',
        'lugar',
        'observacion',
        'estado',
        'equipos_id',
        'equipos_id1',
        'estadios_id',
        'arbitros_id',
        'categorys_id',
        'ligas_id',


    
    ];
    //relacion con la tabla equipo
    public function equipolocal(){
        return $this->belongsTo(Equipo::class,'equipos_id');
    }
    // relacion con la tabla equipo1
    public function equipovisitante(){
        return $this->belongsTo(Equipo::class,'equipos_id1');
    }
    //relacion con la tabla estadio
    public function estadio(){
        return $this->belongsTo(Estadio::class,'estadios_id');
    }
    //relacion con la tabla arbitros
    public function arbitros(){
        return $this->belongsTo(Arbitro::class,'arbitros_id');
    }
    //relacion con la tabla category
    public function categoria(){
        return $this->belongsTo(Category::class,'categorys_id');
    }
    //relacion con la tabla liga
    public function liga()
    {
        return $this->belongsTo(Liga::class, 'ligas_id');
    }
    //relacion con la tabla estadistica_partidos
    
    //relacion con la tabla jugadores
    public function jugadores()
    {
        return $this->belongsToMany(Jugador::class, 'jugadorencuentros', 'partidos_id', 'jugadores_id')
        ->withPivot('goles','asistencias','amarillas','rojas','minuto_gol');
    }
    //relacion con la tabla jugadorescambios
    public function jugadorescambios()
    {
        return $this->belongsToMany(Jugador::class, 'jugadorescambios', 'partidos_id', 'jugador_entra_id')
        ->withPivot('jugador_sale_id','minuto_cambio');
    }
    //relacion con la tabla jugadorescambios
    public function jugadorescambios2()
    {
        return $this->belongsToMany(Jugador::class, 'jugadorescambios', 'partidos_id', 'jugador_sale_id')
        ->withPivot('jugador_entra_id','minuto_cambio');
    }
    //relacion con la tabla jugadoresencuentros
    public function jugadoresencuentros()
    {
        return $this->hasMany(JugadorEncuentro::class, 'partidos_id');
    }
    //relacion con la tabla estadisticaspartidos
    public function estadisticaspartidos()
    {
        return $this->hasMany(EstadisticaPartido::class, 'partidos_id');
    }
    //relacion con la tabla estadisticaspartidos
    

 



}
