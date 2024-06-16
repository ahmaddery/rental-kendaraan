@extends('layouts.navbar')

<div class="container p-5">
    <h1 class="mb-4 mt-5 text-center text-primary">Data Pengambilan Pengembalian</h1>
    <div class="card p-5 rounded-5">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($unprocessedPayments->isNotEmpty())
        <h2 class="mt-5">Unprocessed Payments</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark text-center">
                    <tr>
                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>Transaction Status</th>
                        <th>Gross Amount</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($unprocessedPayments as $payment)
                        @if($payment->user_id == Auth::id())
                            <tr>
                                <td class="text-center">{{ $payment->order_id }}</td>
                                <td class="text-center">{{ $payment->user_id }}</td>
                                <td class="text-center">{{ $payment->transaction_status }}</td>
                                <td class="text-end">{{ number_format($payment->gross_amount) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('pengambilan_pengembalian.createComplete', $payment->order_id) }}" class="btn btn-primary">
                                        Lengkapi Data
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <h2 class="mt-5">Data Pengambilan Pengembalian</h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark text-center">
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Kendaraan</th>
                    <th>Tanggal Pengambilan</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengambilanPengembalian as $data)
                    @if($data->user_id == Auth::id())
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
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>
