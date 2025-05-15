<?php

namespace App\Http\Controllers;

use App\Models\datin;
use Illuminate\Http\Request;
use App\Models\Assets;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class DatinController extends Controller
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

        $query = datin::query();

        // Filter bulan: dilakukan dulu sebelum pengelompokan
        if ($filter === 'bulan' && $bulan && isset($bulanMap[$bulan])) {
            $query->whereMonth('start', $bulanMap[$bulan]);
        }

        // Search kata kunci
        if (strlen($katakunci)) {
            $query->where(function ($q) use ($katakunci) {
                $q->where('acc_num', 'like', "%$katakunci%")
                ->orWhere('cust_nm', 'like', "%$katakunci%")
                ->orWhere('nipnas', 'like', "%$katakunci%")
                ->orWhere('segment_id', 'like', "%$katakunci%");
            });
        }

        // Ambil hanya 1 record per acc_num setelah semua filter
        $query->whereIn('id', function ($sub) use ($filter, $bulanMap, $bulan, $katakunci) {
            $sub->selectRaw('MIN(id)')
                ->from('datin');

            // Filter bulan di subquery
            if ($filter === 'bulan' && $bulan && isset($bulanMap[$bulan])) {
                $sub->whereMonth('start', $bulanMap[$bulan]);
            }

            // Filter kata kunci di subquery
            if (strlen($katakunci)) {
                $sub->where(function ($q) use ($katakunci) {
                    $q->where('acc_num', 'like', "%$katakunci%")
                    ->orWhere('cust_nm', 'like', "%$katakunci%")
                    ->orWhere('nipnas', 'like', "%$katakunci%")
                    ->orWhere('segment_id', 'like', "%$katakunci%");
                });
            }

            $sub->groupBy('acc_num');
        });

        // Urutan data
        if ($filter === 'pelanggan') {
            $query->orderBy('start', 'asc');
        } else {
            $query->orderBy('start', 'asc');
        }

        $data = $query->paginate($jumlahbaris);
        $assetsData = datin::select('acc_num', 'sid', 'layanan_id', 'bw', 'kontrak', 'start', 'end', 'am_nm')->get();

        return view('datin.main.index', compact('data', 'assetsData'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/datin');
        }

        return view('datin.main.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        Session::flash('acc_num', $request->acc_num);
        Session::flash('cust_nm', $request->cust_nm);
        Session::flash('nipnas', $request->nipnas);
        Session::flash('segment_id', $request->segment_id);
        Session::flash('witel', $request->witel);
        Session::flash('sid', $request->sid);
        Session::flash('layanan_id', $request->layanan_id);
        Session::flash('bw', $request->bw);
        Session::flash('kontrak', $request->kontrak);
        Session::flash('start', $request->start);
        Session::flash('end', $request->end);
        Session::flash('am_nm', $request->am_nm);

        $request->validate([
            'acc_num' => 'required',
            'cust_nm' => 'required',
            'nipnas' => 'required',
            'segment_id' => 'required',
            'witel' => 'required',
            'sid' => 'required|numeric|unique:datin,sid',
            'layanan_id' => 'required',
            'bw' => 'required',
            'kontrak' => 'required',
            'start' => 'required',
            'end' => 'required|after:start', // Tambahkan validasi date dan after
            'am_nm' => 'required',
        ], [
            'acc_num' => 'Account Number wajib diisi',
            'cust_nm' => 'Customer Name wajib diisi',
            'nipnas.required' => 'NIPNAS wajib diisi',
            'nipnas.numeric' => 'NIPNAS harus berupa angka',
            'nipnas.unique' => 'NIPNAS sudah terdaftar',
            'segment_id' => 'Segment ID wajib diisi',
            'witel' => 'Witel wajib diisi',
            'sid.required' => 'SID wajib diisi',
            'sid.numeric' => 'SID harus berupa angka',
            'sid.unique' => 'SID sudah terdaftar',
            'layanan_id' => 'Layanan ID wajib diisi',
            'bw.required' => 'BW wajib diisi',
            'bw.numeric' => 'BW harus berupa angka',
            'bw.unique' => 'BW sudah terdaftar',
            'kontrak' => 'Kontrak wajib diisi',
            'start' => 'Start wajib diisi',
            'end' => 'End wajib diisi',
            'end.after' => 'Tanggal Akhir Kontrak harus setelah Tanggal Mulai Kontrak',
            'am_nm' => 'Account Manager wajib diisi',

        ]);

        $data = [
            'acc_num' => $request->acc_num,
            'cust_nm' => $request->cust_nm,
            'nipnas' => $request->nipnas,
            'segment_id' => $request->segment_id,
            'witel' => $request->witel,
            'sid' => $request->sid,
            'layanan_id' => $request->layanan_id,
            'bw' => $request->bw,
            'kontrak' => $request->kontrak,
            'start' => $request->start,
            'end' => $request->end,
            'am_nm' => $request->am_nm,
        ];
        datin::create($data);
        $cust_nm = $data['cust_nm'];
        $acc_num = $data['acc_num'];
        return redirect()->to('datin')->with([
            'success_datin'=> true, 
            'cust_nm' => $cust_nm,
            'acc_num' => $acc_num]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $acc_num)
    {
        $filter = $request->filter;
        $bulan = $request->bulan;

        $query = Assets::where('acc_num', $acc_num);

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
            return redirect()->route('datin.index')->with('info', 'Semua data asset sudah dihapus.');
        }

        return view('datin.assets.show', compact('data'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $acc_num, string $sid)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
        return redirect('/datin');
        }

        // Pastikan query sesuai dengan struktur database
        $data = datin::where('sid', $sid)->first();
        

        if (!$data) {
            return redirect('/datin')->with('error', 'Data tidak ditemukan');
        }

        return view('datin.assets.edit', compact('data', 'acc_num'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $acc_num, string $sid) // Parameter kedua adalah 'sid' sesuai dengan route
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
            'start' => 'required|date', // Tambahkan validasi date
            'end' => 'required|date|after:start', // Tambahkan validasi date dan after
            'am_nm' => 'required',
        ], [
            'acc_num.required' => 'Account Number wajib diisi',
            'cust_nm.required' => 'Customer Name wajib diisi',
            'nipnas.required' => 'NIPNAS wajib diisi',
            'segment_id.required' => 'Segment wajib diisi',
            'witel.required' => 'Witel wajib diisi',
            'layanan_id.required' => 'Layanan wajib diisi',
            'bw.required' => 'Bandwidth wajib diisi',
            'kontrak.required' => 'Kontrak wajib diisi',
            'start.required' => 'Tanggal Mulai Kontrak wajib diisi',
            'start.date' => 'Format Tanggal Mulai Kontrak tidak valid',
            'end.required' => 'Tanggal Akhir Kontrak wajib diisi',
            'end.date' => 'Format Tanggal Akhir Kontrak tidak valid',
            'end.after' => 'Tanggal Akhir Kontrak harus setelah Tanggal Mulai Kontrak',
            'am_nm.required' => 'Account Manager wajib diisi',
        ]);

        $data = Datin::where('sid', $sid)->firstOrFail(); // Cari data berdasarkan SID
        $data->acc_num = $request->acc_num;
        $data->cust_nm = $request->cust_nm;
        $data->nipnas = $request->nipnas;
        $data->segment_id = $request->segment_id;
        $data->witel = $request->witel;
        $data->layanan_id = $request->layanan_id;
        $data->bw = $request->bw;
        $data->kontrak = $request->kontrak;
        $data->start = $request->start;
        $data->end = $request->end;
        $data->am_nm = $request->am_nm;
        $data->save();

        return redirect()->route('assets.show', ['acc_num' => $data->acc_num])
                         ->with('success_datin_update', 'Data pelanggan berhasil diupdate.')
                         ->with('cust_nm', $data->cust_nm)
                         ->with('acc_num', $data->acc_num);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $acc_num, $sid)
    {
        // Cari aset berdasarkan $sid dan pastikan $acc_num sesuai
        $datin = Datin::where('sid', $sid)
                      ->where('acc_num', $acc_num)
                      ->firstOrFail();

        // Lakukan proses penghapusan aset
        $datin->delete();

        // Berikan respons setelah berhasil menghapus
        return redirect()->route('assets.show', $acc_num)->with('success_datin_delete', 'Aset berhasil dihapus.');
        // Atau, jika Anda ingin mengarahkan ke route lain:
        // return redirect()->route('assets.show', $acc_num)->with('success', 'Aset berhasil dihapus.');
    }
    

}


