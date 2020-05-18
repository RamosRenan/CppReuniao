<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Deliberacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('deliberacao', function(Blueprint $table){

            $table->Increments ('id'              );
            $table->bigIncrements('id_notification'              )->nullable();
            $table->string     ('eProtocolo', 12  )->unsigned();
            $table->foreign    ('eProtocolo'      )->references('eProtocolo')->on('eProtocolo_sorteados')->onDelete('Cascade');
            $table->integer    ('numero_ata'      )->unsigned();
            $table->foreign    ('numero_ata'      )->references('numero_ata')->on('ata')->onDelete('Cascade');
            $table->integer    ('num_deliberacao' )->nullable();
            $table->text       ('deliberacao')->nullable();
            $table->date       ('date_create_deliberacao')->nullable();
            $table->string     ('presidente_response', 30)->nullable();
            $table->string     ('response_secretary', 30)->nullable();
            $table->string     ('condicao_this_deliberacao', 12)->nullable();
           
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
        Schema::drop('deliberacao');
    }
}
