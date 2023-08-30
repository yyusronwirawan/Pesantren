<?php

namespace App\Http\Controllers;

use App\Models\Konten;
use App\Models\Setting;
use App\Models\Tagihan;
use App\Models\Informasi;
use Illuminate\Http\Request;
use App\Models\JadwalKegiatan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JadwalKegiatanController extends Controller
{
    public function index()
    {
        $jadwal = JadwalKegiatan::orderBy('created_at', 'asc')->paginate(5);
        return view('admin.v_jadwal', [
            'events' => $jadwal, 'title' => 'Jadwal Kegiatan'
        ]);
    }

    public function create(Request $request)
    {
        \App\Models\JadwalKegiatan::create($request->all);
    }

    public function store(Request $request)
    {
        $jadwalKegiatan = $request->all();
        //  Array 1 dimensi
        $id = DB::select("SHOW TABLE STATUS LIKE 'jadwal_kegiatan'");
        $next_id = $id[0]->Auto_increment;
        if ($next_id >= 10) {
            $jadwalKegiatan['id'] = '0' . $next_id;
            JadwalKegiatan::create($jadwalKegiatan);
        } else {
            $jadwalKegiatan['id'] = '00' . $next_id;
            JadwalKegiatan::create($jadwalKegiatan);
        }
        return redirect()->route('data-kegiatan');
    }

    public function show()
    {
        $jadwal_kegiatan = JadwalKegiatan::where('hari', 'senin')->orderBy('waktu', 'asc')->get();
        return view('users.jadwal', [
            'tampilJadwal' => $jadwal_kegiatan
        ]);
    }

    public function edit($id)
    {
        $edit_jadwal = JadwalKegiatan::findOrFail($id);
        return view('admin.edit_jadwal')->with([
            'events' => $edit_jadwal, 'title' => 'Ubah Jadwal'
        ]);
    }

    public function update(Request $request, $id)
    {
        $update_jadwal = $request->all();
        $jadwal_santri = JadwalKegiatan::findOrFail($id);
        $jadwal_santri->update($update_jadwal);
        return redirect('data-kegiatan');
    }

    public function destroy($id)
    {
        $hapus_jadwal = JadwalKegiatan::findOrFail($id);
        $hapus_jadwal->delete();
        return redirect()->route('data-kegiatan');
    }

    public function jadwalKegiatan()
    {
        $ahad = JadwalKegiatan::orderBy('mulai', 'asc')->where('hari', 'ahad')->get();
        $senin = JadwalKegiatan::orderBy('mulai', 'asc')->where('hari', 'senin')->get();
        $selasa = JadwalKegiatan::orderBy('mulai', 'asc')->where('hari', 'selasa')->get();
        $rabu = JadwalKegiatan::orderBy('mulai', 'asc')->where('hari', 'rabu')->get();
        $kamis = JadwalKegiatan::orderBy('mulai', 'asc')->where('hari', 'kamis')->get();
        $jumat = JadwalKegiatan::orderBy('mulai', 'asc')->where('hari', 'jumat')->get();
        $sabtu = JadwalKegiatan::orderBy('mulai', 'asc')->where('hari', 'sabtu')->get();

        $santri = Auth::user()->username;
        $waktu = Carbon::now();
        $notif_tagihan = Tagihan::where('status', 'aktif')->where('nis', $santri)->where('tahun', Carbon::now()->year)->where('bulan', $waktu->isoFormat('MMMM'))->paginate(1);
        $notif_info = Informasi::where('penerima', $santri)->where('created_at', '>', date('Y-m-d', strtotime("-3 days")))->latest()->paginate(1);
        $tampilContent = Konten::where('kategori', 'Dashboard')->get();
        $setting = Setting::findOrFail(1);

        return view('users.jadwal', [
            'ahad' => $ahad,
            'senin' => $senin,
            'selasa' => $selasa,
            'rabu' => $rabu,
            'kamis' => $kamis,
            'jumat' => $jumat,
            'sabtu' => $sabtu,

            'tampilContent' => $tampilContent,
            'notif_tagihan' => $notif_tagihan,
            'notif_info' => $notif_info,
            'setting' => $setting,
        ]);
    }
}
