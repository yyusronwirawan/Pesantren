<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        $data_prestasi = Prestasi::orderBy('created_at', 'ASC')->paginate(5);
        return view('admin.v_prestasi', [
            'prestasi' => $data_prestasi, "title" => "Data Prestasi"
        ]);
    }

    public function create(Request $request)
    {
        \App\Models\Prestasi::create($request->all);
    }

    public function store(Request $request)
    {
        $data_prestasi = $request->validate([
            'nama_prestasi'     => 'required',
            'tingkatan'     => 'required',
        ]);

        Prestasi::create($data_prestasi);

        return redirect()->route('data-prestasi');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit_prestasi = Prestasi::findOrFail($id);
        return view('admin.edit_prestasi')->with([
            'prestasi' => $edit_prestasi, "title" => "Edit Capaian"
        ]);
    }

    public function update(Request $request, $id)
    {
        $update_prestasi = $request->all();
        $prestasi_santri = Prestasi::findOrFail($id);
        $prestasi_santri->update($update_prestasi);
        return redirect('data-prestasi');
    }

    public function destroy($id)
    {
        $hapus_prestasi = Prestasi::findOrFail($id);
        $hapus_prestasi->delete();
        return redirect()->route('data-prestasi');
    }
}
