<?php

namespace App\Http\Controllers\NonDatin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NonDatin;
use App\Models\NonDatinBill;
use Illuminate\Support\Facades\Auth;


class NonDatinBillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($cca)
    {
        $data = NonDatin::where('cca', $cca)->get(); // Ambil semua data dengan CCA yang sama
        $snd = 'default_snd';
        return view('non-datin.bill.index', compact('data', 'cca', 'snd'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($cca, $snd)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/non-datin');
        }
        $data = NonDatin::where('cca', $cca)->where('snd', $snd);
        return view('non-datin.bill.create', compact('data', 'cca', 'snd'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $cca, $snd)
    {
        // Validasi input
        $request->validate([
            'snd' => 'required',
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
            'tahun.required' => 'Tahun harus diisi.', // Pesan error kustom untuk required tahun (opsional)]
    ]);

        // Cek apakah data dengan SND dan tahun yang sama sudah ada
        $NonBill = NonDatinBill::where('snd', $request->snd)->where('tahun', $request->tahun)->first();

        if ($NonBill) {
            // Jika sudah ada, munculkan alert error dan kembalikan input sebelumnya
            return redirect()->back()->with('error', 'nonduplicate_year')->withInput();
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
            return redirect()->back()->with('error', 'non_no_month_no_year')->withInput();
        }

        elseif (!$bulan_diisi) {
            // Jika tidak ada bulan yang diisi, munculkan alert error dan kembalikan input sebelumnya
            return redirect()->back()->with('error', 'non_no_month')->withInput();
        }

        elseif (!$request->tahun) {
            // Jika tahun tidak diisi, munculkan alert error dan kembalikan input sebelumnya
            return redirect()->back()->with('error', 'non_no_year')->withInput();
        }

        // Simpan data baru ke database
        NonDatinBill::create([
            'snd' => $request->snd,
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

        // Redirect dengan pesan sukses
        return redirect()->route('nonbill.show', ['cca' => $request->cca, 'snd' => $request->snd])
            ->with('success', 'Data Bill berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show($cca, $snd)
    {

        $data = NonDatinBill::where('snd', $snd)->get();
        
        return view('non-datin.bill.show', compact('data', 'cca', 'snd'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($cca, $snd, $tahun)
    {
        $nonDatin = NonDatin::where('snd', $snd)->first();
        $nonBill = NonDatinBill::where('snd', $snd)->where('tahun', $tahun)->first();
        
        if (!$nonBill) {
        return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }

        return view('non-datin.bill.edit', compact('nonBill', 'cca', 'snd', 'nonDatin'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $cca, $snd, $tahun)
    {

        $request->validate([
            'tahun' => 'required|numeric',
        ]);

        $nonBill = NonDatinBill::where('snd', $snd)->where('tahun', $tahun)->firstOrFail();

        if (!$nonBill) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $duplikat = NonDatinBill::where('snd', $snd)
            ->where('tahun', $request->tahun)
            ->where('id', '!=', $nonBill->id) // Pastikan tahun yang sama tidak dihitung
            ->first();

        if ($duplikat) {
            return redirect()->back()->with('error', 'Data untuk tahun ini sudah ada!')->withInput();
        }
        // Jika tidak ada duplikat, update data
        $nonBill->update([
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
        if ($nonBill) {
        // Redirect ke halaman yang sesuai dengan menambahkan kedua parameter, CCA dan SND
            return redirect()->route('nonbill.show', ['cca' => $cca, 'snd' => $snd])
                ->with('success', 'nonbill_updated'); // Menggunakan key 'nonbill_updated'
        } else {
            return redirect()->route('nonbill.show', ['cca' => $cca, 'snd' => $snd])
                ->with('success', 'nonbill_not_updated');
        }     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cca, $snd, $tahun)
    {
        // Ambil data berdasarkan snd dan tahun
        $nonDatinBill = NonDatinBill::where('snd', $snd)->where('tahun', $tahun)->firstOrFail();// Pastikan SID & tahun cocok
        $nonDatinBill->delete();
         
        // Redirect ke halaman show dengan parameter yang sesuai
        return redirect()->route('nonbill.show', ['cca' => $cca, 'snd' => $snd])
                        ->with('delete_success', 'Data Non Bill berhasil dihapus!');
    }


}
