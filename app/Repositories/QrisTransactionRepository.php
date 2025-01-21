<?php

namespace App\Repositories;

use App\Models\QrisTransaction;
use Illuminate\Support\Facades\DB;

class QrisTransactionRepository
{
    public function getTop5Events()
    {
        return DB::table('qris_transaction')
        ->join('peserta_event', 'qris_transaction.peserta_id', '=', 'peserta_event.peserta_id')
        ->join('ref_event', 'peserta_event.event_id', '=', 'ref_event.id')
        ->select('ref_event.nama_event', DB::raw('SUM(qris_transaction.nominal) as total_nominal'))
        ->groupBy('ref_event.nama_event')
        ->orderByDesc('total_nominal')
        ->limit(5)
        ->get();
    }

    public function getTransaksiPerBulan()
    {
        return QrisTransaction::selectRaw('MONTH(tanggal_transaksi) as bulan, SUM(nominal) as total_nominal')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
    }
}
