<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Konten;
use App\Models\Setting;
use App\Models\Tagihan;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class InformasiPribadiController extends Controller
{
    public function index()
    {
        $informasi = Informasi::latest()->paginate(5);
        return view('pengurus.v_informasi', [
            'uploads' => $informasi
        ]);
    }

    public function create(Request $request)
    {
        \App\Models\Informasi::create($request->all);
    }

    public function store(Request $request)
    {
        $upload = $request->gambar;
        $namaFile = time() . rand(100, 999) . "." . $upload->getClientOriginalExtension();

        $dataUpload = new Informasi;
        $dataUpload->penerima = $request->penerima;
        $dataUpload->judul = $request->judul;
        $dataUpload->gambar = $namaFile;
        $dataUpload->deskripsi = $request->deskripsi;

        $upload->move(public_path() . '/informasi', $namaFile);
        $dataUpload->save();

        return redirect('data-informasi')->with('success', 'Upload content baru berhasil!');
    }

    public function show()
    {
        $santri = Auth::user()->username;
        $informations = Informasi::where('penerima', $santri)->get();
        $setting = Setting::findOrFail(1);
        $waktu = Carbon::now();
        $notif_tagihan = Tagihan::where('status', 'aktif')->where('nis', $santri)->where('tahun', Carbon::now()->year)->where('bulan', $waktu->isoFormat('MMMM'))->paginate(1);
        $notif_info = Informasi::where('penerima', $santri)->where('created_at', '>', date('Y-m-d', strtotime("-3 days")))->latest()->paginate(1);
        $tampilContent = Konten::where('kategori', 'Dashboard')->get();

        return view('users.info_santri', [
            'informations' => $informations,
            'tampilContent' => $tampilContent,
            'notif_tagihan' => $notif_tagihan,
            'notif_info' => $notif_info,
            'setting' => $setting,

        ]);
    }

    public function detail($id)
    {

        $santri = Auth::user()->username;
        $waktu = Carbon::now();
        $notif_tagihan = Tagihan::where('status', 'aktif')->where('nis', $santri)->where('tahun', Carbon::now()->year)->where('bulan', $waktu->isoFormat('MMMM'))->paginate(1);
        $notif_info = Informasi::where('penerima', $santri)->where('created_at', '>', date('Y-m-d', strtotime("-3 days")))->latest()->paginate(1);
        $setting = Setting::findOrFail(1);

        $informations = Informasi::findOrFail($id);
        return view('users.info_santri_detail', [
            'informations' => $informations,
            'notif_tagihan' => $notif_tagihan,
            'notif_info' => $notif_info,
            'setting' => $setting
        ]);
    }

    public function edit($id)
    {
        $informasi = Informasi::findOrFail($id);
        return view('pengurus.edit_informasi')->with([
            'uploads' => $informasi
        ]);
    }

    public function update(Request $request, $id)
    {
        $image_lama = $request->old_image;
        $image_baru = $request->file('gambar');

        if ($image_baru == '') {
            $gambar = $image_lama;
            $deskripsi = "Gambar Lama";
        } else {
            $new_image = rand() . '.' . $image_baru->getClientOriginalExtension();
            $gambar = $new_image;
            $image_baru->move(public_path('informasi'), $new_image);
        }

        $informasi = Informasi::findOrFail($id);
        $informasi->update(array(
            'penerima' => $request->penerima,
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'gambar' => $gambar,
            'deskripsi' => $request->deskripsi,
        ));

        return redirect('data-informasi');
    }

    public function destroy($id)
    {
        $data_spesifik = Informasi::findOrFail($id);
        $image_path = public_path("informasi/{$data_spesifik->gambar}");
        File::delete($image_path);

        $data_spesifik->delete();
        return redirect()->route('data-informasi.index');
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $this->printData = Informasi::where('judul', 'like', '%' . $keyword . '%')->orderBy('judul', 'asc')->get();
        return view('pengurus.v_informasi')->with([
            'uploads' => $this->printData
        ]);
    }
}
