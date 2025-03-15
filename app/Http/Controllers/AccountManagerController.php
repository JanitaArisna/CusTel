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

        return view('account-manager.business.business', compact('dataBusiness'));
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
        return view('account-manager.government.government', compact('dataGoverment'));
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
        return view('account-manager.enterprise.enterprise', compact('dataEnterprise'));
    }

    public function showBusiness($dataBusiness)
    {
        // Ambil data dari datin berdasarkan nama account manager
        $datinData = Datin::where('am_nm', $dataBusiness)->select('acc_num', 'cust_nm', 'sid')->get();

        // Ambil data dari nondatin berdasarkan nama account manager
        $nondatinData = NonDatin::where('manager', $dataBusiness)->select('cca', 'nama', 'snd')->get();

        // Gabungkan kedua data dalam satu response
        return view('account-manager.business.business-show', compact('datinData', 'nondatinData', 'dataBusiness'));
    }

    public function showGovernment($dataGoverment)
    {
        // Ambil data dari datin berdasarkan nama account manager
        $datinData = Datin::where('am_nm', $dataGoverment)->select('acc_num', 'cust_nm', 'sid')->get();

        // Ambil data dari nondatin berdasarkan nama account manager
        $nondatinData = NonDatin::where('manager', $dataGoverment)->select('cca', 'nama', 'snd')->get();

        // Gabungkan kedua data dalam satu response
        return view('account-manager.government.government-show', compact('datinData', 'nondatinData', 'dataGoverment'));
    }

    public function showEnterprise($dataEnterprise)
    {
        // Ambil data dari datin berdasarkan nama account manager
        $datinData = Datin::where('am_nm', $dataEnterprise)->select('acc_num', 'cust_nm', 'sid')->get();

        // Ambil data dari nondatin berdasarkan nama account manager
        $nondatinData = NonDatin::where('manager', $dataEnterprise)->select('cca', 'nama', 'snd')->get();

        // Gabungkan kedua data dalam satu response
        return view('account-manager.enterprise.enterprise-show', compact('datinData', 'nondatinData', 'dataEnterprise'));
    }
}

