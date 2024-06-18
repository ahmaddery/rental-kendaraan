@extends('layouts.navbar')

<div class="container p-5">
    <h1 class="mb-4 mt-5 text-center text-primary">Data Pengambilan Pengembalian</h1>
    <div class="card p-5 rounded-5">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- Form pencarian dan filter item per page -->
        <div class="row mb-3">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <form action="{{ route('pengambilan_pengembalian.index') }}" method="GET" id="searchForm">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari berdasarkan Order ID atau Nama Kendaraan" name="search" id="searchInput" value="{{ $search }}">
                    </div>
                </form>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const searchInput = document.getElementById('searchInput');
                        let timerId;

                        searchInput.addEventListener('input', function() {
                            clearTimeout(timerId); // Menghapus timeout sebelumnya (jika ada)
                            timerId = setTimeout(function() {
                                document.getElementById('searchForm').submit();
                            }, 1000); // Menunggu 3 detik sebelum mengirim form
                        });
                    });

                </script>


            </div>
        </div>

        <!-- Dropdown untuk memilih jumlah item per page -->
        <div class="mb-3">
            <form action="{{ route('pengambilan_pengembalian.index') }}" method="GET" id="itemsPerPageForm">
                <label for="per_page">Items per page:</label>
                <select name="per_page" id="per_page" class="form-select w-auto" onchange="document.getElementById('itemsPerPageForm').submit()">
                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                </select>
            </form>
        </div>
        <!-- Tabel untuk Unprocessed Payments -->
        @if ($unprocessedPayments->isNotEmpty())
        <div class="table-responsive">
            <h3 class="mt-5">Kendaraan belum ditentukan pengambilan</h3><br>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark text-center">
                    <tr>
                        <th>Order ID</th>
                        <th>Nama</th>
                        <th>Kendaraan</th>
                        <th>Harga/Hari</th>
                        <th>Status Transaksi</th>
                        <th>Total Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($unprocessedPayments as $payment)
                    <tr>
                        <td class="text-center">{{ $payment->order_id }}</td>
                        <td class="text-center">{{ $payment->user->name }}</td>
                        <td class="text-center">{{ $payment->kendaraan->nama }}</td>
                        <td class="text-center">{{ $payment->transaction_status }}</td>
                        <td class="text-end">Rp {{ number_format($payment->gross_amount, 2, ',', '.') }}</td>
                        <td class="text-center">
                            <a href="{{ route('pengambilan_pengembalian.createComplete', $payment->order_id) }}" class="btn btn-primary">
                                Lengkapi Data
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="alert alert-info mt-3">
            Tidak ada pembayaran yang belum diproses.
        </div>
        @endif

        <!-- Tabel untuk Data Pengambilan Pengembalian -->
        <h2 class="mt-5">Data Pengambilan Pengembalian</h2>
        @if ($pengambilanPengembalian->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark text-center">
                    <tr>
                        <th>Order ID</th>
                        <th>Nama</th>
                        <th>Kendaraan</th>
                        <th>Tanggal Pengambilan</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengambilanPengembalian as $data)
                    <tr class="text-center">
                        <td>{{ $data->order_id }}</td>
                        <td>{{ $data->user->name }}</td>
                        <td>{{ $data->kendaraan->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->tanggal_pengambilan)->locale('id')->format('l, d F Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->tanggal_pengembalian)->locale('id')->format('l, d F Y') }}</td>
                        <td>
                            @php
                            $today = now();
                            $tanggalPengambilan = \Carbon\Carbon::parse($data->tanggal_pengambilan);
                            $tanggalPengembalian = \Carbon\Carbon::parse($data->tanggal_pengembalian);

                            if ($today->greaterThan($tanggalPengembalian)) {
                            echo 'Selesai';
                            } elseif ($today->between($tanggalPengambilan, $tanggalPengembalian)) {
                            echo 'On Process';
                            } else {
                            echo 'Belum Diambil';
                            }
                            @endphp
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="alert alert-info mt-3">
            Tidak ada data pengambilan pengembalian.
        </div>
        @endif

        <!-- Pagination links untuk Data Pengambilan Pengembalian -->
        <div class="d-flex justify-content-center">
            {{ $pengambilanPengembalian->appends(['per_page' => $perPage, 'search' => $search])->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@include('layouts.modal')
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>