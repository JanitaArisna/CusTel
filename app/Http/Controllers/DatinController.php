<?php

namespace App\Http\Controllers;

use App\Models\datin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class DatinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $katakunci = $request->katakunci;
    $jumlahbaris = 10;

    if (strlen($katakunci)) {
        $data = datin::whereIn('id', function ($query) use ($katakunci) {
            $query->selectRaw('MIN(id)')
                ->from('datin')
                ->where('acc_num', 'like', "%$katakunci%")
                ->orWhere('cust_nm', 'like', "%$katakunci%")
                ->orWhere('nipnas', 'like', "%$katakunci%")
                ->orWhere('segment_id', 'like', "%$katakunci%")
                ->groupBy('acc_num');
        })
        ->paginate($jumlahbaris);
    } else {
        $data = datin::whereIn('id', function ($query) {
            $query->selectRaw('MIN(id)')
                ->from('datin')
                ->groupBy('acc_num');
        })
        ->orderBy('acc_num', 'desc')
        ->paginate($jumlahbaris);
    }
    

    $assetsData = datin::select('acc_num', 'sid', 'layanan_id', 'bw', 'kontrak', 'start', 'end', 'am_nm')->get();
    return view('datin.datin', compact('data', 'assetsData'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/datin');
        }

        return view('datin.create');

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
            'end' => 'required',
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
            'success_add'=> true, 
            'cust_nm' => $cust_nm,
            'acc_num' => $acc_num]);
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

        return view('datin.edit', compact('data', 'acc_num'));
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
            'nipnas.required' => 'NIPNAS wajib diisi',
            'segment_id.required' => 'Segment ID wajib diisi',
            'witel.required' => 'Witel wajib diisi',
            'layanan_id.required' => 'Layanan ID wajib diisi',
            'bw.required' => 'BW wajib diisi',
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
        datin::where('sid', $id)->update($data);
        $cust_nm = $data['cust_nm'];
        $acc_num = $data['acc_num'];
        return redirect()->to('datin')->with([
            'success_update'=> true, 
            'cust_nm' => $cust_nm,
            'acc_num' => $acc_num,
            'sid' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        datin::where('sid', $id)->delete();
        return redirect()->to('datin')->with('success', 'Berhasil menghapus data');
    }
    
    

}


