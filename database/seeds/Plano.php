<?php

use Illuminate\Database\Seeder;

class Plano extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('planos')->insert(['nome'=>'Trial 30 dias','descricao'=>'Plano Gold até 30 dias', 'duracao'=>'30', 'valor'=>'0']);
        DB::table('planos')->insert(['nome'=>'Bronze', 'descricao'=>'Mensalidade do Software WebSalão + Plano Básico','duracao'=>'365', 'valor'=>'59']);
        DB::table('planos')->insert(['nome'=>'Prata', 'descricao'=>'Mensalidade do Software WebSalão + Plano Intermediário', 'duracao'=>'365', 'valor'=>'99']);
        DB::table('planos')->insert(['nome'=>'Ouro', 'descricao'=>'Mensalidade do Software WebSalão + Plano Gold', 'duracao'=>'365', 'valor'=>'159']);
    }
}
