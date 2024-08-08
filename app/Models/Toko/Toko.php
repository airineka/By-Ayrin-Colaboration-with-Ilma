<?php

namespace App\Models\Toko;  

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Toko extends Model
{
    use HasFactory;

    protected $table = 'toko';
    protected $fillable = [
        'nama_toko',
        'address',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
   //untuk menambah relasi ke pesanan
    public function pesanan()
    {
        return $this->belongsToMany(Pesanan::class, 'pesanan_toko');
    }
}
