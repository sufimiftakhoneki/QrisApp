<?php

namespace App\Repositories;

use App\Models\PesertaQris;
use Illuminate\Support\Facades\DB;

class PesertaQrisRepository
{
    public function getAllPesertaQrisWithTransactions()
    {
        return PesertaQris::with('transactions')->get()->map(function ($peserta) {
            $total_transaksi = $peserta->transactions->count();
            $total_nominal = $peserta->transactions->sum('nominal');
            $peserta->total_transaksi = $total_transaksi;
            $peserta->total_nominal = $total_nominal;
            return $peserta;
        });
    }
}
