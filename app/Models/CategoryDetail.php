<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryDetail extends Model
{
    use HasFactory;
    protected  $table = 'category_detail';
    protected $primaryKey = 'id';
    protected $fillable = [

    ];
    //relacion con la tabla category
    public function category(){
        return $this->belongsTo(Category::class);
    }
    //relacion con la tabla club
    public function club(){
        return $this->belongsTo(Club::class);
    }
    
}
