<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JornadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jornadas')->insert([
            'entrada' => '13:00',
            'salida' => '20:00',
            'periodo' => '0',
            'horario_id' => '1',
            'created_at'   => date("Y-m-d H:i:s"),
            'updated_at'   => date("Y-m-d H:i:s"),
 
        ]);

        DB::table('jornadas')->insert([
            'entrada' => '06:00',
            'salida' => '12:00',
            'periodo' => '1',
            'horario_id' => '2',
            'created_at'   => date("Y-m-d H:i:s"),
            'updated_at'   => date("Y-m-d H:i:s"),
 
        ]);
    }
}
