<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'data_prestasi';
    protected $fillable = ['nama_prestasi', 'tingkatan'];
}
