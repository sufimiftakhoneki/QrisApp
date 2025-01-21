@extends('layouts.app')

@section('content')
    <div class="row">
        <!-- Tabel Peserta QRIS -->
        <div class="col-md-12 mb-4">
            <h3>Data Peserta QRIS</h3>
            <table id="pesertaQrisTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nama Pemilik</th>
                        <th>Nama Usaha</th>
                        <th>Total Transaksi</th>
                        <th>Total Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peserta_qris as $peserta)
                        <tr>
                            <td>{{ $peserta->nama_pemilik_qris }}</td>
                            <td>{{ $peserta->nama_usaha }}</td>
                            <td>{{ $peserta->total_transaksi }}</td>
                            <td>{{ number_format($peserta->total_nominal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Chart: Top 5 Events -->
        <div class="col-md-6 mb-4">
            <h3>Top 5 Event berdasarkan Transaksi QRIS</h3>
            <canvas id="topEventsChart"></canvas>
        </div>

        <!-- Chart: Transaksi per Bulan -->
        <div class="col-md-6 mb-4">
            <h3>Nominal Transaksi QRIS per Bulan</h3>
            <canvas id="transaksiPerBulanChart"></canvas>
        </div>

        <!-- Chart: Jumlah Usaha -->
        <div class="col-md-6 mb-4">
            <h3>Jumlah Usaha Peserta QRIS</h3>
            <canvas id="usahaCountChart"></canvas>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            $('#pesertaQrisTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                order: [[3, 'desc']],
                lengthMenu: [10, 25, 50, 100],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                    infoEmpty: "Menampilkan 0 hingga 0 dari 0 entri",
                    infoFiltered: "(disaring dari _MAX_ total entri)",
                    paginate: {
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                }
            });
        });

        var ctxTopEvents = document.getElementById('topEventsChart').getContext('2d');
        var topEventsChart = new Chart(ctxTopEvents, {
            type: 'bar',
            data: {
                labels: @json($top_events->pluck('nama_event')),
                datasets: [{
                    label: 'Nominal Transaksi',
                    data: @json($top_events->pluck('total_nominal')),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        var ctxTransaksiBulan = document.getElementById('transaksiPerBulanChart').getContext('2d');
        var transaksiPerBulanChart = new Chart(ctxTransaksiBulan, {
            type: 'line',
            data: {
                labels: {!! json_encode([
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ]) !!},
                datasets: [{
                    label: 'Total Nominal',
                    data: @json($transaksi_per_bulan->pluck('total_nominal')),
                    fill: false,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        var ctxUsahaCount = document.getElementById('usahaCountChart').getContext('2d');
        var usahaCountChart = new Chart(ctxUsahaCount, {
            type: 'pie',
            data: {
                labels: @json($usaha_count->pluck('nama_usaha')),
                datasets: [{
                    label: 'Jumlah Usaha',
                    data: @json($usaha_count->pluck('jumlah')),
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#FF9F40', 
                        '#FF7F50', '#7B68EE', '#FFD700'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' Usaha';
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
