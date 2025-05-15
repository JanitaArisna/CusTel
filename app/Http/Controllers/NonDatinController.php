<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\NonDatin;
use App\Models\NonAssets;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;


class NonDatinController extends Controller
{
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $filter = $request->filter;
        $bulan = $request->bulan;
        $jumlahbaris = 10;

        // Mapping nama bulan ke angka
        $bulanMap = [
            'januari' => 1, 'februari' => 2, 'maret' => 3,
            'april' => 4, 'mei' => 5, 'juni' => 6,
            'juli' => 7, 'agustus' => 8, 'september' => 9,
            'oktober' => 10, 'november' => 11, 'desember' => 12
        ];

        $query = NonDatin::query();

        // Filter bulan: dilakukan dulu sebelum pengelompokan
        if ($filter === 'bulan' && $bulan && isset($bulanMap[$bulan])) {
            $query->whereMonth('start', $bulanMap[$bulan]);
        }
        // Filter berdasarkan kata kunci    
        if (strlen($katakunci)) {
            $data = NonDatin::whereIn('id', function ($query) use ($katakunci) {
                $query->selectRaw('MIN(id)')
                    ->from('non_datin')
                    ->where('cca', 'like', "%$katakunci%")
                    ->orWhere('snd', 'like', "%$katakunci%")
                    ->orWhere('nama', 'like', "%$katakunci%")
                    ->orWhere('ncli', 'like', "%$katakunci%")
                    ->orWhere('sto', 'like', "%$katakunci%")
                    ->orWhere('segment_non', 'like', "%$katakunci%")
                    ->orWhere('desc_newbill', 'like', "%$katakunci%")
                    ->groupBy('cca');
            });
        }

        // Ambil hanya 1 record per cca setelah semua filter
        $query->whereIn('id', function ($sub) use ($filter, $bulanMap, $bulan, $katakunci) {
            $sub->selectRaw('MIN(id)')
                ->from('non_datin');

            // Filter bulan di subquery
            if ($filter === 'bulan' && $bulan && isset($bulanMap[$bulan])) {
                $sub->whereMonth('start', $bulanMap[$bulan]);
            }

            // Filter kata kunci di subquery
            if (strlen($katakunci)) {
                $sub->where(function ($q) use ($katakunci) {
                    $q->where('cca', 'like', "%$katakunci%")
                    ->orWhere('snd', 'like', "%$katakunci%")
                    ->orWhere('nama', 'like', "%$katakunci%")
                    ->orWhere('ncli', 'like', "%$katakunci%")
                    ->orWhere('sto', 'like', "%$katakunci%")
                    ->orWhere('segment_non', 'like', "%$katakunci%")
                    ->orWhere('desc_newbill', 'like', "%$katakunci%");
                });
            }

            $sub->groupBy('cca');
        });

        // Urutan data
        if ($filter === 'pelanggan') {
            $query->orderBy('start', 'asc');
        } else {
            $query->orderBy('start', 'asc');
        }

        $data = $query->paginate($jumlahbaris);
        $assetsData = NonDatin::select('cca', 'snd', 'ncli', 'nama', 'alamat', 'sto', 'segment_non', 'desc_newbill')->get();

        return view('non-datin.main.index',compact('data', 'assetsData'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/non-datin');
        }

        return view('non-datin.main.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('cca', $request->cca);
        Session::flash('snd', $request->snd);
        Session::flash('snd_g', $request->snd_g);
        Session::flash('ncli', $request->ncli);
        Session::flash('nama', $request->nama);
        Session::flash('alamat', $request->alamat);
        Session::flash('sto', $request->sto);
        Session::flash('segment_non', $request->segment_non);
        Session::flash('produk', $request->produk);
        Session::flash('desc_newbill', $request->desc_newbill);
        Session::flash('bundling', $request->bundling);
        Session::flash('start', $request->start);
        Session::flash('manager', $request->manager);
        
        $request->validate([
            'cca' => 'required',
            'snd' => 'required|numeric|unique:non_datin,snd',
            'snd_g' => 'required',
            'ncli' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'sto' => 'required',
            'segment_non' => 'required',
            'produk' => 'required',
            'desc_newbill' => 'required',
            'bundling' => 'required',
            'start' => 'required',
            'manager' => 'required',
        ],[
            'cca.required' => 'Mohon isi bidang CCA.',
            'snd.required' => 'Mohon isi bidang SND.',
            'snd.unique' => 'SND ini sudah terdaftar, silakan gunakan SND lain.',
            'snd_g.required' => 'Mohon isi bidang SND G.',
            'ncli.required' => 'Mohon isi bidang NCLI.',
            'nama.required' => 'Mohon isi bidang Nama.',
            'alamat.required' => 'Mohon isi bidang Alamat.',
            'sto.required' => 'Mohon isi bidang STO.',
            'segment_non.required' => 'Mohon isi bidang Segment.',
            'produk.required' => 'Mohon isi bidang Produk.',
            'desc_newbill.required' => 'Mohon isi bidang Deskripsi Newbill.',
            'bundling.required' => 'Mohon isi bidang Bundling.',
            'start.required' => 'Mohon isi tanggal mulai.',
            'manager.required' => 'Mohon isi bidang Manager.',
        ]);

        $data = [
            'cca' => $request->cca,
            'snd' => $request->snd,
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
            'manager' => $request->manager,
        ];
        NonDatin::create($data);
        return redirect('/non-datin')->with('success_nondatin', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $cca)
    {

        $filter = $request->filter;
        $bulan = $request->bulan;

        $query = NonAssets::where('cca', $cca);

        // Jika filter bulan diaktifkan (datang dari index dengan filter bulan)
        if ($filter === 'bulan' && $bulan) {
            $bulanMap = [
                'januari' => 1, 'februari' => 2, 'maret' => 3,
                'april' => 4, 'mei' => 5, 'juni' => 6,
                'juli' => 7, 'agustus' => 8, 'september' => 9,
                'oktober' => 10, 'november' => 11, 'desember' => 12
            ];

            if (isset($bulanMap[$bulan])) {
                $query->whereMonth('start', $bulanMap[$bulan]);
            }
        }

        // Tambahan: jika filter adalah 'pelanggan', urutkan berdasarkan tanggal start terbaru
        if ($filter === 'pelanggan') {
            $query->orderBy('start', 'asc');
        } else {
            $query->orderBy('start', 'asc');
        }

        $data = $query->get();

        // Jika data sudah kosong karena dihapus atau tidak ada di bulan itu
        if ($data->isEmpty()) {
            return redirect()->route('non-datin')->with('info', 'Semua data asset sudah dihapus.');
        }

        return view('non-datin.assets.show', compact('data', 'cca'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($cca, $snd)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
        return redirect('/non-datin');
        }

        $data = NonDatin::where('cca', $cca)->where('snd', $snd)->firstOrFail();

        if (!$data) {
        return redirect('/non-datin')->with('error', 'Data tidak ditemukan');
        }

        return view('non-datin.assets.edit', compact('data','cca'));
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
            'manager' => $request->manager,
        ]);

        return redirect()->route('nonassets.show', ['cca' => $cca])
            ->with('success_nondatin_update', 'Data pelanggan berhasil diupdate.');
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
            return redirect()->route('nonassets.show', ['cca' => $cca])
                ->with('success_nondatin_delete', 'Data berhasil dihapus');
        } 

        // Redirect jika data tidak ditemukan dengan pesan error
        return redirect()->route('nonassets.show', ['cca' => $cca])
            ->with('error', 'Data tidak ditemukan.');
    }
}
