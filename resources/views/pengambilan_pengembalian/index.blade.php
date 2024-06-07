@extends('layouts.navbar')

<div class="container p-5">
    <h1 class="mb-4 mt-5">Data Pengambilan Pengembalian</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
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
                    <tr>
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
</div>
