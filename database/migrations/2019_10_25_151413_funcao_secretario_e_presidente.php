<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FuncaoSecretarioEPresidente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {    
            Schema::create('secretario_e_presidente', function(Blueprint $blueprint){

            $blueprint->increments  ('id');
            $blueprint->string      ('nome' );
            $blueprint->string      ('posto');
            $blueprint->string      ('rg'   );
            $blueprint->string      ('cpf'  );
            $blueprint->string      ('qualificacao');
            $blueprint->boolean     ('staus');
            $blueprint->integer     ('id_membro'   )->unsigned();
            $blueprint->foreign     ('id_membro'   )->references('id')->on('users');

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
        Schema::drop('secretario_e_presidente');
    }

}#FuncaoSecretarioEPresidente
