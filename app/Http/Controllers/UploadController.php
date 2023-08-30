<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    public function index()
    {
        $buktiPembayaran = Pembayaran::latest()->get();
        return view('users.upload_bukti', compact('buktiPembayaran'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $image_lama = $request->old_image;
        $image_baru = $request->file('bukti');

        if ($image_baru == null) {
            $gambar = $image_lama;
            $deskripsi = "Gambar Lama";
        } else {
            $new_image = rand() . '.' . $image_baru->getClientOriginalExtension();
            $gambar = $new_image;
            $image_baru->move(public_path('img'), $new_image);
        }

        $uploadBukti = Pembayaran::findOrFail($id);
        $uploadBukti->update(array(
            'nis' => $request->nis,
            'nama' => $request->nama,
            'tagihan' => $request->tagihan,
            'nominal' => $request->nominal,
            'bukti' => $gambar,
            'keterangan' => $request->keterangan,
        ));

        return redirect('tagihan');
    }

    public function destroy($id)
    {
        //
    }

    public function riwayat()
    {
        $santri = Auth::user()->username;
        $riwayatPembayaran = Pembayaran::where('nis', $santri)->get();
        return view('users.riwayat_bayar', ['riwayatPembayaran' => $riwayatPembayaran]);
    }

    public function detail($id)
    {
        $santri = Auth::user()->username;
        $detail = Pembayaran::findOrFail($id);
        return view('users.detail_riwayat', ['detail' => $detail]);
    }
}
