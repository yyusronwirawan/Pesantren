<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UpdateKelasImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        // return dd($rows);
        foreach ($rows as $row) 
        {
            User::where('username', $row['nis'])
            ->update([
                'kelas' => $row['kelas'],
                'tahun_ajar' =>$row['tahun_ajaran'],
            ]);


        }
    }
}
