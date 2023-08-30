<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\User;
use App\Models\Konten;
use App\Models\Setting;
use App\Models\Tagihan;
use App\Models\Informasi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use PDF;

class PembayaranController extends Controller
{
    public function index()
    {
        $setting = Setting::findOrFail(1);
        $user = User::where('level', 'santri')->get();

        $data_pembayaran = Pembayaran::orderBy('created_at', 'asc')->get();
        return view('pengurus.v_pembayaran', [
            'colleges' => $data_pembayaran,
            'setting' => $setting,
            'user' => $user
        ]);
    }


    public function create(Request $request)
    {
        // Mengirim data dari modal tambah ke database
        \App\Models\Pembayaran::create($request->all);
    }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'nis'           => 'required',
        //     'nama'          => 'required',
        //     'tanggal'       => 'required',
        //     'nominal'       => 'required',
        //     'bukti'         => 'required|image|mimes:png,jpg,jpeg',
        //     'keterangan'    => 'required'
        // ]);

        // //upload image
        // $image = $request->file('bukti');
        // $image->storeAs('public/blogs', $image->hashName());

        // $bukti = Pembayaran::create([
        //     'nis'           => $request->nis,
        //     'nama'          => $request->nama,
        //     'tanggal'       => $request->tanggal,
        //     'nominal'       => $request->nominal,
        //     'bukti'         => $image->hashName(),
        //     'keterangan'    => $request->keterangan
        // ]);

        // if($bukti){
        //     //redirect dengan pesan sukses
        //     return redirect()->route('data-pembayaran.index')->with(['success' => 'Data Berhasil Disimpan!']);
        // }else{
        //     //redirect dengan pesan error
        //     return redirect()->route('data-pembayaran.index')->with(['error' => 'Data Gagal Disimpan!']);
        // }

        $input_data = $request->all();

        //  Array 1 dimensi
        $id = DB::select("SHOW TABLE STATUS LIKE 'data_pembayaran'");
        $next_id = $id[0]->Auto_increment;
        // jika id terbaru lebih dari sama dengan 10 maka keluaranya 00 + id terbaru
        if ($next_id >= 10) {
            $input_data['id'] = '0' . $next_id;
            Pembayaran::create($input_data);
            // Session::flash('success', 'Data berhasil ditambahkan!');
        } else {
            // selain itu maka 0 + id terbaru
            // default value dari nomor karyawan adalah 0 + id terbaru
            $input_data['id'] = '00' . $next_id;
            // tambah data
            Pembayaran::create($input_data);
            // Session::flash('error', 'Data gagal ditambahkan!');
        }
        $tagihan = Tagihan::finOrFail($request->nis);
        $tagihan->delete();
        return redirect()->route('data-pembayaran.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data_pembayaran = Pembayaran::findOrFail($id);
        return view('pengurus.edit_pembayaran')->with([
            'colleges' => $data_pembayaran
        ]);
    }

    public function update(Request $request, $id)
    {
        $input_update = $request->all();
        $data_spesifik = Pembayaran::findOrFail($id);
        $data_spesifik->update($input_update);
        return redirect('data-pembayaran');
    }

    public function destroy($id)
    {
        $data_spesifik = Pembayaran::findOrFail($id);
        $data_spesifik->delete();
        return redirect()->route('data-pembayaran.index');
    }

    public function cetakForm()
    {
        return view('pengurus.cetak_form');
    }

    public function cetakPertanggal($tglawal, $tglakhir)
    {
        $cetakPertanggal = Pembayaran::orderBy('tanggal', 'asc')->whereBetween('created_at', [$tglawal, $tglakhir])->get();
        return view('pengurus.cetak_pertanggal', [
            'colleges' => $cetakPertanggal
        ]);
    }

    public function tampil()
    {
        $buktiPembayaran = Pembayaran::latest()->get();
        return view('users.upload_bukti', compact('buktiPembayaran'));
    }

    public function riwayat()
    {
        $setting = Setting::findOrFail(1);
        $santri = Auth::user()->username;
        $pembayaran = Pembayaran::where('nis', $santri)->where('status', 'settlement')->get();
        $pembayaran1 = Pembayaran::where('nis', $santri)->where('status', 'capture')->get();

        $waktu = Carbon::now();
        $notif_tagihan = Tagihan::where('status', 'aktif')->where('nis', $santri)->where('tahun', Carbon::now()->year)->where('bulan', $waktu->isoFormat('MMMM'))->paginate(1);
        $notif_info = Informasi::where('penerima', $santri)->where('created_at', '>', date('Y-m-d', strtotime("-3 days")))->latest()->paginate(1);
        $tampilContent = Konten::where('kategori', 'Dashboard')->get();

        return view('users.riwayat_bayar', [
            'riwayatPembayaran' => $pembayaran,
            'riwayatPembayaran1' => $pembayaran1,
            'tampilContent' => $tampilContent,
            'notif_tagihan' => $notif_tagihan,
            'notif_info' => $notif_info,
            'setting' => $setting,
        ]);
    }

    public function cetak($id)
    {
        $santri = Auth::user()->username;
        $tanggal = Carbon::now();
        $pembayaran = Pembayaran::findOrFail($id);

        $pdf = PDF::loadview('users.kwitansi', ['riwayatPembayaran' => $pembayaran, 'tanggal' => $tanggal, 'title' => $pembayaran->order_id]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('Kwitansi - ' . $pembayaran->tagihan . '.pdf');
    }


    public function cetak_perbulan_user(Request $request)
    {

        $santri = Auth::user()->username;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $tanggal = Carbon::now();
        $data = Pembayaran::where('nis', $santri)->where('bulan', $bulan)->where('tahun', $tahun)->get();

        $pdf = PDF::loadview('users.cetak_riwayat_bayar', ['data' => $data, 'tanggal' => $tanggal, 'title' => 'Riwayat Pembayaran' . $bulan . ' ' . $tahun]);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->download('Riwayat Pembayaran ' . $bulan . ' ' . $tahun . '.pdf');
    }

    public function cetak_all_user()
    {
        $santri = Auth::user()->username;
        $tanggal = Carbon::now();
        $data = Pembayaran::where('nis', $santri)->get();

        $pdf = PDF::loadview('pengurus.laporan_pembayaran', ['data' => $data, 'tanggal' => $tanggal, 'title' => 'Laporan Pembayaran Semua']);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->download('Riwayat Pembayaran Semua.pdf');
    }

    public function cetak_pertahun_user(Request $request)
    {
        $santri = Auth::user()->username;
        $tahun = $request->tahun;
        $tanggal = Carbon::now();
        $data = Pembayaran::where('nis', $santri)->where('tahun', $tahun)->get();

        $pdf = PDF::loadview('users.cetak_riwayat_bayar', ['data' => $data, 'tanggal' => $tanggal, 'title' => 'Riwayat Pembayaran' . $tahun]);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->download('Riwayat Pembayaran ' . $tahun . '.pdf');
    }

    public function cari_data_riwayat(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $setting = Setting::findOrFail(1);
        $santri = Auth::user()->username;
        $pembayaran = Pembayaran::where('nis', $santri)->where('status', 'settlement')->where('bulan', $bulan)->where('tahun', $tahun)->get();
        $pembayaran1 = Pembayaran::where('nis', $santri)->where('status', 'capture')->where('bulan', $bulan)->where('tahun', $tahun)->get();

        $waktu = Carbon::now();
        $notif_tagihan = Tagihan::where('status', 'aktif')->where('nis', $santri)->where('tahun', Carbon::now()->year)->where('bulan', $waktu->isoFormat('MMMM'))->paginate(1);
        $notif_info = Informasi::where('penerima', $santri)->where('created_at', '>', date('Y-m-d', strtotime("-3 days")))->latest()->paginate(1);
        $tampilContent = Konten::where('kategori', 'Dashboard')->get();

        return view('users.riwayat_bayar', [
            'riwayatPembayaran' => $pembayaran,
            'riwayatPembayaran1' => $pembayaran1,
            'tampilContent' => $tampilContent,
            'notif_tagihan' => $notif_tagihan,
            'notif_info' => $notif_info,
            'setting' => $setting,
        ]);
    }

    public function detail($id)
    {
        $santri = Auth::user()->username;
        $detail = Pembayaran::findOrFail($id);
        return view('users.detail_riwayat', ['detail' => $detail]);
    }


    public function editTagihan($id)
    {
        $edit_tagihan = Pembayaran::findOrFail($id);
        return view('users.upload_bukti')->with([
            'dataTagihan' => $edit_tagihan
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $this->printData = Pembayaran::where('nama', 'like', '%' . $keyword . '%')->orderBy('nama', 'asc')->get();
        return view('pengurus.v_pembayaran')->with([
            'colleges' => $this->printData
        ]);
    }

    public function tutorial()
    {
        $setting = Setting::findOrFail(1);
        $santri = Auth::user()->username;
        $waktu = Carbon::now();
        $notif_tagihan = Tagihan::where('status', 'aktif')->where('nis', $santri)->where('tahun', Carbon::now()->year)->where('bulan', $waktu->isoFormat('MMMM'))->paginate(1);
        $notif_info = Informasi::where('penerima', $santri)->where('created_at', '>', date('Y-m-d', strtotime("-3 days")))->latest()->paginate(1);
        $tampilContent = Konten::where('kategori', 'Dashboard')->get();
        return view('users.tutorial', [
            'tampilContent' => $tampilContent,
            'notif_tagihan' => $notif_tagihan,
            'notif_info' => $notif_info,
            'setting' => $setting,
        ]);
    }

    public function cetak_perbulan(Request $request)
    {

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $user = User::where('level', 'santri')->get();
        $tanggal = Carbon::now();
        $data = Pembayaran::where('bulan', $bulan)->where('tahun', $tahun)->get();

        $pdf = PDF::loadview('pengurus.laporan_pembayaran', ['data' => $data, 'tanggal' => $tanggal, 'title' => $bulan . '-' . $tahun, 'user' => $user]);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->download('Laporan-Pembayaran-' . $bulan . '-' . $tahun . '.pdf');
    }
    public function cetak_all()
    {
        $user = User::where('level', 'santri')->get();
        $tanggal = Carbon::now();
        $data = Pembayaran::all();

        $pdf = PDF::loadview('pengurus.laporan_pembayaran', ['data' => $data, 'tanggal' => $tanggal, 'title' => 'Laporan Pembayaran Semua', 'user' => $user]);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->download('Laporan-Pembayaran-Semua.pdf');
    }
}
