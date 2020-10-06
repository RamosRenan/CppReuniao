<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FileAta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('fileAta', function(Blueprint $table){
            
            $table->primary('id' );
            $table->bigInteger('name')->nullable();
            $table->bigInteger('size')->nullable();
            $table->bigInteger('responsavel')->nullable();
            
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
        Schema::drop('fileAta');

    }
}
