<?php

namespace App\Http\Controllers\Datin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Datin;
use App\Models\DatinBill;
use App\Models\Billindex;

class BillDatinController extends Controller
{
    
    public function index(Request $request, $acc_num)
    {
        $filter = $request->filter;
        $bulan = $request->bulan;

        $query = Billindex::where('acc_num', $acc_num);

        // Filter berdasarkan bulan jika diperlukan
        if ($filter === 'bulan' && $bulan) {
            $bulanMap = [
                'januari' => 1, 'februari' => 2, 'maret' => 3,
                'april' => 4, 'mei' => 5, 'juni' => 6,
                'juli' => 7, 'agustus' => 8, 'september' => 9,
                'oktober' => 10, 'november' => 11, 'desember' => 12
            ];

            if (isset($bulanMap[$bulan])) {
                // Ganti 'tanggal' dengan nama kolom tanggal di tabel bill jika beda
                $query->whereMonth('start', $bulanMap[$bulan]);
            }
        }

        $data = $query->get();

        return view('datin.bill.index', compact('data', 'acc_num'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create($acc_num, $sid)
    {
        return view('datin.bill.create', compact('sid', 'acc_num'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $acc_num, $sid)
    {
        // Validasi input
        $request->validate([
            'tahun' => 'required|integer',
            'januari' => 'nullable|integer',
            'februari' => 'nullable|integer',
            'maret' => 'nullable|integer',
            'april' => 'nullable|integer',
            'mei' => 'nullable|integer',
            'juni' => 'nullable|integer',
            'juli' => 'nullable|integer',
            'agustus' => 'nullable|integer',
            'september' => 'nullable|integer',
            'oktober' => 'nullable|integer',
            'november' => 'nullable|integer',
            'desember' => 'nullable|integer',
        ],[
            'tahun.required' => 'Tahun harus diisi.', // Pesan error kustom untuk required tahun (opsional)
    ]);

        // Cek apakah kombinasi sid + tahun sudah ada
        $bill = DatinBill::where('sid', $sid)->where('tahun', $request->tahun)->first();

        if ($bill) {
            // Jika sudah ada, munculkan alert error dan kembalikan input sebelumnya
            return redirect()->back()->with('error', 'duplicate_year')->withInput();
        }

        // Cek apakah ada bulan yang diisi
        $bulan_diisi = false;
        foreach (['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'] as $bulan) {
            if ($request->filled($bulan)) {
                $bulan_diisi = true;
                break; // Keluar dari loop jika ada bulan yang diisi
            }
        }

        if (!$request->filled('tahun') && !$bulan_diisi) {
            // Jika tidak ada tahun dan bulan yang diisi, munculkan alert error dan kembalikan input sebelumnya
            return redirect()->back()->with('error', 'no_month_no_year')->withInput();
        }

        elseif (!$bulan_diisi) {
            // Jika tidak ada bulan yang diisi, munculkan alert error dan kembalikan input sebelumnya
            return redirect()->back()->with('error', 'no_month')->withInput();
        }

        elseif (!$request->tahun) {
            // Jika tahun tidak diisi, munculkan alert error dan kembalikan input sebelumnya
            return redirect()->back()->with('error', 'no_year')->withInput();
        }

        // Jika belum ada, buat data baru
        DatinBill::create([
            'sid' => $sid,
            'tahun' => $request->tahun,
            'januari' => $request->januari,
            'februari' => $request->februari,
            'maret' => $request->maret,
            'april' => $request->april,
            'mei' => $request->mei,
            'juni' => $request->juni,
            'juli' => $request->juli,
            'agustus' => $request->agustus,
            'september' => $request->september,
            'oktober' => $request->oktober,
            'november' => $request->november,
            'desember' => $request->desember,
        ]);

        // Redirect ke halaman yang sesuai dengan menambahkan kedua parameter, acc_num dan sid
        return redirect()->route('bill.show', ['acc_num' => $acc_num, 'sid' => $sid])
                        ->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($acc_num, $sid)
    {
        $data = DatinBill::where('sid', $sid)->get();

        return view('datin.bill.show', compact('data', 'sid', 'acc_num'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($acc_num, $sid, $tahun)
    {
        $datin = Datin::where('sid', $sid)->first();
        $bill = DatinBill::where('sid', $sid)->where('tahun', $tahun)->first();

        if (!$bill) {
        return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }

        return view('datin.bill.edit', compact('bill', 'acc_num', 'sid', 'datin'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $acc_num, $sid, $tahun)
    {
        $request->validate([
            'tahun' => 'required|numeric',
        ]);

        $bill = DatinBill::where('sid', $sid)->where('tahun', $tahun)->firstOrFail();

        if (!$bill) {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }

        $duplikat = DatinBill::where('sid', $sid)
            ->where('tahun', $request->tahun)
            ->where('id', '!=', $bill->id) // Pastikan tahun yang sama tidak dihitung
            ->first();
            
        if ($duplikat) {
            return redirect()->back()->with('error', 'Data untuk tahun ini sudah ada!')->withInput();
        }
        // Jika tidak ada duplikat, update data
        $bill->update([
            'tahun' => $request->tahun,
            'januari' => $request->januari,
            'februari' => $request->februari,
            'maret' => $request->maret,
            'april' => $request->april,
            'mei' => $request->mei,
            'juni' => $request->juni,
            'juli' => $request->juli,
            'agustus' => $request->agustus,
            'september' => $request->september,
            'oktober' => $request->oktober,
            'november' => $request->november,
            'desember' => $request->desember,
        ]);
        // Update data bill
        if ($bill) {
            // Redirect ke halaman yang sesuai dengan menambahkan kedua parameter, acc_num dan sid
            return redirect()->route('bill.show', ['acc_num' => $acc_num, 'sid' => $sid])
                ->with('success', 'bill_updated'); // Menggunakan key 'bill_updated'
        } else {
            return redirect()->route('bill.show', ['acc_num' => $acc_num, 'sid' => $sid])
                ->with('success', 'bill_not_updated');
        }            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($acc_num, $sid, $tahun)
    {
        $bill = DatinBill::where('sid', $sid)->where('tahun', $tahun)->firstOrFail(); // Pastikan SID & tahun cocok
        $bill->delete();

        return redirect()->route('bill.show', ['acc_num' => $acc_num, 'sid' => $sid])
                         ->with('delete_success', 'Data Bill berhasil dihapus!');
    }
}

