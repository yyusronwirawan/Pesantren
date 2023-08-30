<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Konten;
use App\Models\Setting;
use App\Models\Tagihan;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function tampilAdmin()
    {
        $user = User::where('id', Auth::user()->id)->first();

        return view('admin.account', [
            "title" => "Profil", 'user' => $user
        ]);
    }

    public function updateAdmin(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update(array(
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'level' => $request->level,
        ));
        return redirect('profil-admin');
    }

    public function tampilPengurus()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('pengurus.account', [
            'akun' => $user
        ]);
    }

    public function updatePengurus(Request $request, $id)
    {
        $image_lama = $request->old_image;
        $image_baru = $request->file('foto');

        if ($image_baru == '') {
            $gambar = $image_lama;
        } else {
            $new_image = rand() . '.' . $image_baru->getClientOriginalExtension();
            $gambar = $new_image;
            $image_baru->move(public_path('profil'), $new_image);
        }

        $updateProfil = User::findOrFail($id);
        $updateProfil->update(array(
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'level' => $request->level,
            'kelas' => $request->kelas,
            'foto' => $gambar,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ));

        return redirect('akun-saya');
    }

    public function tampilUser()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $setting = Setting::findOrFail(1);
        $santri = Auth::user()->username;
        $waktu = Carbon::now();
        $notif_tagihan = Tagihan::where('status', 'aktif')->where('nis', $santri)->where('tahun', Carbon::now()->year)->where('bulan', $waktu->isoFormat('MMMM'))->paginate(1);
        $notif_info = Informasi::where('penerima', $santri)->where('created_at', '>', date('Y-m-d', strtotime("-3 days")))->latest()->paginate(1);
        $tampilContent = Konten::where('kategori', 'Dashboard')->get();

        return view('users.account', [
            'accounts' => $user,
            'tampilContent' => $tampilContent,
            'notif_tagihan' => $notif_tagihan,
            'notif_info' => $notif_info,
            'setting' => $setting,
        ]);
    }

    public function updateUser(Request $request, $id)
    {
        $image_lama = $request->old_image;
        $image_baru = $request->file('foto');

        if ($image_baru == '') {
            $gambar = $image_lama;
        } else {
            $new_image = rand() . '.' . $image_baru->getClientOriginalExtension();
            $gambar = $new_image;
            $image_baru->move(public_path('profil'), $new_image);
        }

        $updateProfil = User::findOrFail($id);
        $updateProfil->update(array(
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'level' => $request->level,
            'kelas' => $request->kelas,
            'foto' => $gambar,
            'tgl_lahir' => $request->tgl_lahir,
            'angkatan' => $request->angkatan,
            'alamat' => $request->alamat,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'no_hp' => $request->no_hp,
        ));

        return redirect('profil-user');
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
}
