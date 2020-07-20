<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersAtiveAndInativeCpp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('users_ative_and_inative_cpp', function(Blueprint $table){

            $table->increments  ('id');
            $table->bigInteger  ('has_user_id');
            $table->integer     ('id_roles_permission')->nullable();
            $table->integer     ('user_id_your_status')->nullable();
            $table->string      ('who_alter_status_user');
            
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
        schema::drop('users_ative_and_inative_cpp');
    }
}
