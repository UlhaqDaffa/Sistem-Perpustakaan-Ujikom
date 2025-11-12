<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class borrowing_detail extends Model
{
    protected $table = 'detail_pinjam';
    protected $fillable = [
        'tgl_kembali'
    ];

    public function book()
    {
        return $this->belongsToMany(book::class);
    }
}
