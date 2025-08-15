<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\Like;



class Species extends Model
{

    public function likes() {
        return $this->hasMany(Like::class);
    }
    protected $fillable = [
        'nombre',
        'nombre_cientifico',
        'descripcion',
        'habitat',
        'image_path',
        'location',
        'category_id',
        'subcategory_id',
        'user_id', // Asegúrate de que este campo existe en la tabla
    ];

    public function category() // Debe llamarse exactamente "category"
    {
        return $this->belongsTo(Categoria::class, 'category_id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
    
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

}
