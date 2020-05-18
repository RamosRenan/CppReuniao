<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ata', function(Blueprint $table){
            $table->increments  ('id'                );
            $table->integer     ('numero_ata'        );
            $table->primary     ('numero_ata'        );
            $table->string      ('ata_finalizada',  5)->nullable();
            $table->bigInteger  ('response_finalized_ata')->nullable();
            $table->date        ('data_inicio'       )->nullable();
            $table->date        ('data_termino'      )->nullable();
            $table->text        ('TERMO_ENCERRAMENTO_REUNIAO')->nullable();
            $table->text        ('INTRODUCAO_REAUNIAO_ORDINARIA')->nullable();
           
            $table->timestamps();
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
        Schema::drop('ata');
    }
}
