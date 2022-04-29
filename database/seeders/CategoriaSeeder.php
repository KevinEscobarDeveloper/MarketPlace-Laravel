<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $datos = [ 
            ['id' => 1,
            'nombre' => 'Herramientas',
            'descripción' => 'Herramientas libres y/o utilidades ',
            // 'imagen' => public_path('storage/categoria/herramientas.png'),
            'imagen' => ('/storage/categoria/herramientas.png'),
            'activa' => 1],
            ['id' => 2,
            'nombre' => 'Ropa',
            'descripción' => 'Ropa con nuevos estilos novedosos,de colores llamativos y de hermosos acabados.',
            'imagen' => ('/storage/categoria/ropa.png'),
            'activa' => 1],
            ['id' => 3,
            'nombre' => 'Alimentos',
            'descripción' => 'Articulos de alimentos como comidas, bebidas y conservas.',
            'imagen' => ('/storage/categoria/supermercado.png'),
            'activa' => 1],
            ['id' => 4,
            'nombre' => 'Muebles',
            'descripción' => 'Diferentes tipos de mobiliarios escritorios y mesas para oficina.',
            'imagen' => ('/storage/categoria/muebles.png'),
            'activa' => 1]
            
        ];
        \DB::table('categorias')->insert($datos);
    }
}
