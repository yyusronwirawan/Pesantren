<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Konten;
use App\Models\Setting;
use App\Models\Tagihan;
use App\Models\Informasi;
use Illuminate\Http\Request;
use App\Models\JadwalKegiatan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function tampilContent()
    {
        $setting = Setting::findOrFail(1);
        $tampilContent = Konten::where('kategori', 'galeri')->get()->sortByDesc('created_at');
        return view('pages.gallery', ['tampilContent' => $tampilContent, 'setting' => $setting,]);
    }

    public function homeContent()
    {
        $setting = Setting::findOrFail(1);
        $tampilContent = Konten::where('kategori', 'Dashboard')->get();
        return view('index', [
            'tampilContent' => $tampilContent,
            'setting' => $setting,
        ]);
    }

    public function infoContent()
    {
        $setting = Setting::findOrFail(1);
        $tampilContent = Konten::orderBy('created_at', 'asc')->get()->where('kategori', 'pengumuman');
        return view('pages.info', ['tampilContent' => $tampilContent, 'setting' => $setting,]);
    }

    public function PengumumanDetail($id)
    {
        $setting = Setting::findOrFail(1);
        $santri = Auth::user()->username;
        $waktu = Carbon::now();
        $notif_tagihan = Tagihan::where('status', 'aktif')->where('nis', $santri)->where('tahun', Carbon::now()->year)->where('bulan', $waktu->isoFormat('MMMM'))->paginate(1);
        $notif_info = Informasi::where('penerima', $santri)->where('created_at', '>', date('Y-m-d', strtotime("-3 days")))->latest()->paginate(1);
        $pengumuman = Konten::findOrFail($id);
        return view('users.detail_pengumuman', [
            'pengumuman' => $pengumuman,
            'title' => 'Detail Pengumuman',
            'notif_tagihan' => $notif_tagihan,
            'notif_info' => $notif_info,
            'setting' => $setting,
        ]);
    }

    public function infoDetail($id)
    {
        $setting = Setting::findOrFail(1);
        $pengumuman = Konten::findOrFail($id);
        return view('pages.detail_info', [
            'pengumuman' => $pengumuman,
            'title' => 'Detail Pengumuman',
            'setting' => $setting,
        ]);
    }

    public function about()
    {
        $setting = Setting::findOrFail(1);
        return view('pages.about', [
            'setting' => $setting,
        ]);
    }

    public function homeUser()
    {
        $setting = Setting::findOrFail(1);
        $pengumuman = Konten::orderBy('created_at', 'asc')->where('kategori', 'pengumuman')->paginate(3);
        $jadwal = JadwalKegiatan::orderBy('mulai', 'asc')->where('hari', Carbon::now()->isoFormat('dddd'))->get();
        $santri = Auth::user()->username;
        $waktu = Carbon::now();
        $notif_tagihan = Tagihan::where('status', 'aktif')->where('nis', $santri)->where('tahun', Carbon::now()->year)->where('bulan', $waktu->isoFormat('MMMM'))->paginate(1);
        $notif_info = Informasi::where('penerima', $santri)->where('created_at', '>', date('Y-m-d', strtotime("-3 days")))->latest()->paginate(1);
        $setting = Setting::findOrFail(1);
        $tampilContent = Konten::where('kategori', 'Dashboard')->get();
        return view('users.dashboard', [
            'pengumuman' => $pengumuman,
            'notif_tagihan' => $notif_tagihan,
            'notif_info' => $notif_info,
            'jadwal' => $jadwal,
            'waktu' => $waktu,
            'setting' => $setting,
            'tampilContent' => $tampilContent,
            'setting' => $setting,
        ]);
    }
}
