<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    use HasFactory;

    protected $table = 'data_konten';
    protected $fillable = ['judul', 'kategori', 'gambar', 'deskripsi', 'created_at', 'updated_at'];
}
