<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaQris extends Model
{
    use HasFactory;

    protected $table = 'peserta_qris';

    protected $fillable = [
        'nama_pemilik_qris', 
        'nama_usaha', 
        'verified'
    ];

    // Relasi dengan tabel transaksi (QrisTransaction
    public function transactions()
    {
        return $this->hasMany(QrisTransaction::class, 'peserta_id');
    }

    // Relasi dengan tabel event (PesertaEvent)
    public function events()
    {
        return $this->hasMany(PesertaEvent::class, 'peserta_id');
    }
}
