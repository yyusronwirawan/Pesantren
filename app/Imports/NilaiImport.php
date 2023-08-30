<?php

namespace App\Imports;

use App\Models\Nilai;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class NilaiImport implements ToCollection, WithHeadingRow
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        // return dd($row);

        foreach ($rows as $row) {
            Nilai::where('nis', $row['nis'])
                ->where('nama', $row['nama_santri'])
                ->where('kelas', $row['kelas'])
                ->where('pelajaran', $row['pelajaran'])
                ->update([
                    "kehadiran"     => $row['kehadiran'],
                    "tugas"         => $row['tugas'],
                    "uts"           => $row['uts'],
                    "uas"           => $row['uas'],

                ]);
        }
    }
}
