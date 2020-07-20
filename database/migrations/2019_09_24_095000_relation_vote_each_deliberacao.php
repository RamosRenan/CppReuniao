<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelationVoteEachDeliberacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('relation_vote_each_deliberacao', function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_deliberacao')->unsigned()->nullable();
            $table->foreign('id_deliberacao')->references('id')->on('deliberacao')->onDelete('Cascade');
            $table->string('eProtocolo', 12)->nullable();
            $table->bigInteger('id_membro'     );
            $table->bigInteger('secretario_desta_deliberacao')->nullable();
            $table->bigInteger('presidente_desta_deliberacao')->nullable();
            $table->string('was_voted', 5   );
            $table->string('votou_contra', 5   )->nullable();
            $table->string('votou_favoravel', 5   )->nullable();
            $table->string('is_relator_from_this_pedido', 5   )->nullable();
           

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
        Schema::drop('relation_vote_each_deliberacao');
    }
}
