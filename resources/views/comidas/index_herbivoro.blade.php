@extends('layouts.app')

@section('title', 'Alimentación')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-white text-center">Alimentación de animales herbívoros</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div style="background: rgba(30,28,28,0.67); font-size: 20px; padding: 20px">
            <p class="text-white text-justify" style="margin-bottom: 40px">
                Los herbívoros son animales que se alimentan principalmente de plantas, ya sea pasto, hojas, frutas, semillas o corteza. Su sistema digestivo está adaptado para procesar material vegetal, que suele ser más difícil de digerir que la carne. A través de su dieta, los herbívoros juegan un papel crucial en los ecosistemas, ayudando a controlar el crecimiento de las plantas y a dispersar semillas.
            </p>

            <div class="ecosystem">
                <h4 class="text-white">1. Desiertos</h4>
                <div class="row">
                    <div class="col-4">
                        <img src="https://www.wearewater.org/wp-content/uploads/2024/03/maxresdefault-2024-03-01T081618.961.jpg" alt="Desiertos" class="img-fluid" style="height: 200px; width: 600px">
                    </div>
                    <div class="col-8" style="text-align: justify">
                        <p class="text-white text-justify" style="margin-bottom: 80px">
                            En los desiertos, los herbívoros deben adaptarse a las duras condiciones de sequedad y calor extremo. Las plantas en estos ecosistemas, como cactus y arbustos espinosos, tienen mecanismos de defensa como espinas y sustancias tóxicas, lo que obliga a los herbívoros a ser selectivos en su alimentación. Animales como los camellos, las gacelas y los conejos del desierto se alimentan de hojas y plantas resistentes a la sequía, aprovechando su capacidad para almacenar agua en sus tejidos.
                        </p>
                    </div>
                </div>

                <h4 class="text-white">2. Bosques Tropicales</h4>
                <div class="row">
                    <div class="col-4">
                        <img src="https://cdn0.ecologiaverde.com/es/posts/0/7/6/bosques_tropicales_caracteristicas_flora_y_fauna_1670_600.jpg" alt="Desiertos" class="img-fluid" style="height: 200px; width: 600px">
                    </div>
                    <div class="col-8" style="text-align: justify">
                        <p class="text-white text-justify" style="margin-bottom: 80px">
                            En los bosques tropicales, donde la biodiversidad es alta, los herbívoros tienen acceso a una gran variedad de plantas. Desde hojas de árboles grandes hasta frutas, estos animales tienen una dieta variada que les permite aprovechar los recursos en su entorno. Por ejemplo, los monos, tucanes y sloths (osos perezosos) se alimentan principalmente de hojas, frutas y flores. Estos herbívoros contribuyen a la dispersión de semillas, ayudando a la regeneración de la vegetación en el ecosistema.
                        </p>
                    </div>
                </div>


                <h4 class="text-white">3. Sabana</h4>
                <div class="row">
                    <div class="col-4">
                        <img src="https://concepto.de/wp-content/uploads/2018/10/sabana1-e1539982728250.jpg" alt="Desiertos" class="img-fluid" style="height: 200px; width: 600px">
                    </div>
                    <div class="col-8" style="text-align: justify">
                        <p class="text-white text-justify" style="margin-bottom: 80px">
                            En las sabanas, que son ecosistemas de pastizales con árboles dispersos, los herbívoros como los elefantes, cebras, jirafas y antílopes tienen una dieta basada principalmente en pasto. Estos animales están adaptados para sobrevivir en un entorno donde las estaciones secas y húmedas se alternan, lo que influye en la disponibilidad de recursos. Los herbívoros de la sabana son fundamentales para mantener el equilibrio ecológico al evitar que el pasto crezca en exceso, lo que permite la regeneración de la vegetación y mantiene el hábitat accesible para otras especies.
                        </p>
                    </div>
                </div>


                <h4 class="text-white">4. Bosques Templados</h4>
                <div class="row">
                    <div class="col-4">
                        <img src="https://concepto.de/wp-content/uploads/2019/07/bosque-templado-ecosistema-e1564522908407.jpg" alt="Desiertos" class="img-fluid" style="height: 200px; width: 600px">
                    </div>
                    <div class="col-8" style="text-align: justify">
                        <p class="text-white text-justify" style="margin-bottom: 80px">
                            Los bosques templados son ecosistemas donde las estaciones del año son marcadas y las especies herbívoras deben adaptarse a estos cambios. En estos bosques, animales como ciervos, alces, y conejos se alimentan de una variedad de vegetación, incluyendo hojas, cortezas y plantas herbáceas. Durante los meses más fríos, algunos herbívoros tienen que adaptarse a una dieta más limitada, recurriendo a la corteza de los árboles o a plantas subterráneas. En primavera y verano, su dieta se amplía con hojas frescas y frutas.
                        </p>
                    </div>
                </div>


                <h4 class="text-white">5. Praderas</h4>
                <div class="row">
                    <div class="col-4">
                        <img src="https://ecotrendies.com/wp-content/uploads/2018/12/animales-vegetacion-pradera.jpg" alt="Desiertos" class="img-fluid" style="height: 200px; width: 600px">
                    </div>
                    <div class="col-8" style="text-align: justify">
                        <p class="text-white text-justify">
                            En las praderas, los herbívoros como bisontes, caballos y vacas pastan en grandes áreas de césped. Las praderas ofrecen una rica fuente de pasto durante casi todo el año, pero los herbívoros deben enfrentar la competencia por los recursos. Estos animales suelen tener sistemas digestivos especializados, como los rumiantes, que les permiten extraer los nutrientes necesarios de las plantas fibrosas. Además, las grandes manadas de herbívoros ayudan a mantener la estructura del ecosistema al controlar el crecimiento de la vegetación y dispersar semillas.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
