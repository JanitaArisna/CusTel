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
        return view('non-datin.non-bill.non-bill-index', compact('data', 'cca', 'snd'));
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
        return view('non-datin.non-bill.non-bill-create', compact('data', 'cca', 'snd'));
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
        ]);

        // Cek apakah data dengan SND dan tahun yang sama sudah ada
        $NonBill = NonDatinBill::where('snd', $request->snd)
            ->where('tahun', $request->tahun)
            ->first();
 
        if ($NonBill) {
            return redirect()->route('non-datin.bill.index', ['cca' => $request->cca])
                ->with('error', 'Data Bill sudah ada');
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
        return redirect()->route('non-datin.bill.show', ['cca' => $request->cca, 'snd' => $request->snd])
            ->with('success', 'Data Bill berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show($cca, $snd)
    {
        $nonDatin = NonDatin::where('snd', $snd)->first();
        $data = NonDatinBill::where('snd', $snd)->get();
        return view('non-datin.non-bill.non-bill-show', compact('data', 'cca', 'snd', 'nonDatin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(request $cca, $snd)
    {
        

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
