<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class A44A extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('A_44_A', function(Blueprint $blueprint){

            $blueprint->increments  ('id');
            $blueprint->boolean     ('was_voted');
            $blueprint->string      ('eProtocolo', 12);
            $blueprint->bigInteger  ('id_response_relator');
            $blueprint->bigInteger  ('pertence_ata_num_ata');
            $blueprint->foreign     ('pertence_ata_num_ata')->references('numero_ata')->on('ata');
            $blueprint->string      ('id_policial', 12)->unsigned()->nullable();
            $blueprint->foreign     ('id_policial')->references('cpf')->on('policial')->onDelete('Cascade');
            $blueprint->bigInteger  ('num_44A')->nullable();
            $blueprint->text        ('descricao_pedido');
            $blueprint->string      ('condicao', 25)->nullable();
            $blueprint->string      ('deliberou_por', 25)->nullable();
            $blueprint->string      ('quorum',25)->nullable();
            $blueprint->string      ('votacao_comissao',25)->nullable();
            $blueprint->string      ('relator_opnou_por',25)->nullable();
            $blueprint->text        ('contain_delibercao')->nullable();
            $blueprint->text        ('descricao_parecer')->nullable();
            $blueprint->bigInteger  ('id_notification')->nullable();
            $blueprint->foreign     ('id_notification')->references('id_notification')->on('notification');


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
        Schema::drop('A_44_A');
    }
}
