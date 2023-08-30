<?php

namespace App\Exports;

use App\Models\Nilai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\Auth;

class Export implements FromCollection, withHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $data;

    public function collection()
    {
        $guru = Auth::user()->kelas;

        return Nilai::where('pelajaran', $guru)->orderBy('nis', 'asc')->get([
            'nis', 'nama', 'kelas', 'pelajaran', 'kehadiran', 'tugas', 'uts', 'uas'
        ]);
    }

    public function headings(): array
    {
        return [
            'NIS', 'Nama Santri', 'Kelas', 'Pelajaran', 'Kehadiran', 'Tugas', 'UTS', 'UAS'
        ];
    }
}
