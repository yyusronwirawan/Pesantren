<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_mapel = Mapel::orderBy('nama_mapel', 'ASC')->get();
        return view('admin.v_mapel', [
            'mataPelajaran' => $data_mapel, "title" => "Data Pelajaran"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \App\Models\Mapel::create($request->all);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataMapel = $request->validate([
            'nama_mapel'     => 'required',
            'guru'     => 'required',
        ]);

        Mapel::create($dataMapel);

        return redirect()->route('data-mapel');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_mapel = Mapel::findOrFail($id);
        return view('admin.edit_mapel')->with([
            'mataPelajaran' => $edit_mapel, "title" => "Edit Pelajaran"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update_mapel = $request->all();
        $mapel_santri = Mapel::findOrFail($id);
        $mapel_santri->update($update_mapel);
        return redirect('data-mapel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus_mapel = Mapel::findOrFail($id);
        $hapus_mapel->delete();
        return redirect()->route('data-mapel');
    }
}
