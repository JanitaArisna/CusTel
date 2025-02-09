<?php

namespace App\Http\Controllers\Datin;

use App\Http\Controllers\Controller;
use App\Models\datin; // Pastikan model Asset diimpor jika Anda menggunakannya
use Illuminate\Http\Request;

class AssetsDatinController extends Controller
{
    // Method untuk menampilkan data assets
    public function showAssets($acc_num)
    {
        // Ambil data assets berdasarkan account number
        $data = datin::where('acc_num', $acc_num)->get();

        // Kirim data ke view
        return view('datin.assets.assets-datin', compact('data'));
    }
}
