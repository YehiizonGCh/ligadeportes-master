<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categorys';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'abreviatura',
        'edad_minima',
        'edad_maxima',
        'sexo',
        'torneos_id',
        'estado',
    ];

    //relacion clubs
    public function clubs()
    {
        return $this->belongsToMany(Club::class, 'category_details', 'categorys_id', 'clubs_id');
    }
    public function torneos()
    {
        return $this->belongsTo(Torneo::class, 'torneos_id');
    }
    public function scopeActivos()
    {
        return $this->where('estado', true);
    }
    //relacion category_details
    // relacion equipos
    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'categorys_id');
    }
    // relacion partidos
    public function partidos()
    {
        return $this->hasMany(Partido::class, 'categorys_id');
    }


}