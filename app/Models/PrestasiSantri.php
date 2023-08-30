<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiSantri extends Model
{
    use HasFactory;
    protected $table = 'prestasi_santri';
    protected $fillable = ['nis', 'nama', 'prestasi_id', 'keterangan'];
}
