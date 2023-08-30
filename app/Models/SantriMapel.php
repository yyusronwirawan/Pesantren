<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SantriMapel extends Model
{
    use HasFactory;
    protected $table = 'santri_mapel';
    protected $fillable = ['santri_id', 'mapel_id', 'kehadiran', 'tugas', 'uts', 'uas'];
}
