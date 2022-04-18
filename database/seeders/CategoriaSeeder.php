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
            'id' => 1,
            'nombre' => 'Herramientas',
            'descripción' => 'Herramientas libres y/o utilidades ',
            // 'imagen' => public_path('storage/categoria/herramientas.png'),
            'imagen' => ('/storage/categoria/herramientas.png'),
            'activa' => 1
        ];
        \DB::table('categorias')->insert($datos);
    }
}
