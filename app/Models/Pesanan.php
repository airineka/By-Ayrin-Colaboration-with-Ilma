<?php

namespace App\Models\Toko;


use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Pesanan extends Model
{
    use HasFactory;

    // Fields that are mass assignable
    protected $fillable = [
        'user_id',
        'toko_id',
        'nama_pesanan',
        'nama_toko',
        'total',
    ];

    /**
     * Get the user that owns the pesanan.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    //relasi ke model user, setiap pesanan punya 1 user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); 
    }

    /**
     * The tokos that belong to the pesanan.
     */
    //untuk relasi model pesanan ke tokonya
    public function tokos()
    { 
        return $this->belongsToMany(Toko::class, 'pesanan_toko');
    }
}
