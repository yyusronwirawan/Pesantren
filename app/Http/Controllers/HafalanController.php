<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Konten;
use App\Models\Hafalan;
use App\Models\Setting;
use App\Models\Tagihan;
use App\Models\Prestasi;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HafalanController extends Controller
{
    public function index()
    {
        $data_hafalan = Hafalan::orderBy('created_at', 'desc')->get();
        $datas = Prestasi::all();
        return view('pengurus.v_hafalan', [
            'hafalan' => $data_hafalan, 'prestasi' => $datas
        ]);
    }

    public function create(Request $request)
    {
        // Mengirim data dari modal tambah ke database
        \App\Models\Hafalan::create($request->all);
    }

    public function store(Request $request)
    {
        $input_hafalan = $request->all();
        //  Array 1 dimensi
        $id = DB::select("SHOW TABLE STATUS LIKE 'data_hafalan'");
        $next_id = $id[0]->Auto_increment;
        if ($next_id >= 10) {
            $input_hafalan['id'] = '0' . $next_id;
            Hafalan::create($input_hafalan);
        } else {
            $input_hafalan['id'] = '00' . $next_id;
            Hafalan::create($input_hafalan);
        }
        return redirect()->route('data-hafalan.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit_hafalan = Hafalan::findOrFail($id);
        return view('pengurus.edit_hafalan')->with([
            'hafalan' => $edit_hafalan
        ]);
    }

    public function update(Request $request, $id)
    {
        $update_hafalan = $request->all();
        $data_update = Hafalan::findOrFail($id);
        $data_update->update($update_hafalan);
        return redirect('data-hafalan');
    }

    public function destroy($id)
    {
        $data_update = Hafalan::findOrFail($id);
        $data_update->delete();
        return redirect()->route('data-hafalan.index');
    }

    public function hafalan()
    {
        $santri = Auth::user()->username;
        $riwayatHafalan = Hafalan::where('nis', $santri)->get();

        $prestasi = Prestasi::orderBy('tingkatan', 'asc')->get();

        $waktu = Carbon::now();
        $notif_tagihan = Tagihan::where('status', 'aktif')->where('nis', $santri)->where('tahun', Carbon::now()->year)->where('bulan', $waktu->isoFormat('MMMM'))->paginate(1);
        $notif_info = Informasi::where('penerima', $santri)->where('created_at', '>', date('Y-m-d', strtotime("-3 days")))->latest()->paginate(1);
        $tampilContent = Konten::where('kategori', 'Dashboard')->get();
        $setting = Setting::findOrFail(1);

        return view('users.hafalan', [
            'riwayatHafalan' => $riwayatHafalan,
            'prestasi' => $prestasi,
            'tampilContent' => $tampilContent,
            'notif_tagihan' => $notif_tagihan,
            'notif_info' => $notif_info,
            'setting' => $setting,
        ]);
    }

    public function cetak()
    {

        $santri = Auth::user()->username;
        $data = Hafalan::where('nis', $santri)->get();
        $tanggal = Carbon::now();
        $pdf = PDF::loadview('users.cetak_capaian', ['data' => $data, 'tanggal' => $tanggal, 'title' => 'Capaian Santri']);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->download('Capaian Santri.pdf');
    }


    public function cari(Request $request)
    {
        $keyword = $request->keyword;
        $this->printData = Hafalan::where('nama', 'like', '%' . $keyword . '%')->orderBy('nama', 'asc')->get();
        return view('pengurus.v_hafalan')->with([
            'hafalan' => $this->printData
        ]);
    }

    public function cetakForm()
    {
        return view('pengurus.cetak_form_hafalan');
    }

    public function cetakPertanggal($tglawal, $tglakhir)
    {
        $cetakPertanggal = Hafalan::orderBy('tanggal', 'asc')->whereBetween('tanggal', [$tglawal, $tglakhir])->get();
        return view('pengurus.cetak_hafalan', [
            'hafalan' => $cetakPertanggal
        ]);
    }
}
