<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('news')->insert([
            [
                'id' => 1,
                'title' => 'El manga Jujutsu Kaisen finalizará este año',

                'resume' => 'Una filtración de la octava edición de este año de la revista Weekly Shonen Jump,reveló que Gege Akutami, creador manga Jujutsu Kaisen, tiene planeado terminar la serialización de la obra este año.',

                'article' => 'Una filtración de la octava edición de este año de la revista Weekly Shonen Jump, específicamente de la sección de comentarios, reveló que Gege Akutami, creador del mundialmente popular manga Jujutsu Kaisen, tiene planeado terminar la serialización de la obra este año. Como se acostumbra, estos mensajes son bastante cortos, y el de Akutami escribió: «Feliz Año Nuevo. Espero terminar la historia este año».

                De hecho, Gege Akutami ya había comentado durante la el evento Jump Festa 2023 sus planes de terminar la historia un año a partir de la fecha en cuestión. Además, en febrero de 2021 también había hecho la declaración de que finalizaría su obra “en dos años a partir de entonces”. Sin embargo, esta vez no hay lugar a la interpretación, puesto que el autor ha dejado bastante claro su mensaje.',

                'image' => 'noticiaJujutsuKaisen.jpg',
                'image_description' => "portada de jujutsu kaisen",
                'release_date' => '2022-12-22',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'title' => 'Bocchi the Rock! habría impulsado las ventas de guitarras negras',

                'resume' => 'En el ranking de los artículos más vendidos de un sitio web de compras y otros servicios en Japón, ¡resulta que todas las guitarras de las primeras ocho posiciones son de color negro!',

                'article' => 'Si bien la adaptación al anime de Bocchi the Rock! ya ha finalizado, todavía hay muchos artículos de interés que surgen en Japón y que demuestran el éxito del que todavía goza la franquicia. Cabe señalar que aunque un anime termine, las ventas que haga fuera de su emisión todavía se incluyen dentro de la definición de “anime exitoso” e incluyen álbumes musicales, paquetes físicos Blu-ray/DVD y demás mercancía surgida de alguna colaboración.

                En foros de comentarios japoneses han surgido una variedad de publicaciones destacando este tipo de palmarés de la franquicia. Para comenzar, resulta que el manga original de Bocchi the Rock! pudo colarse entre las veinte franquicias con las mejores ventas en el mes de diciembre de 2022, con 202,481 copias vendidas.
                
                Evidentemente este número palidece ante Blue Lock, Jujutsu Kaisen, Chainsaw Man y Slam Dunk, que tuvieron más de 1 millón de copias vendidas cada uno. Sin embargo, no hay que olvidar que Bocchi the Rock! era un manga que pasaba completamente desapercibido hasta entonces, y que no lanzó un nuevo volumen en el mencionado mes.
                
                Por otra parte, Billboard Japan reportó que, de la semana comprendida del 26 de diciembre de 2022 al 1 de enero de 2023 en Japón, el álbum musical de la franquicia de Bocchi the Rock!, titulado como “Kessoku Band” (sí, igual que la banda protagonista), tomó la primera posición del listado con un total de 73,244 copias vendidas. No hay que olvidar que esta también fue su primera semana en el mercado, por lo que el número es bastante alto (por favor, recuerde que “sencillo” es completamente diferente a “álbum”, si es que piensa hacer un comentario).

                Cabe recordar que este mismo álbum musical ya había tomado la primera posición en la lista semanal de álbumes más descargados de acuerdo con la Billboard Japan. El álbum musical de la Kessoku Band debutó en lo más alto de la lista del 21 al 28 de diciembre, entrando el mismo día de su lanzamiento.
                
                Y para terminar, un dato que es más una curiosidad que nada. Yendo al portal de “Kakaku.com, Inc.“, un sitio web de comparación de compras y otros servicios en Japón, y escribiendo la búsqueda “Guitarra (ギター)“, notaremos una tendencia bastante particular. En el ranking de los artículos más vendidos, ¡resulta que todas las guitarras de las primeras ocho posiciones son de color negro! Y, ¿sabes quién tuvo una guitarra eléctrica de color negro recientemente? ¡Así es, la Bocchi Rosada! Por supuesto, es posible que todo sea una coincidencia, pero no deja de ser interesante.',

                'image' => 'noticiaBocchiTheRock.jpg',
                'image_description' => "portada de bocchi de rock",
                'release_date' => '2022-11-11',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);        
    }
}
