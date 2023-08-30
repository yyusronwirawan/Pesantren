<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Nilai;
use App\Models\Konten;
use App\Models\Setting;
use App\Models\Tagihan;
use App\Models\Informasi;
use App\Imports\NilaiImport;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Export;


class NilaiController extends Controller
{
    public function index()
    {
        $guru = Auth::user()->kelas;
        $nilai = Nilai::where('pelajaran', $guru)->orderBy('nis', 'asc')->get();
        return view('guru.data_nilai', [
            'nilai' => $nilai
        ]);
    }

    public function tampil_nilai_guru(Request $request)
    {
        $kelas = $request->kelas;
        $tahun = $request->tahun;
        $guru = Auth::user()->kelas;
        $nilai = Nilai::where('pelajaran', $guru)->where('kelas', $kelas)->where('tahun_ajar', $tahun)->paginate(10);
        return view('guru.data_nilai', [
            'nilai' => $nilai

        ]);
    }
    public function create(Request $request)
    {
        \App\Models\SantriMapel::create($request->all);
    }

    public function store(Request $request)
    {
        $dataNilai = $request->all();
        //  Array 1 dimensi
        $id = DB::select("SHOW TABLE STATUS LIKE 'data_nilai'");
        $next_id = $id[0]->Auto_increment;
        if ($next_id >= 10) {
            $dataNilai['id'] = '0' . $next_id;
            Nilai::create($dataNilai);
        } else {
            $dataNilai['id'] = '00' . $next_id;
            Nilai::create($dataNilai);
        }
        return redirect()->route('data-nilai');
    }


    public function importNilai(Request $request)
    {
        Excel::import(new NilaiImport, $request->file('data'));

        return redirect('/data-nilai')->with('importSuccess', 'Import Data Nilai Berhasil');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit_nilai = Nilai::findOrFail($id);
        return view('guru.edit_nilai')->with([
            'nilai' => $edit_nilai
        ]);
    }

    public function update(Request $request, $id)
    {
        $update_nilai = $request->all();
        $nilai_santri = Nilai::findOrFail($id);
        $nilai_santri->update($update_nilai);
        return redirect('data-nilai');
    }

    public function destroy($id)
    {
        $hapus_nilai = Nilai::findOrFail($id);
        $hapus_nilai->delete();
        return redirect()->route('data-nilai');
    }

    public function tampilUser()
    {
        $santri = Auth::user()->username;
        $nilai = Nilai::where('nis', $santri)->get();
        $mapel = User::where('level', 'pendidik')->get();
        $waktu = Carbon::now();
        $notif_tagihan = Tagihan::where('status', 'aktif')->where('nis', $santri)->where('tahun', Carbon::now()->year)->where('bulan', $waktu->isoFormat('MMMM'))->paginate(1);
        $notif_info = Informasi::where('penerima', $santri)->where('created_at', '>', date('Y-m-d', strtotime("-3 days")))->latest()->paginate(1);
        $tampilContent = Konten::where('kategori', 'Dashboard')->get();
        $setting = Setting::findOrFail(1);

        return view('users.nilai', [
            'tampilUser' => $nilai,
            'tampilContent' => $tampilContent,
            'notif_tagihan' => $notif_tagihan,
            'notif_info' => $notif_info,
            'setting' => $setting,
            'mapel' => $mapel
        ]);
    }



    public function tampil_nilai(Request $request)
    {
        $santri = Auth::user()->username;
        $kelas = $request->kelas;
        $tahun = $request->tahun;
        $nilai = Nilai::where('nis', $santri)->where('kelas', $kelas)->where('tahun_ajar', $tahun)->get();
        $mapel = User::where('level', 'pendidik')->get();
        $waktu = Carbon::now();
        $notif_tagihan = Tagihan::where('status', 'aktif')->where('nis', $santri)->where('tahun', Carbon::now()->year)->where('bulan', $waktu->isoFormat('MMMM'))->paginate(1);
        $notif_info = Informasi::where('penerima', $santri)->where('created_at', '>', date('Y-m-d', strtotime("-3 days")))->latest()->paginate(1);
        $tampilContent = Konten::where('kategori', 'Dashboard')->get();
        $setting = Setting::findOrFail(1);

        return view('users.nilai', [
            'kelas' => $kelas,
            'tahun' => $tahun,
            'tampilUser' => $nilai,
            'tampilContent' => $tampilContent,
            'notif_tagihan' => $notif_tagihan,
            'notif_info' => $notif_info,
            'setting' => $setting,
            'mapel' => $mapel
        ]);
    }

    public function cetak_nilai(Request $request)
    {
        $santri = Auth::user()->username;
        $tanggal = Carbon::now();
        $kelas = $request->kelas;
        $tahun = $request->tahun;
        $nilai = Nilai::where('nis', $santri)->where('kelas', $kelas)->where('tahun_ajar', $tahun)->get();
        // return view('users.cetak_nilai', ['tampilUser' => $nilai, 'tanggal'=>$tanggal, 'title'=>'Rekap Nilai '.$kelas.' '.$tahun]);
        $pdf = PDF::loadview('users.cetak_nilai', ['tampilUser' => $nilai, 'tanggal' => $tanggal, 'title' => 'Rekap Nilai ' . $kelas . ' ' . $tahun]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('Rekap Nilai ' . $kelas . '' . $tahun . '.pdf');
    }
    public function cetak_nilai_pelajaran(Request $request)
    {
        $santri = Auth::user()->username;
        $tanggal = Carbon::now();
        $mapel = $request->pelajaran;
        $kelas = $request->kelas;
        $tahun = $request->tahun;
        $nilai = Nilai::where('nis', $santri)->where('pelajaran', $mapel)->where('kelas', $kelas)->where('tahun_ajar', $tahun)->get();
        // return view('users.cetak_nilai', ['tampilUser' => $nilai, 'tanggal'=>$tanggal, 'title'=>'Rekap Nilai '.$kelas.' '.$tahun]);
        $pdf = PDF::loadview('users.cetak_nilai', ['tampilUser' => $nilai, 'tanggal' => $tanggal, 'title' => 'Rekap Nilai ' . $mapel . ' ' . $kelas . ' ' . $tahun]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('Rekap Nilai ' . $mapel . ' ' . $kelas . ' ' . $tahun . '.pdf');
    }

    public function cetak_nilai_all()
    {
        $santri = Auth::user()->username;
        $tanggal = Carbon::now();
        $nilai = Nilai::where('nis', $santri)->get();
        // return view('users.cetak_nilai', ['tampilUser' => $nilai, 'tanggal'=>$tanggal, 'title'=>'Rekap Nilai '.$kelas.' '.$tahun]);
        $pdf = PDF::loadview('users.cetak_nilai_all', ['tampilUser' => $nilai, 'tanggal' => $tanggal, 'title' => 'Rekap Nilai Semua Kelas']);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('Rekap Nilai Semua Kelas.pdf');
    }

    public function cetak_nilai_guru()
    {
        $guru = Auth::user()->kelas;
        $tanggal = Carbon::now();
        $nilai = Nilai::where('pelajaran', $guru)->get();
        // return view('users.cetak_nilai', ['tampilUser' => $nilai, 'tanggal'=>$tanggal, 'title'=>'Rekap Nilai '.$kelas.' '.$tahun]);
        $pdf = PDF::loadview('guru.cetak_nilai_all', ['nilai' => $nilai, 'tanggal' => $tanggal, 'title' => 'Rekap Nilai Semua Kelas']);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('Rekap Nilai Semua Kelas.pdf');
    }
    public function cetak(Request $request)
    {
        $pendidik = Auth::user()->kelas;
        $tanggal = Carbon::now();
        $kelas = $request->kelas;
        $tahun = $request->tahun;

        $nilai = Nilai::where('pelajaran', $pendidik)->where('kelas', $kelas)->where('tahun_ajar', $tahun)->orderBy('nis', 'desc')->get();
        // return view('users.cetak_nilai', ['tampilUser' => $nilai, 'tanggal'=>$tanggal, 'title'=>'Rekap Nilai '.$kelas.' '.$tahun]);
        $pdf = PDF::loadview('guru.cetak_nilai_all', ['nilai' => $nilai, 'tanggal' => $tanggal, 'title' => 'Rekap Nilai' . $kelas . ' ' . $tahun]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('Rekap Nilai' . $kelas . ' ' . $tahun . '.pdf');
    }

    public function hitung(Request $request)
    {
        $kehadiran      = $request->input('kehadiran');
        $tugas          = $request->input('tugas');
        $uts            = $request->input('uts');
        $uas            = $request->input('uas');

        $nilai_akhir    = ($kehadiran + $tugas + $uts + $uas) / 4;

        return redirect('data-nilai', $nilai_akhir);
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
            'mapel' => $mapel,
        ]);
    }

    public function export()
    {
        return Excel::download(new Export, 'template_penilaian.xlsx');
    }
}
