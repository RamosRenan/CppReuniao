<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MembersRelatoresAndPresident extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('Members_Relatores_and_President', function(Blueprint $table){
            $table->increments  ('id'   );
            $table->string      ('nome' );
            $table->string      ('posto');
            $table->string      ('rg'   );
            $table->string      ('cpf'  );
            $table->string      ('qualificacao');
            $table->string      ('portariaCG');
            $table->date        ('datePortaria');
            $table->integer     ('id_membro'   )->unsigned()->nullable();
            $table->foreign     ('id_membro'   )->references('id')->on('users_ative_and_inative_cpp')->onDelete('Cascade');
           
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
        Schema::drop('Members_Relatores_and_President');

    }
}
