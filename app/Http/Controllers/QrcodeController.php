<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQrcodeRequest;
use App\Models\Qrcode ;
use Illuminate\Http\Request;

class QrcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $qrcodes = Qrcode::paginate(1);
        return view('qrcodes.index', compact($qrcodes));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('qrcodes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQrcodeRequest $request)
    {
        $data = $request->validated();
        
    }

    /**
     * Display the specified resource.
     */
    public function show(qrcode $qrcode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(qrcode $qrcode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, qrcode $qrcode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(qrcode $qrcode)
    {
        //
    }
}
