<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatinBill extends Model
{
    protected $table = 'datin_bill';

    public function datin()
    {
        return $this->belongsTo(Datin::class, 'acc_num', 'acc_num');
    }

    protected $fillable = [
        'acc_num',
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
