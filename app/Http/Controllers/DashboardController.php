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

        // Menghitung total nilai dari januari sampai desember di tabel DatinBill
        $total_datin_jan = DatinBill::sum('januari');
        $total_datin_feb = DatinBill::sum('februari');
        $total_datin_mar = DatinBill::sum('maret');
        $total_datin_apr = DatinBill::sum('april');
        $total_datin_mei = DatinBill::sum('mei');
        $total_datin_jun = DatinBill::sum('juni');
        $total_datin_jul = DatinBill::sum('juli');
        $total_datin_agu = DatinBill::sum('agustus');
        $total_datin_sep = DatinBill::sum('september');
        $total_datin_okt = DatinBill::sum('oktober');
        $total_datin_nov = DatinBill::sum('november');
        $total_datin_des = DatinBill::sum('desember');

        // Menghitung total nilai dari januari sampai desember di tabel NonDatinBill
        $total_non_datin_jan = NonDatinBill::sum('januari');
        $total_non_datin_feb = NonDatinBill::sum('februari');
        $total_non_datin_mar = NonDatinBill::sum('maret');
        $total_non_datin_apr = NonDatinBill::sum('april');
        $total_non_datin_mei = NonDatinBill::sum('mei');
        $total_non_datin_jun = NonDatinBill::sum('juni');
        $total_non_datin_jul = NonDatinBill::sum('juli');
        $total_non_datin_agu = NonDatinBill::sum('agustus');
        $total_non_datin_sep = NonDatinBill::sum('september');
        $total_non_datin_okt = NonDatinBill::sum('oktober');
        $total_non_datin_nov = NonDatinBill::sum('november');
        $total_non_datin_des = NonDatinBill::sum('desember');

        return view('dashboard', compact(
            'jumlah_datin', 'jumlah_non_datin', 'total_jumlah',
            'total_datin_bill', 'total_non_datin_bill', 'total_jumlah_bill',
            'formatted_total_datin_bill', 'formatted_total_non_datin_bill', 'formatted_total_jumlah_bill',
            'total_datin_jan', 'total_datin_feb', 'total_datin_mar', 'total_datin_apr', 'total_datin_mei', 'total_datin_jun',
            'total_datin_jul', 'total_datin_agu', 'total_datin_sep', 'total_datin_okt', 'total_datin_nov', 'total_datin_des',
            'total_non_datin_jan', 'total_non_datin_feb', 'total_non_datin_mar', 'total_non_datin_apr', 'total_non_datin_mei', 'total_non_datin_jun',
            'total_non_datin_jul', 'total_non_datin_agu', 'total_non_datin_sep', 'total_non_datin_okt', 'total_non_datin_nov', 'total_non_datin_des'
        ));
    }
}

        //return response()->view('dashboard')
            //->header('Cache-Control', 'no-store, no-cache, must-revalidate, proxy-revalidate')
            //->header('Pragma', 'no-cache')
           // ->header('Expires', '0')
            //->header('Surrogate-Control', 'no-store');