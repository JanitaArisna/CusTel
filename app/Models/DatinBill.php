<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatinBill extends Model
{
    protected $table = 'datin_bill';

    public function datin()
    {
        return $this->belongsTo(Datin::class, 'sid', 'sid');
    }

    protected $fillable = [
        'sid',
        'januari',
        'februari',
        'maret',
        'april',
        'mei',
        'juni',
        'juli',
        'agustus',
        'september',
        'oktober',
        'november',
        'desember',
        'tahun',
    ];
}
