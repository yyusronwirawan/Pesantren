<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Tagihan;
use App\Models\DataAkun;
use App\Models\Pembayaran;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CronJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:tagihan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tagihan untuk pembayaran uang bulanan santri';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = DataAkun::where('level', 'santri')->count();
        $data2 = DataAkun::where('level', 'santri')->get();
        $waktu = Carbon::now();
        $angka = 0;
            foreach ($data2 as $d) {
                Tagihan::create([
                    'nis'=>$d->username,
                    'tagihan' =>'Syariah'.' '. $waktu->isoFormat('MMMM Y'),
                    'bulan' => $waktu->isoFormat('MMMM'),
                    'tahun' => $waktu->isoFormat('Y'),
                    'nominal' => Setting::findOrFail(1)->first()->nominal_syariyyah,
                    'keterangan' => 'Belum Lunas',
                    'status' =>'aktif',
                ]);
            }
    
            \Log::info('Cron Tagihan Berhasil Dijalankan');
    }
}
