<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    // Fields that are mass assignable
    protected $fillable = ['user_id'];

    /**
     * Get the user that owns the pesanan.
     */
    public function user()
    {
        return $this->belongsTo(User::class); 
    }

    /**
     * The tokos that belong to the pesanan.
     */
    public function tokos()
    { 
        return $this->belongsToMany(Toko::class, 'pesanan_toko');
    }
}
