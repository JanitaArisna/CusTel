<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datin;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
    // Mencegah caching halaman dashboard

        
        $jumlah_datin = Datin::distinct('sid')->count('sid'); // Menghitung jumlah data Datin
        return view('dashboard')->with('jumlah_datin', $jumlah_datin); // Sesuaikan dengan nama view yang Anda inginkan

    }

}

        //return response()->view('dashboard')
            //->header('Cache-Control', 'no-store, no-cache, must-revalidate, proxy-revalidate')
            //->header('Pragma', 'no-cache')
           // ->header('Expires', '0')
            //->header('Surrogate-Control', 'no-store');