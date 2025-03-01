<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\NonDatin;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class NonDatinController extends Controller
{
    public function index(Request $request)
    {
        $katakunci = $request->kata_kunci;
        $jumlahbaris = 10;

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
        })
        ->paginate($jumlahbaris);
    } else {
        $data = NonDatin::whereIn('id', function ($query) {
            $query->selectRaw('MIN(id)')
                ->from('non_datin')
                ->groupBy('cca');
        })
        ->orderBy('cca', 'desc')
        ->paginate($jumlahbaris);
    }


        return view('non-datin.non-datin',compact('data'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/non-datin');
        }

        return view('non-datin.non-datin-create');
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
        Session::flash('end', $request->end);

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
            'end' => 'required',
        ],[
            'cca.required' => 'CCA harus diisi',
            'snd.required' => 'SND harus diisi',
            'snd.unique' => 'SND sudah ada',
            'snd_g.required' => 'SND G harus diisi',
            'ncli.required' => 'NCLI harus diisi',
            'nama.required' => 'Nama harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'sto.required' => 'STO harus diisi',
            'segment_non.required' => 'Segment harus diisi',
            'produk.required' => 'Produk harus diisi',
            'desc_newbill.required' => 'Desc Newbill harus diisi',
            'bundling.required' => 'Bundling harus diisi',
            'start.required' => 'Start harus diisi',
            'end.required' => 'End harus diisi',
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
            'end' => $request->end,
        ];
        NonDatin::create($data);
        return redirect('/non-datin')->with('success', 'Data berhasil disimpan');
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
    public function edit(string $id)
    {
        //
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
