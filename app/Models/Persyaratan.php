<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persyaratan extends Model
{
    protected $table = 'persyaratans';

    protected $fillable = [
        'judul',
        'keterangan',
        'urutan',
    ];
}
