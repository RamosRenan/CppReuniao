<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HomologPontosPositivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('homlog_pontos_positivos', function(Blueprint $blueprint){

            $blueprint->increments  ('id');
            $blueprint->string      ('id_policial', 12)->unsigned()->nullable();
            $blueprint->foreign     ('id_policial')->references('cpf')->on('policial');
            $blueprint->string      ('key_inciso', 5);
            $blueprint->string      ('eProtocolo', 12);
            $blueprint->string      ('qtd_pontos');
            $blueprint->integer     ('pertence_ata');
            $blueprint->integer     ('identifier_in_ata');
            $blueprint->string      ('universidade', 100);
            $blueprint->string      ('curso', 100);
            $blueprint->string      ('distincao', 18);
            $blueprint->date        ('data_do_registro_eProtocolo');
            $blueprint->date        ('inicio_do_curso');
            $blueprint->date        ('termino_do_curso');
            $blueprint->text        ('contain_oficial_homolocao');
            $blueprint->text        ('descricao_da_homologacao');
            $blueprint->text        ('cursos_e_participacoes');
                        


            $blueprint->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('homlog_pontos_positivos');
    }
}
