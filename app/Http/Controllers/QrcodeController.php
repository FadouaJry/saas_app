<?php

namespace App\Http\Controllers;

// use Endroid\QrCode\Builder\Builder;
use App\Http\Requests\StoreQrcodeRequest;
use App\Http\Requests\UpdateQrcodeRequest;
use App\Models\Qrcode;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        $data['user_id'] = 1;
        $qrcode = Qrcode::create($data);
        $qrcode->qrcode_path = $this->saveQrcode($qrcode);
        $qrcode->save();

        // decrement the user numer of qrcode
        // auth()->user()->decrement('num_qrcode');
        return to_route('qrcodes.index')->with('success', 'Qrcode added successfully');
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
        return view('qrcodes.edit')->with('qrcode', $qrcode);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQrcodeRequest $request, qrcode $qrcode)
    {

        $data = $request->validated();
        $data['user_id'] = 1;
        $qrcode->update($data);
        $qrcode->qrcode_path = $this->saveQrcode($qrcode);
        $qrcode->save();

        // decrement the user numer of qrcode
        // auth()->user()->decrement('num_qrcode');
        return to_route('qrcodes.index')->with('success', 'Qrcode updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(qrcode $qrcode)
    {
        // if(auth()->user()->qrcodes->contain($qrcode)){
        $this->removeQrcodeFromStorage($qrcode->qrcode_path);
        $qrcode->delete();

        return to_route('qrcodes.index')->with('success', 'Qrcode deleted successfully');

        //     }else{
        //   return to_route('qrcodes.index')->with('error', 'Something went wrong try again later ');

        //     }

    }

    /**
     * create and save the qrcode in the storage
     */
    public function saveQrcode($qrcode)
    {
        $builder = new Builder(
            writer: new PngWriter(),
            data: $qrcode->content,
            size: 150,

        );
        // generate qrcode
        $qrcode = $builder->build();
        // define the path
        $qrcodePath = 'qr_code/'.$qrcode->id.'.png';
        // save the qrcode
        Storage::disk('public')->put($qrcodePath, $qrcode->getString);

        // return the file path
        return 'storage'.$qrcodePath;

    }

    // remove the file
    public function removeQrcodeFromStorage($qrcodeFile)
    {

        $path = public_path($qrcodeFile);
        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
