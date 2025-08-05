<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $plants = [
            [
                'name' => 'Helecho Hondureño',
                'description' => 'Planta nativa ideal para interiores frescos.',
                'price' => 120.00,
                'image' => 'helecho.jpg',
            ],
            [
                'name' => 'Orquídea Blanca',
                'description' => 'Hermosa orquídea cultivada en climas húmedos.',
                'price' => 220.00,
                'image' => 'orquidea.jpg',
            ],
            [
                'name' => 'Flor de Izote',
                'description' => 'Flor nacional de El Salvador, también común en Honduras.',
                'price' => 85.00,
                'image' => 'izote.jpeg',
            ],
            [
                'name' => 'Palma Catracha',
                'description' => 'Ideal para jardines tropicales, resistente al sol.',
                'price' => 250.00,
                'image' => 'palma.jpg',
            ],
            [
                'name' => 'Cactus del Valle',
                'description' => 'Cactus autóctono del sur hondureño, resistente y decorativo.',
                'price' => 95.00,
                'image' => 'cactus.jpg',
            ],
            [
                'name' => 'Bromelia Roja',
                'description' => 'Planta exótica que crece en selvas húmedas.',
                'price' => 180.00,
                'image' => 'bromelia.jpg',
            ],
            [
                'name' => 'Flor de Mayo',
                'description' => 'Colorida y aromática, florece en verano.',
                'price' => 110.00,
                'image' => 'mayo.jpeg',
            ],
            [
                'name' => 'Guaria Morada',
                'description' => 'Orquídea popular en Centroamérica con flor lila.',
                'price' => 210.00,
                'image' => 'guaria.jpeg',
            ],
            [
                'name' => 'Ginger Rojo',
                'description' => 'Flor ornamental vibrante común en zonas costeras.',
                'price' => 190.00,
                'image' => 'ginger.jpg',
            ],
            [
                'name' => 'Begonia de Selva',
                'description' => 'Perfecta para interiores sombreados.',
                'price' => 115.00,
                'image' => 'begonia.jpg',
            ],
            [
                'name' => 'Lirio Amarillo',
                'description' => 'Florece en climas cálidos y húmedos.',
                'price' => 105.00,
                'image' => 'lirio.jpeg',
            ],
            [
                'name' => 'Anturio Hondureño',
                'description' => 'Con flores rojas brillantes, resistente y decorativo.',
                'price' => 165.00,
                'image' => 'anturio.jpg',
            ],
            [
                'name' => 'Planta de Banano Ornamental',
                'description' => 'Usada para sombra, sin fruto comestible.',
                'price' => 130.00,
                'image' => 'banano.jpg',
            ],
            [
                'name' => 'Maranta Tricolor',
                'description' => 'Conocida como “planta de oración”, hojas hermosas.',
                'price' => 125.00,
                'image' => 'maranta.jpeg',
            ],
            [
                'name' => 'Calatea Hondureña',
                'description' => 'Planta de follaje exótico y muy decorativa.',
                'price' => 140.00,
                'image' => 'calatea.jpg',
            ],
        ];

        foreach ($plants as $plant) {
            Product::create($plant);
        }
    }
}
