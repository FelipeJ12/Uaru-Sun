<?php

namespace Database\Seeders;

use App\Models\Peligroso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeligrosoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $peligroso = new Peligroso();
        $peligroso->imagen = 'images/peligrosos/Jaguar.jpg';
        $peligroso->nombre = 'Jaguar (Panthera onca)';
        $peligroso->caracteristicas = 'Es el felino más grande de América. Posee un pelaje con manchas negras sobre un fondo dorado. Es un depredador solitario y muy territorial.';
        $peligroso->tipo = 'Mamiferos';
        $peligroso->save();

        $peligroso = new Peligroso();
        $peligroso->imagen = 'images/peligrosos/perezoso.png';
        $peligroso->nombre = 'Oso perezoso (Bradypus variegatus)';
        $peligroso->caracteristicas = 'Es un mamífero arborícola que posee largas garras. A pesar de su lentitud, puede ser peligroso cuando se siente amenazado.';
        $peligroso->tipo = 'Mamiferos';
        $peligroso->save();

        $peligroso = new Peligroso();
        $peligroso->imagen = 'images/peligrosos/puma.jpg';
        $peligroso->nombre = 'Puma (Puma concolor)';
        $peligroso->caracteristicas = 'Es un felino de gran tamaño, conocido también como león de montaña. Es solitario y territorial.';
        $peligroso->tipo = 'Mamiferos';
        $peligroso->save();

        $peligroso = new Peligroso();
        $peligroso->imagen = 'images/peligrosos/mur.jpeg';
        $peligroso->nombre = 'Murciélago vampiro (Desmodus rotundus)';
        $peligroso->caracteristicas = 'Este murciélago se alimenta de la sangre de animales y puede transmitir enfermedades como la rabia.';
        $peligroso->tipo = 'Mamiferos';
        $peligroso->save();

        $peligroso = new Peligroso();
        $peligroso->imagen = 'images/peligrosos/caiman.jpg';
        $peligroso->nombre = 'Caimán americano (Crocodylus acutus)';
        $peligroso->caracteristicas = 'Es un reptil grande y muy agresivo que habita en las zonas costeras y pantanosas de Honduras.';
        $peligroso->tipo = 'Reptiles';
        $peligroso->save();

        $peligroso = new Peligroso();
        $peligroso->imagen = 'images/peligrosos/coral.jpg';
        $peligroso->nombre = 'Serpiente coral (Micrurus spp.)';
        $peligroso->caracteristicas = 'Es una serpiente venenosa con colores brillantes que se encuentra en la región tropical de Honduras.';
        $peligroso->tipo = 'Reptiles';
        $peligroso->save();

        $peligroso = new Peligroso();
        $peligroso->imagen = 'images/peligrosos/boa.jpg';
        $peligroso->nombre = 'Boa constrictor (Boa constrictor)';
        $peligroso->caracteristicas = 'Es una serpiente grande que mata por constricción. Aunque no es venenosa, su tamaño y fuerza la hacen peligrosa.';
        $peligroso->tipo = 'Reptiles';
        $peligroso->save();

        $peligroso = new Peligroso();
        $peligroso->imagen = 'images/peligrosos/tegu.jpg';
        $peligroso->nombre = 'Tegú (Tupinambis spp.)';
        $peligroso->caracteristicas = 'Es un reptil terrestre que puede defenderse con mordeduras fuertes cuando se siente amenazado.';
        $peligroso->tipo = 'Reptiles';
        $peligroso->save();

        $peligroso = new Peligroso();
        $peligroso->imagen = 'images/peligrosos/cascabel.jpg';
        $peligroso->nombre = 'Culebra de cascabel (Crotalus spp.)';
        $peligroso->caracteristicas = 'Es una serpiente venenosa que utiliza su cascabel para advertir sobre su presencia. Su veneno puede ser mortal si no se trata a tiempo.';
        $peligroso->tipo = 'Reptiles';
        $peligroso->save();

        $peligroso = new Peligroso();
        $peligroso->imagen = 'images/peligrosos/Piranha.jpg';
        $peligroso->nombre = 'Piraña (Pygocentrus nattereri)';
        $peligroso->caracteristicas = 'Es un pez carnívoro conocido por su agresividad, especialmente en grupo.';
        $peligroso->tipo = 'Peces';
        $peligroso->save();

        $peligroso = new Peligroso();
        $peligroso->imagen = 'images/peligrosos/barra.jpeg';
        $peligroso->nombre = 'Barracuda (Sphyraena barracuda)';
        $peligroso->caracteristicas = 'Es un pez depredador que puede ser muy agresivo si se siente amenazado.';
        $peligroso->tipo = 'Peces';
        $peligroso->save();

        $peligroso = new Peligroso();
        $peligroso->imagen = 'images/peligrosos/chema.jpg';
        $peligroso->nombre = 'Mero (Epinephelinae)';
        $peligroso->caracteristicas = 'Aunque no es agresivo por naturaleza, puede ser peligroso debido a su tamaño y fuerza.';
        $peligroso->tipo = 'Peces';
        $peligroso->save();

        $peligroso = new Peligroso();
        $peligroso->imagen = 'images/peligrosos/violinista.jpg';
        $peligroso->nombre = 'Araña violinista (Loxosceles reclusa)';
        $peligroso->caracteristicas = 'Es una araña venenosa que puede causar necrosis en la piel si no se recibe tratamiento adecuado.';
        $peligroso->tipo = 'Aracnidos';
        $peligroso->save();

        $peligroso = new Peligroso();
        $peligroso->imagen = 'images/peligrosos/viuda.webp';
        $peligroso->nombre = 'Viuda negra (Latrodectus mactans)';
        $peligroso->caracteristicas = 'Es una araña venenosa cuyo veneno puede causar graves problemas neurológicos.';
        $peligroso->tipo = 'Aracnidos';
        $peligroso->save();


        $peligroso = new Peligroso();
        $peligroso->imagen = 'images/peligrosos/tarantula.jpg';
        $peligroso->nombre = 'Tarántula (Theraphosidae)';
        $peligroso->caracteristicas = 'Aunque no es mortal, su picadura puede ser dolorosa y causar reacciones alérgicas.';
        $peligroso->tipo = 'Aracnidos';
        $peligroso->save();

        $peligroso = new Peligroso();
        $peligroso->imagen = 'images/peligrosos/armada.jpg';
        $peligroso->nombre = 'Araña armada (Hogna spp.)';
        $peligroso->caracteristicas = 'Es una araña grande cuya picadura, aunque rara, puede causar dolor y malestar.';
        $peligroso->tipo = 'Aracnidos';
        $peligroso->save();

        $peligroso = new Peligroso();
        $peligroso->imagen = 'images/peligrosos/avispa.jpg';
        $peligroso->nombre = 'Avispa (Vespidae)';
        $peligroso->caracteristicas = 'Las avispas pueden ser agresivas cuando se sienten amenazadas y sus picaduras son dolorosas, algunas especies pueden ser mortales.';
        $peligroso->tipo = 'Insectos';
        $peligroso->save();

        $peligroso = new Peligroso();
        $peligroso->imagen = 'images/peligrosos/chince.jpg';
        $peligroso->nombre = 'Chinche asesina (Triatominae)';
        $peligroso->caracteristicas = 'Transmite la enfermedad de Chagas, que puede ser fatal si no se trata.';
        $peligroso->tipo = 'Insectos';
        $peligroso->save();

        $peligroso = new Peligroso();
        $peligroso->imagen = 'images/peligrosos/Aedes.jpg';
        $peligroso->nombre = 'Mosquito (Aedes aegypti)';
        $peligroso->caracteristicas = 'Es un transmisor de enfermedades como el dengue, zika y chikungunya.';
        $peligroso->tipo = 'Insectos';
        $peligroso->save();

        $peligroso = new Peligroso();
        $peligroso->imagen = 'images/peligrosos/avispa_papel.jpg';
        $peligroso->nombre = 'Avispa de papel (Polistes spp.)';
        $peligroso->caracteristicas = 'Su picadura puede ser dolorosa y, en algunos casos, causar reacciones alérgicas graves.';
        $peligroso->tipo = 'Insectos';
        $peligroso->save();

    }
}
