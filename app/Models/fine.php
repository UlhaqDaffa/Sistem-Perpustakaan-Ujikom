<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fine extends Model
{
    protected $table = 'denda';
    protected $fillable = ['nominal'];
    public $timestamps = true;

    public function borrowing()
    {
        return $this->hasMany(borrowing::class);
    }
}
