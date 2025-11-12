<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    use HasFactory;

    protected $table = 'kategori_buku';

    protected $fillable = ['kategori'];

    public $timestamps = false;

    public function books()
    {
        return $this->hasMany(Book::class, 'id_kategori');
    }
}
