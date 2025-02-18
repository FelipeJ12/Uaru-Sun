<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Species;

class Categoria extends Model
{
    protected $table = 'categories'; // Laravel usará "categories" en lugar de "categorias"
    
    protected $fillable = ['nombre', 'tipo'];

    public function species()
    {
        return $this->hasMany(Species::class, 'category_id');
    }
}
