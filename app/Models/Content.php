<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    protected $table = 'content';
    protected $fillable = ['content_id', 'judul', 'kategori', 'gambar', 'deskripsi', 'created_at', 'updated_at'];
}
