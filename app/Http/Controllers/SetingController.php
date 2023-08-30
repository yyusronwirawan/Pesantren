<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SetingController extends Controller
{
    public function index()
    {
        $banner = Konten::where('kategori', 'Dashboard')->get();
        $setting = Setting::findOrFail(1);

        return view('admin.v_setting_aplikasi', [
            'banner' => $banner,
            'setting' => $setting,
            'title' => 'Setting Aplikasi',

        ]);
    }
    public function update(Request $request, $id)
    {

        $image_lama = $request->logo_old;
        $image_baru = $request->file('logo_aplikasi');

        if ($image_baru == '') {
            $gambar = $image_lama;
            $setting = Setting::findOrFail($id);
            $setting->update(array(
                'nama_aplikasi' => $request->nama_aplikasi,
                'nama_pesantren' => $request->nama_pesantren,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'website' => $request->website,
                'pengasuh' => $request->pengasuh,
                'izin' => $request->izin,
                'nominal_syariyyah' => $request->nominal_syariyyah,
                'logo_aplikasi' => $gambar,
            ));
        } else {
            $new_image = rand() . '.' . $image_baru->getClientOriginalExtension();
            $gambar = $new_image;
            $image_baru->move(public_path('content'), $new_image);
            $setting = Setting::findOrFail($id);
            $setting->update(array(
                'nama_aplikasi' => $request->nama_aplikasi,
                'nama_pesantren' => $request->nama_pesantren,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'website' => $request->website,
                'pengasuh' => $request->pengasuh,
                'izin' => $request->izin,
                'nominal_syariyyah' => $request->nominal_syariyyah,
                'logo_aplikasi' => $gambar,
            ));
            File::delete('content/' . $request->logo_old);
        }



        return redirect('setting-aplikasi')->with('success', 'Pengaturan dasr berhasil diupdate!');
    }

    public function maintenance(Request $request, $id)
    {

        $setting = Setting::findOrFail($id);
        $setting->update(array(
            'maintenance' => $request->maintenance,
        ));
        return redirect('setting-aplikasi')->with('success', 'Pengaturan dasr berhasil diupdate!');
    }

    public function update_banner(Request $request, $id)
    {
        $image_lama = $request->old_image;
        $image_baru = $request->file('gambar');

        if ($image_baru == '') {
            $gambar = $image_lama;
            $deskripsi = "Gambar Lama";
            $content = Konten::findOrFail($id);
            $content->update(array(
                'judul' => $request->judul,
                'kategori' => $request->kategori,
                'gambar' => $gambar,
                'deskripsi' => $request->deskripsi,
            ));
        } else {
            $new_image = rand() . '.' . $image_baru->getClientOriginalExtension();
            $gambar = $new_image;
            $image_baru->move(public_path('content'), $new_image);
            $content = Konten::findOrFail($id);
            $content->update(array(
                'judul' => $request->judul,
                'kategori' => $request->kategori,
                'gambar' => $gambar,
                'deskripsi' => $request->deskripsi,
            ));
            File::delete('content/' . $request->old_image);
        }
        return redirect('setting-aplikasi');
    }
}
