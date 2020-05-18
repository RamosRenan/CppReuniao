<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;

class EProtocolosSorteados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //OBS.: PERMITIR NULL NAS COLUNAS
        Schema::create('eProtocolo_sorteados', function(Blueprint $table){

            $table->increments ('id');
            $table->integer ('id_eProtocolo_sorteados');
            $table->string  ('eProtocolo', 12  )->unsigned();
            $table->foreign ('eProtocolo'  )->references('eProtocolo')->on('eProtocolo')->onDelete('cascade');
            $table->primary ('eProtocolo'  );
            $table->string ('deliberou_por', 50);
            $table->string ('quorum' ,50 );
            $table->string ('votacao_comissao', 50  );

            $table->bigInteger ('id_membro');

            $table->longText   ('parecer_relator'   )->nullable($value = true);
            $table->string     ('relator_opnou_por' )->nullable($value = true);
            $table->string     ('relator_votou', 5  )->nullable($value = true);

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
        Schema::drop('eProtocolos_sorteados');
    }	
}
