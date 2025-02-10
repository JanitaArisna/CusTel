<?php

namespace App\Http\Controllers\Datin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\datin;
use App\Models\Assets; // Pastikan model Asset diimpor jika Anda menggunakannya
use Illuminate\Http\Request;

class AssetsDatinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showAssets($acc_num)
    {
        // Ambil data assets berdasarkan account number
        $data = Assets::where('acc_num', $acc_num)->get();

        // Kirim data ke view
        return view('datin.assets.assets-datin', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**public function edit($sid)
     */
    public function edit(string $id)
    {
        /** $data = Assets::where('sid', $sid)->firstOrFail();
        return view('datin.assets.assets-edit', compact('data')); */

        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/datin');
        }
        $data = datin::where('sid', $id)->first();
        return view('datin.edit')->with('data', $data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'acc_num' => 'required',
            'cust_nm' => 'required',
            'nipnas' => 'required',
            'segment_id' => 'required',
            'witel' => 'required',
            'layanan_id' => 'required',
            'bw' => 'required',
            'kontrak' => 'required',
            'start' => 'required',
            'end' => 'required',
            'am_nm' => 'required',
        ], [
            'acc_num.required' => 'Account Number wajib diisi',
            'cust_nm.required' => 'Customer Name wajib diisi',
            'nipnas.required' => 'NIP/NAS wajib diisi',
            'segment_id.required' => 'Segment wajib diisi',
            'witel.required' => 'Witel wajib diisi',
            'layanan_id.required' => 'Layanan wajib diisi',
            'bw.required' => 'Bandwidth wajib diisi',
            'kontrak.required' => 'Kontrak wajib diisi',
            'start.required' => 'Start wajib diisi',
            'end.required' => 'End wajib diisi',
            'am_nm.required' => 'Account Manager wajib diisi',
        ]);
        $data = [
            'acc_num' => $request->acc_num,
            'cust_nm' => $request->cust_nm,
            'nipnas' => $request->nipnas,
            'segment_id' => $request->segment_id,
            'witel' => $request->witel,
            'layanan_id' => $request->layanan_id,
            'bw' => $request->bw,
            'kontrak' => $request->kontrak,
            'start' => $request->start,
            'end' => $request->end,
            'am_nm' => $request->am_nm,
        ];
        
        Assets::where('sid', $id)->update($data);
        return redirect()->route('datin')->with('success', 'Data berhasil diupdate');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mengecek apakah user sudah login dan memiliki role 'admin'
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            // Jika user belum login atau bukan admin, arahkan ke halaman '/datin'
            return redirect('/datin');
        } else {
            // Mengambil data asset berdasarkan 'sid' (id yang diberikan)
            $data = Assets::where('sid', $id)->first();
            
            // Jika asset ditemukan, hapus data tersebut
            if ($data) {
                $acc_num = $data->acc_num; // Ambil nilai acc_num dari asset yang ditemukan
                $data->delete(); // Hapus data asset
                
                // Setelah berhasil menghapus, arahkan ke URL dengan acc_num yang sesuai
                // Gunakan URL generator, bukan query string
                return redirect("/datin/{$acc_num}/assets")
                                ->with('success', 'Data berhasil dihapus');
            } else {
                // Jika data asset tidak ditemukan
                return redirect('/datin')->with('error', 'Data tidak ditemukan');
            }
        }
    }


public function index($acc_num)
{
    // Ambil semua data asset dengan acc_num tertentu
    $assets = Assets::where('acc_num', $acc_num)->get();
    return view('assets.index', compact('assets', 'acc_num'));
}


}
