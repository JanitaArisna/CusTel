<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonDatin extends Model
{
    use HasFactory;

    protected $table = 'non_datin';
    protected $fillable = [
        'cca',
        'snd',
        'snd_g',
        'ncli',
        'nama',
        'alamat',
        'sto',
        'segment_non',
        'produk',
        'desc_newbill',
        'bundling',
        'start',
        'end',
    ];
}
