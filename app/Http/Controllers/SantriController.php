<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Psr7\Request;
use Svg\Tag\Rect;

class SantriController extends Controller
{
    public function santriPengurus()
    {
        $data_santri = User::where('level', 'santri')->orderBy('kelas', 'ASC')->paginate(5);
        return view('pengurus.v_santri', [
            'datas' => $data_santri
        ]);
    }

    public function countData()
    {
        $santri = DB::table('users')->where('level', '=', 'santri')->count();
        $guru = DB::table('users')->where('level', '=', 'pendidik')->count();
        $pembayaran = DB::table('data_pembayaran')->where('status', '=', 'settlement')->count();

        return view('pengurus.v_dashboard', ['santri' => $santri, 'guru' => $guru, 'pembayaran' => $pembayaran]);
    }
}
