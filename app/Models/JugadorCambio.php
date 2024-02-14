<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JugadorCambio extends Model
{
    use HasFactory;


    protected $table = 'jugadorescambios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'partidos_id',
        'jugador_entra_id',
        'jugador_sale_id',
        'minuto_cambio',
        'observacion_cambio'
    ];
    // relacion con la tabla partidos
    public function partido()
    {
        return $this->belongsTo(Partido::class, 'partidos_id');
    }
    // relacion con la tabla jugadores
    public function jugadorEntra()
    {
        return $this->belongsTo(Jugador::class, 'jugador_entra_id');
    }
    // relacion con la tabla jugadores
    public function jugadorSale()
    {
        return $this->belongsTo(Jugador::class, 'jugador_sale_id');
    }
    

    

}
