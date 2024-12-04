<?php

// app/Http/Controllers/DatinController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatinController extends Controller
{
    public function index()
    {
        return view('datin.datin'); // Sesuaikan dengan nama view yang Anda inginkan
    }
}

