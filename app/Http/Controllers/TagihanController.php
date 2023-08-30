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
use PDF;

class TagihanController extends Controller
{
    public function tagihan()
    {
        $setting = Setting::findOrFail(1);
        $username = Auth::user()->username;
        $pembayaran = Pembayaran::where('nis', $username)->get();
        $waktu = Carbon::now();
        $tahun =  Carbon::now()->year;
        $tagihan = Tagihan::where('status', 'aktif')->where('nis', $username)->where('tahun', Carbon::now()->year)->where('bulan', $waktu->isoFormat('MMMM'))->get();
        $tagihan2 = Tagihan::where('status', 'aktif')->where('nis', $username)->where('bulan', '!=', $waktu->isoFormat('MMMM'))->where('tahun', Carbon::now()->year)->paginate(5);
        $pending = Tagihan::where('status', 'aktif')->where('nis', $username)->where('keterangan', 'pending')->get();
        $notif_tagihan = Tagihan::where('status', 'aktif')->where('nis', $username)->where('tahun', Carbon::now()->year)->where('bulan', $waktu->isoFormat('MMMM'))->paginate(1);
        $notif_info = Informasi::where('penerima', $username)->where('created_at', '>', date('Y-m-d', strtotime("-3 days")))->latest()->paginate(1);
        $tampilContent = Konten::where('kategori', 'Dashboard')->get();

        return view(
            'users.tagihan',
            [
                'dataTagihan' => $tagihan,
                'dataTagihan2' => $tagihan2,
                'waktu' => $waktu,
                'tahun' => $tahun,
                'data_bayar' => $pembayaran,
                'tampilContent' => $tampilContent,
                'notif_tagihan' => $notif_tagihan,
                'notif_info' => $notif_info,
                'setting' => $setting,
                'pending' => $pending,
            ]
        );
    }

    public function viewPengurus()
    {
        $setting = Setting::findOrFail(1);
        $tagihan = Tagihan::all();
        $user = User::where('level', 'santri')->get();

        return view(
            'pengurus.v_tagihan',
            [
                'dataTagihan' => $tagihan,
                'setting' => $setting,
                'user' => $user
            ]
        );
    }
    public function destroy($id)
    {

        $tagihan = Tagihan::findOrFail($id);

        $data_bayar = Pembayaran::create([
            'nis' => $tagihan->nis,
            'tagihan' => $tagihan->tagihan,
            'bulan' => $tagihan->bulan,
            'tahun' => $tagihan->tahun,
            'status' => 'settlement',
            'order_id' => $tagihan->order_id,
            'gross_amount' => $tagihan->nominal,
            'payment_type' => 'bank_transfer',
            'bank' => 'Cash',
        ]);

        $tagihan->delete();

        return redirect('/data-tagihan')->with('delete-success', 'Data Berhasil diubah');
    }
    public function store(Request $request)
    {
        $data_tagihan = $request->all();
        $user = User::where('level', 'santri')->get();
        $randomId       =   rand(2, 50);
        foreach ($user as $u) {
            $tagihan = Tagihan::create([
                'nis' => $u->username,
                'tagihan' => $request->tagihan,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
                'nominal' => $request->nominal,
                'order_id' => $randomId,
                'status' => 'aktif',
                'keterangan' => $request->keterangan,
            ]);
        }
        return redirect('/data-tagihan')->with('add-success', 'Data Berhasil ditambah');
    }

    public function waiting($id)
    {
        $setting = Setting::findOrFail(1);
        $username = Auth::user()->username;
        $waktu = Carbon::now();
        $notif_tagihan = Tagihan::where('status', 'aktif')->where('nis', $username)->where('tahun', Carbon::now()->year)->where('bulan', $waktu->isoFormat('MMMM'))->paginate(1);
        $notif_info = Informasi::where('penerima', $username)->where('created_at', '>', date('Y-m-d', strtotime("-3 days")))->latest()->paginate(1);
        $pembayaran = Pembayaran::where('nis', $username)->where('order_id', $id)->get();

        return view(
            'users.waiting_payment',
            [
                'data_bayar' => $pembayaran,
                'notif_tagihan' => $notif_tagihan,
                'notif_info' => $notif_info,
                'setting' => $setting,
            ]
        );
    }


    public function detail(Request $request)
    {
        $setting = Setting::findOrFail(1);
        $username = Auth::user()->username;
        $name = Auth::user()->name;
        $no_hp = Auth::user()->no_hp;
        $waktu = Carbon::now();
        $tagihan = Tagihan::where('status', 'aktif')->where('nis', $username)->where('tagihan', $request->tagihan)->get();
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = true;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $bri = '10100';
        $bni = '10200';
        $bca = '103';
        $mandiri = '1040';
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),


            'bri_va' => array(
                'va_number' => $bri . $username,
            ),
            'bni_va' => array(
                'va_number' => $username,
            ),

            'echannel' => array(
                'bill_key' => $mandiri . $username,
            ),

            'item_details' => array(
                [

                    'id' => '1',
                    'price' =>  $request->nominal,
                    'quantity' => '1',
                    'name' => $request->tagihan . ' ' . $request->bulan . ' ' . $request->tahun,
                ],
                [

                    'id' => '2',
                    'price' =>  '5500',
                    'quantity' => '1',
                    'name' => 'Biaya Admin',

                ]
            ),
            'customer_details' => array(
                'first_name' => $username . ' | ',
                'last_name' => $name,
            ),

        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $notif_tagihan = Tagihan::where('status', 'aktif')->where('nis', $username)->where('tahun', Carbon::now()->year)->where('bulan', $waktu->isoFormat('MMMM'))->paginate(1);
        $notif_info = Informasi::where('penerima', $username)->where('created_at', '>', date('Y-m-d', strtotime("-3 days")))->latest()->paginate(1);
        return view(
            'users.payment',
            [
                'dataTagihan' => $tagihan,
                'waktu' => $waktu,
                'snap_token' => $snapToken,
                'notif_tagihan' => $notif_tagihan,
                'notif_info' => $notif_info,
                'setting' => $setting,
            ]
        );
    }

    public function payment(Request $request)
    {
        // return $request;
        $username = Auth::user()->username;
        $json = json_decode($request->get('json'));
        DB::table('tagihans')->where('id', $request->id)->update([
            'keterangan' => $json->transaction_status,
            'order_id' => $json->order_id
        ]);

        $data_bayar = new Pembayaran();
        $data_bayar->nis = $username;
        $data_bayar->tagihan = $request->tagihan;
        $data_bayar->bulan = $request->bulan;
        $data_bayar->tahun = $request->tahun;
        $data_bayar->status = $json->transaction_status;
        $data_bayar->transaction_id = $json->transaction_id;
        $data_bayar->order_id = $json->order_id;
        $data_bayar->gross_amount = $json->gross_amount;
        $data_bayar->payment_type = $json->payment_type;
        $data_bayar->bank = isset($json->va_numbers[0]->bank) ? $json->va_numbers[0]->bank : null;
        $data_bayar->payment_code = isset($json->payment_code) ? $json->payment_code : null;
        $data_bayar->kode_bank = isset($json->biller_code) ? $json->biller_code : null;
        $data_bayar->bill_key = isset($json->bill_key) ? $json->bill_key : null;

        $data_bayar->va_number = isset($json->va_numbers[0]->va_number) ? $json->va_numbers[0]->va_number : null;
        $data_bayar->pdf_url = isset($json->pdf_url) ? $json->pdf_url : null;
        $data_bayar->save();

        return redirect('/tagihan')->with('payment-success', 'Pembayaran Berhasil Diproses');
    }


    public function cetak_perbulan(Request $request)
    {

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $user = User::where('level', 'santri')->get();
        $tanggal = Carbon::now();
        $data = Tagihan::where('bulan', $bulan)->where('tahun', $tahun)->get();
        // return view('pengurus.laporan_tagihan', ['data' => $data, 'tanggal'=>$tanggal, 'title'=>$bulan.'-'.$tahun, 'user'=>$user]);
        $pdf = PDF::loadview('pengurus.laporan_tagihan', ['data' => $data, 'tanggal' => $tanggal, 'title' => $bulan . '-' . $tahun, 'user' => $user]);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->download('Laporan-Tagihan-' . $bulan . '-' . $tahun . '.pdf');
    }

    public function cari_data(Request $request)
    {
        $nis = $request->nis;
        $setting = Setting::findOrFail(1);
        $tagihan = Tagihan::where('nis', $nis)->get();
        $user = User::where('level', 'santri')->get();

        return view(
            'pengurus.v_tagihan',
            [
                'dataTagihan' => $tagihan,
                'setting' => $setting,
                'user' => $user
            ]
        );
    }
}
