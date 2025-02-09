<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    use HasFactory;
    protected $table = 'datin';
    protected $fillable = [
        'acc_num', 
        'cust_nm', 
        'nipnas', 
        'segment_id', 
        'witel', 
        'sid', 
        'layanan_id', 
        'bw', 
        'kontrak', 
        'start', 
        'end', 
        'am_nm'
    ];
}
