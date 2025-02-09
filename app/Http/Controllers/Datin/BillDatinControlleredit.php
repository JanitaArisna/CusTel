<?php

namespace App\Http\Controllers\Datin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Datin;
use App\Models\DatinBill;

class BillDatinController extends Controller
{

    public function showBill($sid)
    {
        // Ambil data assets berdasarkan account number
        $data = DatinBill::where('sid', $sid)->get();

        // Kirim data ke view
        return view('datin.bill.bill-datin', compact('data','sid'));
    }

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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sid' => 'required|exists:datin,sid',
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

        $bill = new DatinBill();
        $bill->sid = $request->sid;
        $bill->januari = $request->januari;
        $bill->februari = $request->februari;
        $bill->maret = $request->maret;
        $bill->april = $request->april;
        $bill->mei = $request->mei;
        $bill->juni = $request->juni;
        $bill->juli = $request->juli;
        $bill->agustus = $request->agustus;
        $bill->september = $request->september;
        $bill->oktober = $request->oktober;
        $bill->november = $request->november;
        $bill->desember = $request->desember;
        $bill->tahun = $request->tahun;
        $bill->save();


        return redirect()->to('bill.index')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show($sid, $id)
    {
        $bill = datin::where('sid', $sid)->findOrFail($id);
        return view('datin.bill.show', compact('bill'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($sid, $bill, $id)
    {
        $bill = datin::where('sid', $sid)->findOrFail($id);
        return view('datin.bill.edit', compact('bill', 'sid'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $sid, $id)
    {
        $request->validate([
        'year' => 'required|integer',
        'jan' => 'required|numeric',
        // Tambahkan validasi bulan lainnya
        ]);

        $bill = datin::where('sid', $sid)->findOrFail($id);
        $bill->update($request->all());

        return redirect()->route('bill.index', $sid)->with('success', 'Data Bill berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($sid, $id)
    {
        $bill = datin::where('sid', $sid)->findOrFail($id);
        $bill->delete();

        return redirect()->route('bill.index', $sid)->with('success', 'Data Bill berhasil dihapus!');
    }

}
