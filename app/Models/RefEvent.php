<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefEvent extends Model
{
    use HasFactory;

    protected $table = 'ref_event';

    protected $fillable = [
        'nama_event',
        'jadwal_pelaksanaan_mulai',
        'jadwal_pelaksanaan_selesai'
    ];

    // Relasi dengan peserta event (PesertaEvent)
    public function pesertaEvents()
    {
        return $this->hasMany(PesertaEvent::class, 'event_id');
    }
}
