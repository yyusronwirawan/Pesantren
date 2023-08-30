<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAkun extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = ['name', 'username', 'level', 'email', 'password', 'kelas', 'tahun_ajar', 'angkatan', 'created_at', 'updated_at'];
}
