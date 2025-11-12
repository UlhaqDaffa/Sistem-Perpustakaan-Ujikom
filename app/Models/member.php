<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class member extends Model
{
    use HasFactory;

    protected $table = 'id_anggota';
    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'tgl_lahir',
        'tgl_daftar',
    ];

    public function borrowing()
    {
        return $this->hasMany(borrowing::class);
    }
}
