<?php

namespace App\Models\Ata;

use Illuminate\Database\Eloquent\Model;

class ata extends Model
{
    //
    protected $table    = ('ata');
    protected $fillable = ['id', 'numero_ata', 'ata_finalizada', 'data_inicio', 'data_termino'];

    public function deliberacao(){
        return $this->hasMany('App\Models\Deliberacao\deliberacao');
    }
    
}#finall class ata
