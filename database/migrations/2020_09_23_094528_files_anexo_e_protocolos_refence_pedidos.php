<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FilesAnexoEProtocolosRefencePedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // code ... 
        // cria tabela FilesAnexoEProtocolosRefencePedidos 
        Schema::create('FilesAnexoEProtocolosRefencePedidos', function(Blueprint $table){

            $table->increments  ('id');
            $table->string      ('nome_arquivo');
            $table->string      ('path');
            $table->char        ('eprotocolo_foreign',12)->references('eProtocolo')->on('eProtocolo')->constrained();
            $table->string      ('PK_cpf__policial')->references('cpf')->on('policial');
            $table->char        ('hash', 255);

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
        // code ...
        Schema::drop('FilesAnexoEProtocolosRefencePedidos');

    }
}
