<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;
use database\factories\CategoriaFactory;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create([
            'nombre' => 'Flora',   
           
        ]);
        Categoria::create([
            'nombre' => 'Fauna',  
           
        ]);
        Categoria::create([
            'nombre' => 'Paisaje',   
           
        ]);
    }
    
}
