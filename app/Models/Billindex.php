<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Billindex extends Model
{
    use HasFactory;
    protected $fillable = ['acc_num', 'cust_nm', 'nipnas', 'segment_id', 'witel', 'sid', 'layanan_id', 'bw', 'kontrak', 'start', 'end', 'am_nm'];
    protected $table = 'datin';
    public $timestamps = false;
}
