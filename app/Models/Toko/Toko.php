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
    protected $fillable = ['nama_toko', 'address', 'user_id'];

    /**
     * Get the user associated with the model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    // setiap toko hanya punya satu user (one to many/many to one)
    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class); 
    }

    //banyak toko boleh punya banyak pesanan (many to many)
    public function pesanan()
    {
        return $this->belongsToMany(Pesanan::class, 'pesanan_toko');   
    }
}
