<?php

use Illuminate\Database\Seeder;

class Cidade extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('cidades')->insert(['nome'=>'Volta Redonda', 'estado'=>'Rio de Janeiro','uf'=>'RJ']);
        DB::table('cidades')->insert(['nome'=>'Barra Mansa', 'estado'=>'Rio de Janeiro','uf'=>'RJ']);
    }
}
