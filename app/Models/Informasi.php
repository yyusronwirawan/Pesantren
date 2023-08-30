<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;

    protected $table = 'data_informasi';
    protected $fillable = ['penerima', 'judul', 'gambar', 'deskripsi', 'created_at', 'updated_at'];
}
