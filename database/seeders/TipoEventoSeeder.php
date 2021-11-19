<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoEventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_eventos')->insert([
            'nombre' => 'Licencia por maternidad/paternidad',
            'general' => false,
            'general' => false,
            'created_at'   => date("Y-m-d H:i:s"),
            'updated_at'   => date("Y-m-d H:i:s"),
 
        ]);

        DB::table('tipo_eventos')->insert([
            'nombre' => 'Licencia por enfermedad',
            'general' => false,
            'general' => false,
            'created_at'   => date("Y-m-d H:i:s"),
            'updated_at'   => date("Y-m-d H:i:s"),
 
        ]);

        DB::table('tipo_eventos')->insert([
            'nombre' => 'Licencia por matrimonio',
            'general' => false,
            'general' => false,
            'created_at'   => date("Y-m-d H:i:s"),
            'updated_at'   => date("Y-m-d H:i:s"),
 
        ]);

        DB::table('tipo_eventos')->insert([
            'nombre' => 'Licencia por fallecimiento',
            'general' => false,
            'general' => false,
            'created_at'   => date("Y-m-d H:i:s"),
            'updated_at'   => date("Y-m-d H:i:s"),
 
        ]);

        DB::table('tipo_eventos')->insert([
            'nombre' => 'Licencia por motivos personales',
            'general' => false,
            'general' => false,
            'created_at'   => date("Y-m-d H:i:s"),
            'updated_at'   => date("Y-m-d H:i:s"),
 
        ]);

        DB::table('tipo_eventos')->insert([
            'nombre' => 'Vacaciones',
            'general' => false,
            'general' => false,
            'created_at'   => date("Y-m-d H:i:s"),
            'updated_at'   => date("Y-m-d H:i:s"),
 
        ]);

        DB::table('tipo_eventos')->insert([
            'nombre' => 'Asistencia',
            'general' => false,
            'general' => false,
            'created_at'   => date("Y-m-d H:i:s"),
            'updated_at'   => date("Y-m-d H:i:s"),
 
        ]);

        DB::table('tipo_eventos')->insert([
            'nombre' => 'Feriado',
            'general' => true,
            'general' => false,
            'created_at'   => date("Y-m-d H:i:s"),
            'updated_at'   => date("Y-m-d H:i:s"),
 
        ]);

        DB::table('tipo_eventos')->insert([
            'nombre' => 'Fecha de Entrega',
            'general' => false,
            'created_at'   => date("Y-m-d H:i:s"),
            'updated_at'   => date("Y-m-d H:i:s"),
 
        ]);

        DB::table('tipo_eventos')->insert([
            'nombre' => 'Otro',
            'general' => false,
            'created_at'   => date("Y-m-d H:i:s"),
            'updated_at'   => date("Y-m-d H:i:s"),
 
        ]);
    }
}
