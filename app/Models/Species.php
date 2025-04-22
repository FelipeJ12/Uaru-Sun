<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Species extends Model
{
    protected $fillable = [
        'nombre',
        'nombre_cientifico',
        'descripcion',
        'habitat',
        'image_path',
        'location',
        'category_id' // Asegúrate de que este campo existe en la tabla
    ];

    public function category() // Debe llamarse exactamente "category"
    {
        return $this->belongsTo(Categoria::class, 'category_id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    

}
