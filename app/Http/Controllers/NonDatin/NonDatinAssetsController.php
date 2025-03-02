<?php

namespace App\Http\Controllers\NonDatin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NonDatin;
use Illuminate\Support\Facades\Auth;

class NonDatinAssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($cca)
    {
        // Pastikan user sudah login dan memiliki peran sebagai admin
        $data = NonDatin::where('cca', $cca)->get(); // Ambil semua data dengan CCA yang sama
        return view('non-datin.non-assets.non-assets', compact('data', 'cca'));

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
    public function show()
    {
        /**$data = NonDatin::where('cca', $cca)->get(); // Ambil semua data dengan CCA yang sama
        return view('non-datin.non-assets.non-assets', compact('data'));   */
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($cca, $snd)
    {
        $data = NonDatin::where('cca', $cca)->where('snd', $snd)->firstOrFail();
        return view('non-datin.non-assets.non-assets-edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $cca, $snd)
    {
        // Debugging: Cek apakah request masuk
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/non-datin');
        }
        
        $request->validate([
            'snd_g' => 'required',
            'ncli' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'sto' => 'required',
            'segment_non' => 'required',
            'produk' => 'required',
            'desc_newbill' => 'required',
            'bundling' => 'required',
            'start' => 'required|date',
            'end' => 'required|date',
            'manager' => 'required',
        ]);

        $data = NonDatin::where('cca', $cca)->where('snd', $snd)->firstOrFail();
        $data->update([
            'snd_g' => $request->snd_g,
            'ncli' => $request->ncli,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'sto' => $request->sto,
            'segment_non' => $request->segment_non,
            'produk' => $request->produk,
            'desc_newbill' => $request->desc_newbill,
            'bundling' => $request->bundling,
            'start' => $request->start,
            'end' => $request->end,
            'manager' => $request->manager,
        ]);

        return redirect()->route('non-datin.assets.index', ['cca' => $cca])
            ->with('success', 'Data berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cca, $snd)
    {
        // Cek apakah user sudah login dan memiliki peran sebagai admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/non-datin');
        }

        // Cari data berdasarkan SND
        $data = NonDatin::where('snd', $snd)->where('cca', $cca)->first();

        if ($data) {
            $data->delete(); // Hapus data

            // Redirect ke halaman asset sesuai dengan CCA dengan pesan sukses
            return redirect()->route('non-datin.assets.index', ['cca' => $cca])
                ->with('success', 'Data berhasil dihapus');
        } 

        // Redirect jika data tidak ditemukan dengan pesan error
        return redirect()->route('non-datin.assets.index', ['cca' => $cca])
            ->with('error', 'Data tidak ditemukan.');
    }
}