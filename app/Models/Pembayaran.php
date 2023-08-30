<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'data_pembayaran';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
