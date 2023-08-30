<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSantri extends Model
{
    use HasFactory;
    protected $table = 'data_santri';
    protected $fillable = ['nis', 'nama', 'tgl_lahir', 'angkatan', 'alamat', 'created_at', 'updated_at'];
}
