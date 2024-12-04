<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NonDatinController extends Controller
{
    public function index()
    {
        return view('non-datin.non-datin'); // Sesuaikan dengan nama view yang Anda inginkan
    }
}
