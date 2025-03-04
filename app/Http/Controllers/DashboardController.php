<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datin;
use App\Models\DatinBill;
use App\Models\NonDatin;
use App\Models\NonDatinBill;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_datin = Datin::distinct('sid')->count('sid'); // Menghitung jumlah data Datin
        $jumlah_non_datin = NonDatin::distinct('snd')->count('snd'); // Menghitung jumlah data NonDatin

        // Menghitung total jumlah data
        $total_jumlah = $jumlah_datin + $jumlah_non_datin;

        /*$jumalah_BillDatin = DatinBill::where('status', 'Bill')->count();
        $jumalah_BillNonDatin = NonDatinBill::where('status', 'Bill')->count();

        $jumalah_Bill = $jumalah_BillDatin + $jumalah_BillNonDatin;
        */

        return view('dashboard', compact('jumlah_datin', 'jumlah_non_datin', 'total_jumlah')); // Sesuaikan dengan nama view yang Anda inginkan

    }

}

        //return response()->view('dashboard')
            //->header('Cache-Control', 'no-store, no-cache, must-revalidate, proxy-revalidate')
            //->header('Pragma', 'no-cache')
           // ->header('Expires', '0')
            //->header('Surrogate-Control', 'no-store');