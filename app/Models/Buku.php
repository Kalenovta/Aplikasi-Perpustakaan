<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='bukus';
    protected $primarykey='id';
    protected $fillable =['id', 'kategori_id', 'judul', 'penulis', 'penerbit', 'isbn', 'tahun', 'jumlah','foto'];

    public function kategori():BelongsTo{
        return $this->belongsTo(Kategori::class);
    }
    public function pinjam()
    {
        return $this->hasMany(Pinjam::class);
    }
}
