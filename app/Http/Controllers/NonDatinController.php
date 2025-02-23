<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datin;

class NonDatinController extends Controller
{
    public function index()
    {
        $jumlah_datin = Datin::distinct('acc_num')->count('acc_num');
        return view('non-datin.non-datin')->with('jumlah_datin', $jumlah_datin);; // Sesuaikan dengan nama view yang Anda inginkan
    }
}
