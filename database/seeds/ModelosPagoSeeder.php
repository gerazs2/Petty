<?php

use Illuminate\Database\Seeder;

class ModelosPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $date = new DateTime();
        DB::table('modelosPago')->insert([
            'nombre' => 'Por servicio',
            'descripcion' => 'Se cobrará un monto fijo por cada servicio contratado',
            'diasCorte' => '01',
            'diasLimite' => '10',
            'created_at' => $date
        ]);

        $date = new DateTime();
        DB::table('modelosPago')->insert([
            'nombre' => 'Membresia',
            'descripcion' => 'Se cobrará un monto fijo cada mes sin limite de servicios contratados',
            'diasCorte' => '01',
            'diasLimite' => '10',
            'created_at' => $date
        ]);
    }
}
