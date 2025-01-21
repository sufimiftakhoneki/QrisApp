<?php

namespace App\Repositories;

use App\Models\PesertaQris;

class PesertaEventRepository
{
    public function getJumlahUsaha()
    {
        return PesertaQris::selectRaw('nama_usaha, COUNT(id) as jumlah_usaha')
            ->groupBy('nama_usaha')
            ->get();
    }
}
