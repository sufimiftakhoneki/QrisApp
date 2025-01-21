<?php

namespace App\Http\Controllers;

use App\Repositories\PesertaQrisRepository;
use App\Repositories\QrisTransactionRepository;
use App\Repositories\PesertaEventRepository;
use Illuminate\Http\Request;

class PesertaQrisController extends Controller
{
    protected $pesertaQrisRepository;
    protected $qrisTransactionRepository;
    protected $pesertaEventRepository;

    public function __construct(
        PesertaQrisRepository $pesertaQrisRepository,
        QrisTransactionRepository $qrisTransactionRepository,
        PesertaEventRepository $pesertaEventRepository
    )
    {
        $this->pesertaQrisRepository = $pesertaQrisRepository;
        $this->qrisTransactionRepository = $qrisTransactionRepository;
        $this->pesertaEventRepository = $pesertaEventRepository;
    }

    public function index()
    {
        $peserta_qris = $this->pesertaQrisRepository->getAllPesertaQrisWithTransactions();
        $top_events = $this->qrisTransactionRepository->getTop5Events();
        $transaksi_per_bulan = $this->qrisTransactionRepository->getTransaksiPerBulan();
        $usaha_count = $this->pesertaEventRepository->getJumlahUsaha();

        return view('peserta.dashboard', compact('peserta_qris', 'top_events', 'transaksi_per_bulan', 'usaha_count'));
    }
}

