<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Club;


class Jugador extends Model
{
    use HasFactory;
    protected  $table = 'jugadors';
    protected $primaryKey = 'id';
    protected $fillable = [
        'apellido_materno',
        'apellido_paterno',
        'nombres',
        'dni',
        'departamento',
        'provincia',
        'distrito',
        'estado_civil',
        'trabaja',
        'estudia',
        'talla',
        'peso',
        'domicilio',
        'nombre_padre',
        'nombre_madre',
        'ficha_medica',
        'grupo_sanguineo',
        'fecha_nacimiento',
        'edad',
        'posicion',
        'dorsal',
        'documentos',
        'club_origen',
        'equipos_id',
        'foto',
        'estado',

    ];
    // relacion equipos
    public function equipos()
    {
        return $this->belongsTo(Equipo::class, 'equipos_id');
    }


    public function scopeActivos()
    {
        return $this->where('estado', true);
    }


    
    // relacioncon tabla jugadoresencuentros
    public function encuentros()
    {
        return $this->belongsToMany(Partido::class, 'jugadorencuentros', 'jugadores_id', 'partidos_id')
            ->withPivot('goles', 'asistencias', 'amarillas', 'rojas', 'minuto_gol');
    }
    // relacion con la tabla jugadorescambios
    public function cambios()
    {
        return $this->belongsToMany(Partido::class, 'jugadorescambios', 'jugador_entra_id', 'partidos_id')
            ->withPivot('jugador_sale_id', 'minuto_cambio');
    }
    // relacion con la tabla jugadorescambios
    public function cambios2()
    {
        return $this->belongsToMany(Partido::class, 'jugadorescambios', 'jugador_sale_id', 'partidos_id')
            ->withPivot('jugador_entra_id', 'minuto_cambio');
    }
    // relacion con la tabla partidos
    public function partidos()
    {
        return $this->belongsToMany(Partido::class, 'jugadorencuentros', 'jugadores_id', 'partidos_id')
            ->withPivot('goles', 'asistencias', 'amarillas', 'rojas', 'minuto_gol');

    }
    // relacion con la tabla estadisticaspartidos
    public function estadisticaspartidos()
    {
        return $this->hasMany(EstadisticaPartido::class, 'jugadores_id');
    }

    
    
    //relacion con la tabla jugadorescambios
    public function jugadorescambios()
    {
        return $this->hasMany(JugadorCambio::class, 'jugador_entra_id');
    }
    //relacion con la tabla jugadorescambios
    public function jugadorescambios2()
    {
        return $this->hasMany(JugadorCambio::class, 'jugador_sale_id');
    }
    //relacion con la tabla jugadoresencuentros
    public function jugadoresencuentros()
    {
        return $this->hasMany(JugadorEncuentro::class, 'jugadores_id');
    }
    

}

       