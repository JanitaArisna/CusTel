<?php

namespace App\Http\Controllers\Datin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Datin;
use App\Models\DatinBill;

class BillDatinController extends Controller
{
    
    public function index($sid)
    {
        // Ambil data bill berdasarkan sid
        $data = DatinBill::where('sid', $sid)->get();

        // Ambil acc_num berdasarkan sid, misalnya jika hanya ada satu acc_num terkait dengan sid
        //$acc_num = Datin::where('sid', $sid)->value('acc_num');  // atau cara lain untuk mendapatkan acc_num berdasarkan sid
        // Kirim data ke view
        return view('datin.bill.bill-datin', compact('data','sid',));
    }
    /*public function showBill($acc_num, $sid)
    {
        // Ambil data bill berdasarkan sid
        dd($acc_num, $sid);
        $data = DatinBill::where('sid', $sid)->get();

        // Kirim data ke view
        return view('datin.bill.bill-datin', compact('data', 'sid', 'acc_num'));
    } */


    /**
     * Show the form for creating a new resource.
     */
    public function create($sid)
    {
        return view('datin.bill.bill-create', compact('sid'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $sid)
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
        ]);

        // Cek apakah kombinasi sid + tahun sudah ada
        $bill = DatinBill::where('sid', $sid)->where('tahun', $request->tahun)->first();

        if ($bill) {
            // Jika sudah ada, munculkan alert error dan kembalikan input sebelumnya
            return redirect()->back()->with('error', 'Data untuk tahun ini sudah ada!')->withInput();
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

        return redirect("/datin/bill/$sid")->with('success', 'Data berhasil disimpan!');
    }




    /**
     * Display the specified resource.
     */
    public function show($sid)
    {  
        $data = DatinBill::where('sid', $sid)->get();
        return view('datin.bill.bill-datin', compact('data', 'sid'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($sid, $tahun)
    {
        $bill = DatinBill::where('sid', $sid)->where('tahun', $tahun)->firstOrFail();
        return view('datin.bill.bill-edit', compact('bill', 'sid', 'tahun'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $sid, $tahun)
    {
        $request->validate([
            'januari' => 'required|numeric',
            'februari' => 'required|numeric',
            'maret' => 'required|numeric',
            'april' => 'required|numeric',
            'mei' => 'required|numeric',
            'juni' => 'required|numeric',
            'juli' => 'required|numeric',
            'agustus' => 'required|numeric',
            'september' => 'required|numeric',
            'oktober' => 'required|numeric',
            'november' => 'required|numeric',
            'desember' => 'required|numeric',
            'tahun' => 'required|numeric',
        ]);

        $bill = DatinBill::where('sid', $sid)->where('tahun', $tahun)->firstOrFail();
        $bill->update($request->all());

        return redirect()->route('bill.show', [ 'sid' => $sid])
                         ->with('success', 'Data Bill berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($sid, $tahun)
    {
        $bill = DatinBill::where('sid', $sid)->where('tahun', $tahun)->firstOrFail(); // Pastikan SID & tahun cocok
        $bill->delete();

        return redirect()->route('bill.show', [ 'sid' => $sid])
                         ->with('success', 'Data Bill berhasil dihapus!');
    }
}

