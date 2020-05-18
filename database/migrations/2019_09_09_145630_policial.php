<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Policial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('policial', function(Blueprint $table){
            $table->integer ('id'       );
            $table->string  ('cpf', 12  )->nullable();
            $table->primary ('cpf'      );
            $table->string  ('rg', 30       );
            $table->string  ('nome' , 50    );
            $table->string  ('unidade', 15  );
            $table->string  ('graduacao', 15);          

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
        Schema::drop('policial');
    }
}
