<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NonDatinBill extends Model
{
    protected $table = 'non_datin_bill';
    protected $fillable = [
        'snd',
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

    public function nonDatin()
    {
        return $this->belongsTo(NonDatin::class, 'snd', 'snd');
    }
}
