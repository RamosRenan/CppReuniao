<?php

namespace App\Models\FileAta;
use Illuminate\Database\Eloquent\Model;


class fileAta extends Model
{
    // code ...

    protected $table = ('fileAta');
    protected $fillable = ['name', 'responsavel', 'size', 'created_at', 'updated_at'];
}
