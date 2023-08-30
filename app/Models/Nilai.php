<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $table = 'data_nilai';
    protected $fillable = ['nis', 'nama', 'pelajaran', 'kelas', 'tahun_ajar', 'kehadiran', 'tugas', 'uts', 'uas'];

    public function santri()
    {
        return $this->belongsTo(User::class);
    }
}
