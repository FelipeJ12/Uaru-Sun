<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Subcategory extends Model
{
    protected $fillable = ['category_id', 'nombre'];

    public function category()
    {
        return $this->belongsTo(Categoria::class);
    }
}