<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;
    protected  $table = 'clubs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'abreviatura',
        'descripcion',
        'logo',
        'estado',
        'temporada',
        'domicilio',
        'representante',
        'dni_representante',
    ];

    public function jugadores()
    {
        return $this->hasMany(Jugador::class, 'clubs_id' );
    }
    //relacion categorias
    public function categorys()
    {
        return $this->belongsToMany(Category::class, 'category_details', 'clubs_id', 'categorys_id')->withTimestamps();
    }
    public function scopeActivos()
	{
		return $this->where('estado', true);
	}
    // relacion equipos
    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'clubs_id');
    }
    // relacion con estadio
    public function estadio()
    {
        return $this->hasOne(Estadio::class, 'club_id');
    }
    


}
