<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = [
        'judul',
        'pengarang',
        'penerbit',
        'tahun',
        'isbn',
        'tgl_input',
        'jml_halaman',
        'id_kategori',
        'id_user',
    ];

    public function kategori()
    {
        return $this->belongsTo(BookCategory::class, 'id_kategori');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
