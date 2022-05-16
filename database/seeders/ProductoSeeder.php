<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fecha = date('y/m/d');
        $datos = [ 
            ['id' => 1,
            'nombre' => 'Martillo',
            'descripción' => 'Martillo de acero',
            'precio' => 200,
            'consignar'=>1,
            'existencia'=>200,
            'pendientes'=>0],
            ['id' => 2,
            'nombre' => 'Escalera',
            'descripción' => 'Escalera de aluminio',
            'precio' => 400,
            'consignar'=>1,
            'existencia'=>200,
            'pendientes'=>0],
            ['id' => 3,
            'nombre' => 'Playera polo',
            'descripción' => 'Playera polo lacoste',
            'precio' => 500,
            'consignar'=>1,
            'existencia'=>200,
            'pendientes'=>0],
            ['id' => 4,
            'nombre' => 'Playera',
            'descripción' => 'Playera Jhon Leopard',
            'precio' => 200,
            'consignar'=>1,
            'existencia'=>200,
            'pendientes'=>0]
            
        ];
        \DB::table('productos')->insert($datos);
    }
}
