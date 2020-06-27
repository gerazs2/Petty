<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SepomexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        //
        libxml_use_internal_errors(true);
		$xml = simplexml_load_file(realpath(dirname(__FILE__)).'/../../storage/sepomex/codigosPostales.xml');
		foreach ($xml as $obj) {
			$date = new DateTime();
	        DB::table('sepomex')->insert([
	            'cp' => $obj->d_codigo,
	            'asentamiento' => $obj->d_asenta,
	            'tipoAsentamiento' => $obj->d_tipo_asenta,
	            'municipio' => $obj->D_mnpio,
	            'estado' => $obj->d_estado,
	            'ciudad' => $obj->d_ciudad,
	            'pais' => 'México',
	            'created_at' => $date
	        ]);
		}

    }
}
