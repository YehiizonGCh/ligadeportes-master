<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartidoArbitro extends Model
{
    use HasFactory;
    protected  $table = 'partidosarbitros';
    protected $primaryKey = 'id';
    protected $fillable = [

    ];
    //relacion con la tabla partido
    public function partido(){
        return $this->belongsTo(Partido::class);
    }
    //relacion con la tabla arbitro
    public function arbitro(){
        return $this->belongsTo(Arbitro::class);
    }
    


}
