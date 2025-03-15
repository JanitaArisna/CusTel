<?php

namespace App\Http\Controllers;

use App\Models\NonDatin;
use App\Models\Datin;
use Illuminate\Http\Request;

class AccountManagerController extends Controller
{
    public function index()
    {
        return view('account-manager.account-manager'); // Sesuaikan dengan nama view yang Anda inginkan
    }
    
    public function business()
    {
        // Daftar nama yang akan ditampilkan dalam tabel
        $managersBusiness = [
            'Ariesta Mirania Fabiola',
            'King Abdul Aziz',
            'Muhammad Rizky'
        ];

        // Ambil jumlah data di tabel dati dan non_datin berdasarkan am_num(datin) / manager(non_datin)
        $dataBusiness = collect($managersBusiness)->map(function ($name, $index) {
            return [
                'no' => $index + 1,
                'name' => $name,
                'datin' => Datin::where('am_nm', $name)->count() . ' Tabel',
                'non_datin' => NonDatin::where('manager', $name)->count() . ' Tabel',
            ];
        });

        return view('account-manager.business', compact('dataBusiness'));
    }

    public function government()
    {
        $managerGoverment = [
            'Oktorio Saragih',
            'Ismael Marzuki'
        ];

        $dataGoverment = collect($managerGoverment)->map(function ($name, $index) {
            return [
                'no' => $index + 1,
                'name' => $name,
                'datin' => Datin::where('am_nm', $name)->count() . ' Tabel',
                'non_datin' => NonDatin::where('manager', $name)->count() . ' Tabel',
            ];
        });
        return view('account-manager.government', compact('dataGoverment'));
    }

    public function enterprise()
    {
        $managerEnterprise = [
            'Tiara Wulandari'
        ];

        $dataEnterprise = collect($managerEnterprise)->map(function ($name, $index) {
            return [
                'no' => $index + 1,
                'name' => $name,
                'datin' => Datin::where('am_nm', $name)->count() . ' Tabel',
                'non_datin' => NonDatin::where('manager', $name)->count() . ' Tabel',
            ];
        });
        return view('account-manager.enterprise', compact('dataEnterprise'));
    }
}

