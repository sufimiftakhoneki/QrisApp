<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrisTransaction extends Model
{
    use HasFactory;

    protected $table = 'qris_transaction';

    protected $fillable = [
        'peserta_id',
        'tanggal_transaksi',
        'nama_produk',
        'nominal'
    ];

    // Relasi dengan tabel peserta (PesertaQris)
    public function peserta()
    {
        return $this->belongsTo(PesertaQris::class, 'peserta_id');
    }
}
