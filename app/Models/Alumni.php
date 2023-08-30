<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'data_alumni';
    protected $fillable = ['nama', 'angkatan', 'alamat', 'no_hp', 'created_at', 'updated_at'];
}
