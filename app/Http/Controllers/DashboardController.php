<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datin;
use App\Models\DatinBill;
use App\Models\NonDatin;
use App\Models\NonDatinBill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah data Datin
        $jumlah_datin = Datin::distinct('sid')->count('sid');

        // Menghitung jumlah data NonDatin
        $jumlah_non_datin = NonDatin::distinct('snd')->count('snd');

        // Menghitung total jumlah data Datin dan NonDatin
        $total_jumlah = $jumlah_datin + $jumlah_non_datin;

        // Menghitung total nilai dari januari sampai desember di tabel DatinBill
        $total_datin_bill = DB::table('datin_bill')
            ->select(DB::raw('SUM(januari + februari + maret + april + mei + juni + juli + agustus + september + oktober + november + desember) as total'))
            ->first()
            ->total;

        // Menghitung total nilai dari januari sampai desember di tabel NonDatinBill
        $total_non_datin_bill = DB::table('non_datin_bill')
            ->select(DB::raw('SUM(januari + februari + maret + april + mei + juni + juli + agustus + september + oktober + november + desember) as total'))
            ->first()
            ->total;

        // Jika tidak ada data, set total_datin_bill ke 0
        $total_datin_bill = $total_datin_bill ?? 0;

        // Jika tidak ada data, set total_non_datin_bill ke 0
        $total_non_datin_bill = $total_non_datin_bill ?? 0;

        // Menghitung total jumlah data Datin dan NonDatin
        $total_jumlah_bill = $total_datin_bill + $total_non_datin_bill;
        
        // Format nilai Rupiah
        $formatted_total_datin_bill = 'Rp' . number_format($total_datin_bill, 0, ',', '.');
        $formatted_total_non_datin_bill = 'Rp' . number_format($total_non_datin_bill, 0, ',', '.');
        $formatted_total_jumlah_bill = 'Rp' . number_format($total_jumlah_bill, 0, ',', '.');

        return view('dashboard', compact(
            'jumlah_datin',
            'jumlah_non_datin',
            'total_jumlah',
            'total_datin_bill', 
            'total_non_datin_bill',
            'total_jumlah_bill',
            'formatted_total_datin_bill',
            'formatted_total_non_datin_bill',
            'formatted_total_jumlah_bill'
        ));
    }
}

        //return response()->view('dashboard')
            //->header('Cache-Control', 'no-store, no-cache, must-revalidate, proxy-revalidate')
            //->header('Pragma', 'no-cache')
           // ->header('Expires', '0')
            //->header('Surrogate-Control', 'no-store');