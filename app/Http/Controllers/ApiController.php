<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function payment_handler(Request $request)
    {
        $json = json_decode($request->getContent());

        $signature_key = hash('sha512', $json->order_id . $json->status_code . $json->gross_amount . env('MIDTRANS_SERVER_KEY'));

        if ($signature_key != $json->signature_key) {
            return abort(404);
        }

        //Jika Berhasil
        $data_bayar = Pembayaran::where('order_id', $json->order_id);
        if ($json->transaction_status == 'settlement' || $json->transaction_status == 'capture') {
            DB::table('tagihans')->where('order_id', $json->order_id)->delete();
            $data_bayar->update(['status' => $json->transaction_status]);
        } else {
            DB::table('tagihans')->where('order_id', $json->order_id)->update([
                'keterangan' => 'Belum Lunas',
            ]);
            $data_bayar->delete();
        }
        return 1;
    }
}
