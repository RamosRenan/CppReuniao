<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EProtocolo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('eProtocolo', function(Blueprint $table){
            $table->integer('id');
            $table->string      ('cpf', 14)->unsigned();
            $table->foreign     ('cpf')->references('cpf')->on('policial')->onDelete('cascade');

            $table->string   ('eProtocolo', 12        );
            $table->primary  ('eProtocolo'           );
            $table->string   ('pedido',  120         );
            $table->longText ('conteudo'             );
            $table->string   ('status', 11           );
            $table->date     ('entry_system_data'    );
            $table->date     ('data_eProtocolo'      );
            $table->string   ('codigopedido', 12      );
            $table->integer  ('id_responsavel_cadastro');

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
        Schema::drop('eProtocolo');
    }
}
