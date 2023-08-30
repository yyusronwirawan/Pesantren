<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index()
    {
        $data_alumni = Alumni::orderBy('nama', 'ASC')->get();
        return view('admin.v_alumni', [
            'others' => $data_alumni, "title" => "Data Alumni"
        ]);
    }

    public function create(Request $request)
    {
        \App\Models\Alumni::create($request->all);
    }

    public function store(Request $request)
    {
        $data_alumni = $request->validate([
            'nama'     => 'required',
            'angkatan'     => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        Alumni::create($data_alumni);

        return redirect()->route('data-alumni');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $edit_alumni = Alumni::findOrFail($id);
        return view('admin.edit_alumni')->with([
            'others' => $edit_alumni, "title" => "Ubah Data"
        ]);
    }

    public function update(Request $request, $id)
    {
        $update_alumni = $request->all();
        $data_alumni = Alumni::findOrFail($id);
        $data_alumni->update($update_alumni);
        return redirect('data-alumni');
    }

    public function destroy($id)
    {
        $hapus_alumni = Alumni::findOrFail($id);
        $hapus_alumni->delete();
        return redirect()->route('data-alumni');
    }
}
