<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaEvent extends Model
{
    use HasFactory;

    protected $table = 'peserta_event';

    protected $fillable = [
        'peserta_id',
        'nama',
        'jenis_kelamin',
        'event_id'
    ];

    // Relasi dengan tabel event (RefEvent)
    public function event()
    {
        return $this->belongsTo(RefEvent::class, 'event_id');
    }

    // Relasi dengan peserta (PesertaQris)
    public function peserta()
    {
        return $this->belongsTo(PesertaQris::class, 'peserta_id');
    }
}
