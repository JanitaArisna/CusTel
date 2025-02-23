<?php

namespace App\Http\Controllers\Datin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Billindex;
use App\Models\Datin;
use App\Models\DatinBill;

class BillDatinIndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Billindex($acc_num)
    {
        // Ambil data bill
        $data = Billindex::where('acc_num', $acc_num)->get();

        // Kirim data ke view
        return view('datin.bill.bill-index', compact('data', 'acc_num'));
        
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
