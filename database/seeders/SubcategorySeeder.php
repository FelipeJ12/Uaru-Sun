<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Subcategory;

class SubcategorySeeder extends Seeder
{
    public function run(): void
    {
        $flora = Categoria::where('nombre', 'Flora')->first();
        $fauna = Categoria::where('nombre', 'Fauna')->first();
        $paisaje = Categoria::where('nombre', 'Paisaje')->first();

        Subcategory::create(['category_id' => $flora->id, 'nombre' => 'Arboles']);
        Subcategory::create(['category_id' => $flora->id, 'nombre' => 'Medicinales']);
        Subcategory::create(['category_id' => $flora->id, 'nombre' => 'Agricola']);
        Subcategory::create(['category_id' => $flora->id, 'nombre' => 'Venenosa']);
        Subcategory::create(['category_id' => $flora->id, 'nombre' => 'Comestible']);
        Subcategory::create(['category_id' => $fauna->id, 'nombre' => 'Peligro de Extincion']);
        Subcategory::create(['category_id' => $fauna->id, 'nombre' => 'Mamiferos']);
        Subcategory::create(['category_id' => $fauna->id, 'nombre' => 'Aves']);
        Subcategory::create(['category_id' => $fauna->id, 'nombre' => 'Anfibios']);
        Subcategory::create(['category_id' => $fauna->id, 'nombre' => 'Reptiles']);
        Subcategory::create(['category_id' => $paisaje->id, 'nombre' => 'Montañas']);
        Subcategory::create(['category_id' => $paisaje->id, 'nombre' => 'Rios']);
        Subcategory::create(['category_id' => $paisaje->id, 'nombre' => 'Lagos']);
    }
}