<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'kode_buku',
        'judul',
        'cover',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'kategori_id',
        'stok',
    ];

    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function peminjaman()
{
    return $this->hasMany(Peminjaman::class);
}
}