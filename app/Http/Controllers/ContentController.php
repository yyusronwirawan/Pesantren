<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Session;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $content = Content::latest()->get();
        return view('pengurus.v_content', [
            'uploads' => $content
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        \App\Models\Content::create($request->all);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $upload = $request->gambar;
        $namaFile = time() . rand(100, 999) . "." . $upload->getClientOriginalExtension();

        $dataUpload = new Content;
        $dataUpload->content_id = $request->content_id;
        $dataUpload->judul = $request->judul;
        $dataUpload->kategori = $request->kategori;
        $dataUpload->gambar = $namaFile;
        $dataUpload->deskripsi = $request->deskripsi;

        $upload->move(public_path() . '/content', $namaFile);
        $dataUpload->save();

        return redirect('data-content')->with('success', 'Upload content baru berhasil!');
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
        $content = Content::findOrFail($id);
        return view('pengurus.edit_content')->with([
            'uploads' => $content
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
        $image_lama = $request->old_image;
        $image_baru = $request->file('gambar');

        if ($image_baru == '') {
            $gambar = $image_lama;
            $deskripsi = "Gambar Lama";
        } else {
            $new_image = rand() . '.' . $image_baru->getClientOriginalExtension();
            $gambar = $new_image;
            $image_baru->move(public_path('content'), $new_image);
        }

        $content = Content::findOrFail($id);
        $content->update(array(
            'content_id' => $request->content_id,
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'gambar' => $gambar,
            'deskripsi' => $request->deskripsi,
        ));

        return redirect('data-content');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data_spesifik = Content::findOrFail($id);
        $image_path = public_path("content/{$data_spesifik->gambar}");
        File::delete($image_path);

        $data_spesifik->delete();
        return redirect()->route('data-content.index');
    }

    public function tampilContent()
    {
        $tampilContent = Content::where('kategori', 'Gallery')->get()->sortByDesc('created_at');
        return view('pages.gallery', ['tampilContent' => $tampilContent]);
    }

    public function homeContent()
    {
        $tampilContent = Content::where('kategori', 'Dashboard')->get();
        return view('index', ['tampilContent' => $tampilContent]);
    }

    public function infoContent()
    {
        $tampilContent = Content::orderBy('created_at', 'asc')->get()->where('kategori', 'Informasi');
        return view('pages.info', ['tampilContent' => $tampilContent]);
    }

    public function homeUser()
    {
        $tampilContent = Content::where('kategori', 'Dashboard')->get();
        return view('users.dashboard', ['tampilContent' => $tampilContent]);
    }

    public function pengumuman()
    {
        $tampilContent = Content::orderBy('created_at', 'asc')->get()->where('kategori', 'Pengumuman');
        return view('users.pengumuman', ['tampilContent' => $tampilContent]);
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $this->printData = Content::where('judul', 'like', '%' . $keyword . '%')->orderBy('judul', 'asc')->get();
        return view('pengurus.v_content')->with([
            'uploads' => $this->printData
        ]);
    }
}
