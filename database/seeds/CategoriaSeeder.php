<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new DateTime();
        for ($i = 0; $i < 20; $i++) {
            DB::table('categorias')->insert([
                //'id' => ($i + 1),
                'nombreCategoria' => 'nombreCat-' . Str::random(10),
                'descripcionCategoria' => Str::random(10) . '@gmail.com',
                'created_at' => $date,
                'updated_at' => $date,
                'deleted_at' => null
            ]);
        }
}
