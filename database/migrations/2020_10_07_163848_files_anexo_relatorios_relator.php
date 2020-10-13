<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FilesAnexoRelatoriosRelator extends Migration
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
        Schema::create('files_anexo_relatorios_relator', function(Blueprint $table){

            $table->increments  ('id');
            $table->string      ('nome_arquivo');
            $table->string      ('path');
            $table->char        ('eprotocolo',12);
            $table->string      ('FK_relator')->references('has_user_id')->on('users_ative_and_inative_cpp');
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
        Schema::drop('files_anexo_relatorios_relator');

    }
}
