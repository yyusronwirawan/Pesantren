<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Konten;
use App\Models\Tagihan;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class KontenController extends Controller
{
    public function index()
    {
        $santri = Auth::user()->username;
        $content = Konten::latest()->paginate(5);

        return view('admin.v_konten', [
            'uploads' => $content,
            'title' => 'Data Konten',

        ]);
    }

    public function create(Request $request)
    {
        \App\Models\Konten::create($request->all);
    }

    public function store(Request $request)
    {
        $upload = $request->gambar;
        $namaFile = time() . rand(100, 999) . "." . $upload->getClientOriginalExtension();

        $dataUpload = new Konten;
        $dataUpload->judul = $request->judul;
        $dataUpload->kategori = $request->kategori;
        $dataUpload->gambar = $namaFile;
        $dataUpload->deskripsi = $request->deskripsi;

        $upload->move(public_path() . '/content', $namaFile);
        $dataUpload->save();

        return redirect('data-konten')->with('success', 'Upload content baru berhasil!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $content = Konten::findOrFail($id);
        return view('admin.edit_konten')->with([
            'uploads' => $content, 'title' => 'Ubah Konten'
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
            $image_baru->move(public_path('content'), $new_image);
        }

        $content = Konten::findOrFail($id);
        $content->update(array(
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'gambar' => $gambar,
            'deskripsi' => $request->deskripsi,
        ));

        return redirect('data-konten');
    }

    public function destroy($id)
    {
        $data_spesifik = Konten::findOrFail($id);
        $image_path = public_path("content/{$data_spesifik->gambar}");
        File::delete($image_path);

        $data_spesifik->delete();
        return redirect()->route('data-konten.index');
    }

    public function tampilContent()
    {
        $tampilContent = Konten::where('kategori', 'Gallery')->get()->sortByDesc('created_at');
        return view('pages.gallery', ['tampilContent' => $tampilContent]);
    }

    public function homeContent()
    {
        $tampilContent = Konten::where('kategori', 'Dashboard')->get();
        return view('index', ['tampilContent' => $tampilContent]);
    }

    public function infoContent()
    {
        $tampilContent = Konten::orderBy('created_at', 'asc')->get()->where('kategori', 'Informasi');
        return view('pages.info', ['tampilContent' => $tampilContent]);
    }

    public function homeUser()
    {
        $santri = Auth::user()->username;
        $waktu = Carbon::now();
        $notif_tagihan = Tagihan::where('status', 'aktif')->where('nis', $santri)->where('tahun', Carbon::now()->year)->where('bulan', $waktu->isoFormat('MMMM'))->paginate(1);
        $notif_info = Informasi::where('penerima', $santri)->where('created_at', '>', date('Y-m-d', strtotime("-3 days")))->latest()->paginate(1);
        $tampilContent = Konten::where('kategori', 'Dashboard')->get();
        return view('users.dashboard', [
            'tampilContent' => $tampilContent,
            'notif_tagihan' => $notif_tagihan,
            'notif_info' => $notif_info,
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $this->printData = Konten::where('judul', 'like', '%' . $keyword . '%')->orderBy('judul', 'asc')->get();
        return view('admin_v_konten')->with([
            'uploads' => $this->printData
        ]);
    }
}
