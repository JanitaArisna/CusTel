<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class datin extends Model
{
    use HasFactory;
    protected $fillable = ['acc_num', 'cust_nm', 'nipnas', 'segment_id', 'witel', 'sid', 'layanan_id', 'bw', 'kontrak', 'start', 'end', 'am_nm'];
    protected $table = 'datin';
    public $timestamps = false;
}