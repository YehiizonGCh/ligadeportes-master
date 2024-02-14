<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    use HasFactory;
    protected  $table = 'torneos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'abreviatura',
        'descripcion',
        'logo',
        'estado',
        'temporada',
        'fecha_inicio',
        'fecha_fin',
        'ligas_id',

    ];

    //relacion categories
    public function categorias()
    {
        return $this->hasMany(Category::class, 'torneos_id');
    }
    //relacion ligas
    public function liga()
    {
        return $this->belongsTo(Liga::class, 'ligas_id');
    }


 

}
