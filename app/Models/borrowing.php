<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class borrowing extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'tgl_pinjam',
        'lama_pinjam',
        'nominal_denda',
        'id_anggota',
        'id_denda',
        'id_user',
    ];

    public function member()
    {
        return $this->belongsTo(member::class, 'id_anggota');
    }

    public function fine()
    {
        return $this->belongsTo(fine::class, 'id_denda');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function borrowing_detail()
{
    return $this->hasMany(borrowing_detail::class, 'id_pinjam');
}
}
