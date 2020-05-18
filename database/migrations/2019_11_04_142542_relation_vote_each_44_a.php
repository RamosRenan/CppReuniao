<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelationVoteEach44A extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('relation_vote_each_44A', function(Blueprint $table){
            
            $table->bigInteger('id' );
            $table->foreign('id')->references('id')->on('A_44_A');
            $table->bigInteger('id_membro');
            $table->bigInteger('secretario_desta_deliberacao')->nullable();
            $table->bigInteger('presidente_desta_deliberacao')->nullable();
            $table->boolean('votou_contra')->nullable();
            $table->boolean('votou_favoravel')->nullable();
            $table->boolean('is_relator_from_this_pedido')->nullable();
           
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
        Schema::drop('relation_vote_each_44A');
    }

}# class RelationVoteEach44A
 