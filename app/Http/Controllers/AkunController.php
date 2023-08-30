<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Nilai;
use App\Models\Tagihan;
use App\Models\DataAkun;
use App\Models\Setting;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AkunController extends Controller
{
    public $akunAdmin;
    public $akunSantri;
    public $akunPengurus;
    public $akunPendidik;

    public function index()
    {

        $data_akun = DataAkun::orderBy('level', 'ASC')->paginate(5);
        return view('admin.v_akun', [
            'accounts' => $data_akun, "title" => "Data Akun"
        ]);
    }

    public function create(Request $request)
    {
        // Mengirim data dari modal tambah ke database
        \App\Models\DataAkun::create($request->all);
    }

    public function store(Request $request)
    {
        $tahun = Carbon::now()->year;
        $input_akun = $request->all();
        // return $input_akun;
        $input_akun['password'] = bcrypt($request->password);


        //  Array 1 dimensi
        $id = DB::select("SHOW TABLE STATUS LIKE 'users'");
        $next_id = $id[0]->Auto_increment;
        $mapel = User::where('level', 'pendidik')->get();
        // jika id terbaru lebih dari sama dengan 10 maka keluaranya 00 + id terbaru
        if ($next_id >= 10) {
            $input_akun['id'] = '0' . $next_id;
            foreach ($mapel as $mp) {
                Nilai::create([
                    'nis' => $request->username,
                    'nama' => $request->name,
                    'pelajaran' => $mp->kelas,
                    'kelas' => $request->kelas,
                    'tahun_ajar' => $request->tahun_ajar,
                    'kehadiran' => null,
                    'tugas' => null,
                    'uts' => null,
                    'uas' => null,
                ]);
            }

            DataAkun::create($input_akun);
        } else {
            // selain itu maka 0 + id terbaru
            // default value dari nomor karyawan adalah 0 + id terbaru
            $input_akun['id'] = '00' . $next_id;
            // tambah data
            DataAkun::create($input_akun);
        }
        return redirect()->route('data-akun.index')->with('success', 'Akun Berhasil Dibuat!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit_akun = DataAkun::findOrFail($id);
        return view('admin.edit_akun')->with([
            'accounts' => $edit_akun, "title" => "Ubah Akun"
        ]);
    }

    public function update(Request $request, $id)
    {
        $update_akun = $request->all();
        $update_akun['password'] = bcrypt($request->password);

        $update_data = DataAkun::findOrFail($id);
        $update_data->update($update_akun);
        return redirect('data-akun');
    }

    public function destroy($id)
    {
        $update_data = DataAkun::findOrFail($id);
        $update_data->delete();
        return redirect()->route('data-akun.index');
    }

    public function countAkun()
    {
        $akunAdmin = DB::table('users')->where('level', '=', 'admin')->count();
        $akunSantri = DB::table('users')->where('level', '=', 'santri')->count();
        $akunPengurus = DB::table('users')->where('level', '=', 'pengurus')->count();
        $akunPendidik = DB::table('users')->where('level', '=', 'pendidik')->count();

        return view('admin.dashboard', ["title" => "Dashboard", 'akunAdmin' => $akunAdmin, 'akunSantri' => $akunSantri, 'akunPengurus' => $akunPengurus, 'akunPendidik' => $akunPendidik]);
    }

    // Update Kelas
    public function datakelas()
    {

        $data_akun = DataAkun::where('level', 'santri')->paginate(5);
        return view('admin.edit_kelas', [
            'accounts' => $data_akun, "title" => "Update Kelas"
        ]);
    }

    public function updatekelas(Request $request, $id)
    {
        $update_kelas = $request->all();
        // $update_akun['password'] = bcrypt($request->password);

        $update_data = User::findOrFail($id);
        $update_data->update($update_kelas);

        $mapel = User::where('level', 'pendidik')->get();
        foreach ($mapel as $mp) {
            Nilai::create([
                'nis' => $update_data->username,
                'pelajaran' => $mp->kelas,
                'kelas' => $request->kelas,
                'tahun_ajar' => $request->tahun_ajar,
                'kehadiran' => null,
                'tugas' => null,
                'uts' => null,
                'uas' => null,
            ]);
        }
        return redirect('data-kelas');
    }

    public function grafik()
    {
        $santri = DB::table('users')->where('level', '=', 'santri')->GroupBy(DB::raw("YEAR(created_at)"))->count();

        $tahun = DB::table('users')->where('level', '=', 'santri')->whereYear('created_at', Carbon::now()->format('Y'))->count();
        $tahun2 = DB::table('users')->where('level', '=', 'santri')->whereYear('created_at', Carbon::now()->subYear(1)->format('Y'))->count();
        $tahun3 = DB::table('users')->where('level', '=', 'santri')->whereYear('created_at', Carbon::now()->subYear(2)->format('Y'))->count();
        $tahun4 = DB::table('users')->where('level', '=', 'santri')->whereYear('created_at', Carbon::now()->subYear(3)->format('Y'))->count();
        $tahun5 = DB::table('users')->where('level', '=', 'santri')->whereYear('created_at', Carbon::now()->subYear(4)->format('Y'))->count();

        $setting = Setting::findOrFail(1);

        return view('pages.grafik', compact('santri', 'tahun', 'tahun2', 'tahun3', 'tahun4', 'tahun5', 'setting'));
    }


    public function UpdateKelasImport(Request $request)
    {

        Excel::import(new UpdateKelasImport, $request->file('data'));

        return redirect('/data-kelas')->with('importSuccess', 'Update Data Kelas Berhasil');
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $this->printData = DataAkun::where('name', 'like', '%' . $keyword . '%')->orderBy('name', 'asc')->paginate(5);
        return view('admin.edit_kelas')->with([
            'accounts' => $this->printData, "title" => "Update Kelas"
        ]);
    }
}
